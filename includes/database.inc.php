<?php
/**********************************************************
 *  Copyright (c) 2022, Jim Semple, Semple Ventures       *
 *  https://www.sempleventures.com/                       *
 **********************************************************/
?>
<?php

//$server = 'localhost'; // testing against local db
//$server = 'bigdata.cby0st0ah4zo.us-east-1.rds.amazonaws.com'; // example server (that i don't use anymore) its always better to use static IP's for databases where possible for speed (or a prod memcached instance)
//$server = '10.10.10.10'; // production memcached server

$dbschema = 'ads';
$username = 'svads';
$password = 's3mple'; // nice try, i don't use this simple password anywhere in prod

function opendb() {
	$connect = mysqli_connect($GLOBALS['server'], $GLOBALS['username'], $GLOBALS['password']);
	if (!$connect) die('Could not connect: ' . mysqli_error($connect));
	return $connect;
}
function query($connect, $sql) {
	if (!mysqli_select_db($connect, $GLOBALS['dbschema'])) {
    die("Could not select database: ". $GLOBALS['dbschema'] .". Are you sure it exists and you have the correct permissions to access it?");
	}
	$result = mysqli_query($connect,$sql) or die ('Error: ' . mysqli_error($connect));
	return $result;
}
function fetch($result) {
	$row = mysqli_fetch_array($result);
	return $row;
}

function closedb($con) {
	mysqli_close($con);
}
?>
