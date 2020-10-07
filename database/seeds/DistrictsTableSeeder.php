<?php


/**
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

use Illuminate\Database\Seeder;

class DistrictsTableSeeder extends Seeder
{
    public function run()
    {
        $Csv = new CsvtoArray;
        $file = base_path() . '/storage/csv/districts.csv';
        $header = array('id', 'city_id', 'name');
        $data = $Csv->csv_to_array($file, $header);
        $collection = collect($data);
        foreach ($collection->chunk(50) as $chunk) {
            \DB::table(config('laravolt.indonesia.table_prefix') . 'districts')->insert($chunk->toArray());
        }
    }
}
