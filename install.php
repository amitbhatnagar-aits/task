<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "task";

// Creating connection
$connection = mysqli_connect($servername, $username, $password);
$connection_after_db = mysqli_connect($servername, $username, $password,$database);
// Checking connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Creating a database named newDB
$sql = "CREATE DATABASE IF NOT EXISTS $database";
if (mysqli_query($connection, $sql)) {
   echo "Database created successfully with the name $database <br>";

//creating table named as notes

$sql = "CREATE TABLE IF NOT EXISTS `notes` (
    `note_id` int(11) NOT NULL,
    `task_id` int(11) NOT NULL,
    `subject` text DEFAULT NULL,
    `attachment` text DEFAULT NULL,
    `note` text DEFAULT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    if (mysqli_query($connection_after_db, $sql)) {
        echo "Table Notes created successfully <br>";
      } else {
        echo "Error creating table: " . mysqli_error($connection_after_db);
      }

      //creating table named as tasks
$sql = "CREATE TABLE IF NOT EXISTS `tasks` (
    `task_id` int(11) NOT NULL,
    `subject` text NOT NULL,
    `description` text NOT NULL,
    `start_date` date DEFAULT NULL,
    `due_date` date NOT NULL,
    `status` enum('New','Incomplete','Complete') DEFAULT NULL,
    `priority` enum('High','Medium','Low') NOT NULL
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
  if (mysqli_query($connection_after_db, $sql)) {
    echo "Table Tasks created successfully <br>";
  } else {
    echo "Error creating table: " . mysqli_error($connection_after_db);
  }
//creating table named as users

$sql = "CREATE TABLE IF NOT EXISTS `users` (
    `user_id` int(11) NOT NULL,
    `username` varchar(100) DEFAULT NULL,
    `password` varchar(100) NOT NULL,
    `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
    `status` enum('Enabled','Disabled') DEFAULT 'Enabled'
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

if (mysqli_query($connection_after_db, $sql)) {
    echo "Table Users created successfully <br>";
  } else {
    echo "Error creating table: " . mysqli_error($connection_after_db);
  }


} else {
    echo "Error creating database: " . mysqli_error($connection);
}

//Altering tables to add primary keys

$sql = "ALTER TABLE `notes` ADD PRIMARY KEY (`note_id`);";mysqli_query($connection_after_db,$sql);
$sql = "ALTER TABLE `notes` MODIFY `note_id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connection_after_db,$sql);
$sql = "ALTER TABLE `tasks` ADD PRIMARY KEY (`task_id`);";mysqli_query($connection_after_db,$sql);
$sql = "ALTER TABLE `tasks` MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connection_after_db,$sql);
$sql = "ALTER TABLE `users` ADD PRIMARY KEY (`user_id`);";mysqli_query($connection_after_db,$sql);
$sql = "ALTER TABLE `users` MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;";mysqli_query($connection_after_db,$sql);

//inserting dummy user in users table for testing purposes
$sql = "INSERT INTO `users` (`user_id`, `username`, `password`, `created_at`, `status`) VALUES(1, 'demo', 'demo', '2022-11-19 10:20:00', 'Enabled');";
$result = mysqli_query($connection_after_db, $sql);

// closing connection
mysqli_close($connection);
mysqli_close($connection_after_db);

?>