<?php
$dbConn = mysqli_connect('localhost', 'root', '', 'task') or die('MySQL connect failed. ' . mysqli_connect_error());

function dbQuery($sql) {
	global $dbConn;
	$result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
	return $result;
}

function dbFetchAssoc($result) {
	return mysqli_fetch_assoc($result);
}

function dbNumRows($result) {
    return mysqli_num_rows($result);
}

function closeConn() {
	global $dbConn;
	mysqli_close($dbConn);
}
function inserted_id()
{
	global $dbConn;
return	mysqli_insert_id($dbConn);	
}
function escape($string)
{
	global $dbConn;
	return mysqli_real_escape_string($dbConn,$string);
}
//End of file