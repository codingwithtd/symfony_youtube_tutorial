<?php

namespace App\Utilities;

class ConvertCSVToArray
{
    public function convert($filename, string $delimiter = ';', string $enclosure = '"'): bool|array
    {
        if(!file_exists($filename) || !is_readable($filename)) {
            return FALSE;
        }

        $header = NULL;
        $data = array();

        if (($handle = fopen($filename, 'r')) !== FALSE) {

            while (($row = fgetcsv($handle, 0, $delimiter, $enclosure)) !== FALSE) {
                if(!$header) {
                    $header = $row;
                } else {
                    $data[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
        return $data;
    }
}