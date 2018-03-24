<?php 
if(isset($_GET['restore_file_name'])){
$f_name = $_GET['restore_file_name'];
$filename = 'C:/xampp/htdocs/exchange/Database_sql_file/'.$f_name;
echo $filename;
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
 header("location:login.php?create_database=true");
}else{
	//echo mysql_error();die;
 header("location:create_database.php?restore=failed");

}