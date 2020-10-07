@servers(['web' => 'pungky@staging.dashboard.orahin.com'])

@task('list', ['on' => 'web'])
ls -l
@endtask

@setup
$repository = 'git@gitlab.com:pungkyorahin95/orahin-dashboard.git';
$releases_dir = '/var/www/orahin-dashboard/releases';
$app_dir = '/var/www/orahin-dashboard';
$release = date('YmdHis');
$new_release_dir = $releases_dir .'/'. $release;
@endsetup

@story('deploy')
clone_repository
run_composer
update_symlinks
migrate_database
start_queue
deployment_cleanup
remove_cache
@endstory

@task('clone_repository')
echo 'Cloning repository'
[ -d {{ $releases_dir }} ] || mkdir {{ $releases_dir }}
git clone --depth 1 {{ $repository }} {{ $new_release_dir }}
cd {{ $new_release_dir }}
git reset --hard {{ $commit }}
@endtask

@task('run_composer')
echo 'Starting deployment ({{ $release }})'
cd {{ $new_release_dir }}
composer install --prefer-dist --no-scripts -q -o
@endtask

@task('update_symlinks')
echo 'Linking storage directory'
rm -rf {{ $new_release_dir }}/storage
ln -nfs {{ $app_dir }}/storage {{ $new_release_dir }}/storage

echo 'Linking .env file'
ln -nfs {{ $app_dir }}/.env {{ $new_release_dir }}/.env

echo 'Linking firebase credentials'
rm -rf {{ $new_release_dir }}/credentials
ln -nfs {{ $app_dir }}/credentials {{ $new_release_dir }}/credentials

echo 'Linking current release'
ln -nfs {{ $new_release_dir }} {{ $app_dir }}/current
@endtask

@task('migrate_database')
echo 'Starting migrate database if any'
php {{ $new_release_dir }}/artisan migrate
@endtask

@task('start_queue')
php {{ $new_release_dir }}/artisan queue:restart --no-interaction
@endtask

@task('deployment_cleanup')
cd {{ $releases_dir }};
find -mindepth 1 -maxdepth 1 -not -name "{{$release}}" | xargs rm -Rf
echo "Cleaned up old deployments"
@endtask

@task('remove_cache')
php {{ $new_release_dir }}/artisan view:clear --quiet
php {{ $new_release_dir }}/artisan cache:clear --quiet
php {{ $new_release_dir }}/artisan config:clear --quiet
echo 'Cache cleared';
@endtask
