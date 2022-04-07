<?php

function read($csv){
    $file = fopen($csv, 'r');
    while (!feof($file) ) {
        $line[] = fgetcsv($file, 1024, ";");
    }
    fclose($file);
    return $line;
}
// Define the path to CSV file
$csv = '../../gammel-dhs/data (2).csv';
$csv = read($csv);
print_r($csv);
