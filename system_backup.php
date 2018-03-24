<?php
//includes:
include '../backupDB/dbbackup.php';
if (!file_exists('path/to/directory')) {
    mkdir('D:/backup', 0777, true);
backup_tables('localhost','root','','bank','*','azizullahjobs@gmail.com',true); //set charset utf8
}
//backup_tables('localhost','root','','bank','*','azizullahjobs@gmail.com'); //use default charset
?>
