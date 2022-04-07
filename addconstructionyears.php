<?php

include 'dbconnect_test.php';
#include 'dbconnect_prod.php';

function read($csv){
    $file = fopen($csv, 'r');
    while (!feof($file) ) {
        $line[] = fgetcsv($file, 1024, ";");
    }
    fclose($file);
    return $line;
}
// Define the path to CSV file
$csv = 'gammel-dhs-id-byggeår-2022-03-31-uden-headers.csv';
$csv = read($csv);
print_r($csv);

$amount = count($csv);

echo $amount - 1;

$keys = array_keys($csv);

for($i = 0; $i < $amount - 1; $i++) {

    $olddhsid = $csv[$i][0];
    $constructionyear = $csv[$i][1];

    $doquery = pg_query_params(
        $dbconn,
        'UPDATE public.vessel
        SET construction_year=$1
        WHERE old_dhs_id=$2',
        array(
            $constructionyear,
            $olddhsid
        )
    );

    if (!$doquery) {
        echo "An error occurred.\n";
        exit;
    }

    echo "\nOld DHS id: " . $olddhsid . " / ";
    echo "Byggeår: " . $constructionyear;

}
echo "\n";
pg_close($dbconn);