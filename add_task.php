<?php
require_once 'db.php';
require_once 'jwt_utils.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

$bearer_token = get_bearer_token();

$is_jwt_valid = is_jwt_valid($bearer_token);

if($is_jwt_valid) {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// get posted data
	$data = json_decode(file_get_contents("php://input", true));
	
  $notes = $data->notes;

  $start_date = date('Y-m-d',strtotime($data->start_date));
  $due_date = date('Y-m-d',strtotime($data->due_date));

   $sql = "INSERT INTO tasks(subject,description,start_date,due_date,status,priority) VALUES('" . mysqli_real_escape_string($dbConn, $data->subject) . "', '" . mysqli_real_escape_string($dbConn, $data->description) . "','" . $start_date . "','" . $due_date . "','" . mysqli_real_escape_string($dbConn, $data->status)."','" . mysqli_real_escape_string($dbConn, $data->priority) . "')";
	
	$result = dbQuery($sql);
	
    
    //inserting array data into notes table -
    
    $task_id = inserted_id($sql);

    if(is_array($notes)){
        $DataArr = array();
        foreach($notes as $row){
            $fieldVal1 = mysqli_real_escape_string($dbConn, $row[0]);
            $fieldVal2 = mysqli_real_escape_string($dbConn, $row[1]);
            $fieldVal3 = mysqli_real_escape_string($dbConn, $row[2]);
            $DataArr[] = "('$task_id', '$fieldVal1', '$fieldVal2', '$fieldVal3')";
        }
        $sql = "INSERT INTO notes (task_id, subject, attachment, note) values ";
        $sql .= implode(',', $DataArr);
        dbQuery($sql); 
    }
 // adding images


// getting the number of total number of files 
// $countfiles = count($_FILES['file']['name']);
// $file = $_FILES['file']['name'][0]; // getting first file

// if(!empty($file))
// {
// $upload_path = 'upload/'; // declare file upload path
// // Looping all files 
// for($i=0;$i<$countfiles;$i++){
//     $fileName = $_FILES['file']['name'][$i];
//     $tempPath = $_FILES['file']['tmp_name'][$i];
//     $fileSize  =  $_FILES['file']['size'][$i];

//     $fileExt = strtolower(pathinfo($fileName,PATHINFO_EXTENSION)); // get image extension

  			
// 		//check file not exist our upload folder path
// 		if(!file_exists($upload_path . $fileName))
// 		{
			
//                 //built-in method to move file to directory
// 				move_uploaded_file($tempPath, $upload_path . $fileName); // move file from system temporary path to our upload folder path 
                
          
// 		}
	
//    }
// }
	if($result) {
		echo json_encode(array('success' => 'Your Task With Notes added successfully'));
	} else {
		echo json_encode(array('error' => 'Something went wrong, please try again.'));
	}
}
}
//End of file