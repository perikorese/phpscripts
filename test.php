<?php

#include 'dbconnect_test.php';
include 'dbconnect_prod.php';

$query = 'SELECT id,current_name FROM public.vessel ORDER BY current_name ASC';
$result = pg_query($query);

while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    foreach ($line as $col_value) {
        echo "$col_value ";
    }
    echo "\n";
}

pg_free_result($result);

pg_close($dbconn);