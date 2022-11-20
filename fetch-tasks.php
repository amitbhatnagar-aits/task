<?php
//get tasks with notes api
require_once 'db.php';
require_once 'jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$bearer_token = get_bearer_token();

$is_jwt_valid = is_jwt_valid($bearer_token);

if($is_jwt_valid) {

    $query = "SELECT  tasks.*,COUNT(notes.task_id)  AS note from tasks LEFT JOIN notes ON tasks.task_id= notes.task_id"; //Order: Priority "High" First, Maximum Count of Notes

    $filtered_get = array_filter($_GET); // removes empty values from $_GET
    $note_array_check = $filtered_get;
if (count($filtered_get)) { // not empty
    $query .= " WHERE";
    $k = 0;
    $keynames = array_keys($filtered_get); // make array of key names from $filtered_get
    unset($filtered_get['note']);
    foreach($filtered_get as $key => $value)
    {
       
       $query .= " $keynames[$k] = '$value'";  // $filtered_get keyname = $filtered_get['keyname'] value
       
       if (count($filtered_get) > 1 && (count($filtered_get)-1 > $k)) { // more than one search filter, and not the last
       
        $query .= " AND ";
       }
       $k++; 
    }
    if(!empty(array_key_exists('note',$note_array_check))) { //checking if array key named as note exist
        if(count($note_array_check)>1)
        {
            $query .= " AND ";
        }
        $query .= " EXISTS(SELECT * FROM notes as notecount WHERE notes.task_id = tasks.task_id)";  // if array key named as note exist then adding this to parent sql query.
    }
    $query .= " GROUP BY tasks.task_id order by FIELD(priority, 'High','Medium','Low'),note DESC"; //Order: Priority "High" First, Maximum Count of Notes
}
  $query .= ";";

	$results = dbQuery($query);

	$rows = array();

	while($row = dbFetchAssoc($results)) {
		$rows[] = $row;
	}
    if(empty($rows))
    {
        echo json_encode(array('error' => 'No Matching Data Found')); 
    }
    else
    {
	echo json_encode($rows);
    }
} else {
	echo json_encode(array('error' => 'Access denied'));
}

//End of file