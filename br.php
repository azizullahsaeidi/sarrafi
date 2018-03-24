<?php 
    if(isset($_GET['username']) && isset($_GET['password']) && isset($_GET['databasename'])) {
        $server = trim($_GET['server']);
        $username = trim($_GET['username']);
        $password = trim($_GET['password']);
        $databasename = trim($_GET['databasename']);
        $backupRestore = $_GET['backupRestore'];
 
        if ($backupRestore == 'backup'){        
           $data = $_GET['data'];
            $now = str_replace(":", "", date("Y-m-d H:i:s"));
            $outputfilename = $databasename . '-' . $now . '.sql';
            $outputfilename = str_replace(" ", "-", $outputfilename);
 
            //Dump the MySQL database
            if ($data == "wd"){
                //With data
                exec('mysqldump  -u '. $username .' -p'. $password .' '. $databasename .' > '. $outputfilename);
            }
            else{
                //Without data
                exec('mysqldump --no-data  -u '. $username .' -p'. $password .' '. $databasename .' > '. $outputfilename);
            }   
 
            //Download the database file
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($outputfilename));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($outputfilename));
            ob_clean();
            flush();
            readfile($outputfilename);
         
            //After download remove the file from server
            exec('rm ' . $outputfilename);  
 
        }
        else{//Restore the database
 
            $target_path = getcwd();
            $databasefilename = $_FILES["databasefile"]["name"];
 
            //Upload the database file to current working directory
            move_uploaded_file($_FILES["databasefile"]["tmp_name"], $target_path . '/' . $databasefilename);
 
            //Restore the database          
            exec('mysql -u '. $username .' -p'. $password .' '. $databasename .' < '. $databasefilename);
             
            //Remove the file from server
            exec('rm ' . $databasefilename);
        }
    }
?>