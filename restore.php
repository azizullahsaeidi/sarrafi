<?php 
if(isset($_GET['restore_file_name'])){
$f_name = $_GET['restore_file_name'];
$filename = 'D:/backup/'.$f_name;
$mysql_host = 'localhost';
$mysql_username = 'root';
$mysql_password = '';
$mysql_database = 'bank';
$con=mysql_connect($mysql_host,$mysql_username,$mysql_password);
mysql_query('SET CHARACTER SET UTF8',$con);
mysql_query("SET NAMES 'UTF8'",$con);


mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connecting to MySQL server: ' . mysql_error());
// Select database
mysql_select_db($mysql_database) or die('Error selecting MySQL database: ' . mysql_error());

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 header("location:take_system_backup.php?restore=true");
}else{
	//echo mysql_error();die;
 header("location:restore_db.php?restore=failed");

}
//}}

 /*function restore($backup) {
 	$db='bank';
    $cmd = "c:/xampp/mysql/bin/mysql -h localhost -p  -u root $db < $backup";
    try {
        exec($cmd);
        $error              = false;
        $message['error']   = false;
        $message['message'] = 'Restore successfuly complete';
        return json_encode($message);
    } catch(PDOException $e) {

        $error              = true;
        $message['error']   = true;
        $message['message'] = $e->getMessage();;
        return json_encode($message);
    } 
}
echo restore($my_path);*/

/*$restore_file  = "D:/backup/bank.sql";
$server_name   = "localhost";
$username      = "root";
$password      = "";
$database_name = "bank";

$cmd = "mysqlimport  -u {$username} -p{$password} {$database_name} < $restore_file";
exec($cmd);*/

/*
//$  = "/home/abdul/20140306_world_copy.sql";
/*$server_name   = "localhost";
$username      = "root";
$password      = "";
$database_name = "bank";
$restore="mysql -h [$server_name] -u [$username] -p[$password] [$database_name] < D:/backup/bank.sql";
exec($restore);*/
/*function restore($path) {
	$username      = "root";
$password      = "";
$db = "bank";
  $f = fopen('$page' , 'w+');
  if(!$f) {
   echo "Error While Restoring Database";
   return;
  }
  $zip = new ZipArchive();
  if ($zip->open($path) === TRUE) {
   #Get the backup content
   $sql = $zip->getFromName('bank.sql');
   #Close the Zip File
   $zip->close();
   #Prepare the sql file
   fwrite($f , $sql);
   fclose($f);
    
   #Now restore from the .sql file
   $command = "mysql --user={$username} --password={$password} --database={$db} < restore/temp.sql";
   exec($command);
    
   #Delete temporary files without any warning
   @unlink('restore/temp.sql');
  } 
  else {
   echo 'Failed';
  }
}
restore($my_path);*/

/*$cmd = "mysql -h {$server_name} -u {$username} -p{$password} {$database_name} < $restore_file";
$h=exec($cmd);
if ($cmd) {
	echo "Have Done";
}else{
	echo mysql_error();
}*/
//define("BACKUP_PATH", "D:/backup/");
/*
$server_name   = "localhost";
$username      = "root";
$password      = "root";
$database_name = "world_copy";*/
/*$date_string   = date("Ymd");

$cmd = "mysqldump --routines -h {$server_name} -u {$username} -p{$password} {$database_name} > " . BACKUP_PATH . "{$date_string}_{$database_name}.sql";

exec($cmd);
if (exec($cmd)) {
	echo "Have Done";
}else{
	echo mysql_error();
}
*/

/* $con=mysql_connect("localhost","root","");
$db_name='bank';
$check_db=mysql_query("drop DATABASE $db_name",$con);
if ($check_db) {
	# code...

mysql_query("CREATE DATABASE `$db_name` CHARACTER SET utf8 COLLATE utf8_general_ci", $con ) or die('Error connecting to MySQL server: ' . mysql_error());
mysql_select_db($db_name);
$qry = file_get_contents($source);
echo $qry;
$q=mysql_query($qry, $con);
if ($q) {
	echo "Have Done";
}else{
	echo "have Failed";
}
}*/