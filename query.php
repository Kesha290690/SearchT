<?php

error_reporting(E_ALL);
require 'php_monetdb.php';
define("DB", "demo");

echo function_exists("monetdb_connect");
echo function_exists("monetdb_last_error");
$db = monetdb_connect("sql" , "127.0.0.1", 50000, "monetdb" , "monetdb", "demo" );
$err = monetdb_last_error();

$query = "SELECT * FROM demo.sys.word_asos where main_word = 'skull'";
$res = monetdb_query($db, $query) or trigger_error(monetdb_last_error());

echo "Rows: " . monetdb_num_rows($res) . "\n";

$row = monetdb_fetch_assoc($res);

var_dump($row);

foreach($row as $rows) {
    if ($rows != null && $rows != '') {
        $assoc = "";
    }
}

monetdb_free_result($res);

if (monetdb_connected($db)) {
    monetdb_disconnect($db);
}
?>