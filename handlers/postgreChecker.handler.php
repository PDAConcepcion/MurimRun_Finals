<?php

$host = "host.docker.internal"; 
$port = "5113";
$username = "user";
$password = "password";
$dbname = "mongopostgre_db";

$conn_string = "host=$host port=$port dbname=$dbname user=$username password=$password";

$dbconn = pg_connect($conn_string);

if (!$dbconn) {
    echo "❌ Connection Failed: ", pg_last_error() . "  <br>";
    exit();
} else {
    echo "✔️ PostgreSQL Connection  <br>";
    pg_close($dbconn);
}