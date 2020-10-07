<?php


/**
 *  Copyright (c) 2019. Orahin
 *  @author Pungky Kristianto
 *  @url https://orahin.id
 *  @date 12/15/19, 3:35 PM
 */

use Illuminate\Database\Seeder;

class ProvincesTableSeeder extends Seeder
{
    public function run()
    {
        $Csv = new CsvtoArray;
        $file = base_path() . '/storage/csv/provinces.csv';
        $header = array('id', 'name');
        $data = $Csv->csv_to_array($file, $header);
        \DB::table(config('laravolt.indonesia.table_prefix') . 'provinces')->insert($data);
    }
}
