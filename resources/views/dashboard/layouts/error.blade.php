@if($errors->any())
    <div class="alert alert-danger fade show" role="alert">
        <div class="alert-icon"><i class="flaticon-danger"></i></div>

        <div class="alert-text">
            @foreach ($errors->all() as $error){{$error}} <br>@endforeach</div>

        <div class="alert-close">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="la la-close"></i></span>
            </button>
        </div>
    </div>
@endif