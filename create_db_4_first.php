<?php 
if (isset($_GET['create_database'])) {
	
$dbhost = 'localhost'; //unlikely to require changing.
$mysql_database='bank'; //modify these
$dbuser = 'root'; //variables 
$dbpass = ''; //// to your installation
$con=mysql_connect($dbhost, $dbuser, $dbpass) or die(mysql_error());

$file_name = $_GET['create_database'];
$delete=mysql_query("drop DATABASE $mysql_database",$con);
if($delete){
$create_db=mysql_query("CREATE DATABASE `$mysql_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci" ) or die('Error connecting to MySQL server: ' . mysql_error());
		if ($create_db) {
			header("location:create_real_db_4_first.php?restore_file_name=$file_name");
		}else{
			header("location:create_database.php?restore_file_name=$file_name");
			
		}
	
}else{
$create_db=mysql_query("CREATE DATABASE `$mysql_database` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci" ) or die('Error connecting to MySQL server: ' . mysql_error());
		if ($create_db) {
			header("location:create_real_db_4_first.php?restore_file_name=$file_name");
		}else{
			header("location:create_database.php?restore_file_name=$file_name");
			
		}
	}	
}