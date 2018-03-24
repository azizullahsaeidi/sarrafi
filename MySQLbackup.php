
<!DOCTYPE html>

<html>
    <head>
        <title>MySQL database backup</title>
        <script charset="utf-8" type="text/javascript" src="../script/jquery.js"></script>
       
    </head>
    <body>
        <form  action="br.php" method="get" enctype="multipart/form-data">
        <table border="0" bgcolor="#C0C0C0" align="center" width="40%">
            <tr>
                <td colspan="3" align="center"><b>Please enter the following parameters</b></td>
            </tr>
            <tr>
                <td>MySQL Sever*</td>
                <td>:</td>
                <td><input type="text" id="server" name="server" /></td>
            </tr>
            <tr>
                <td>MySQL username*</td>
                <td>:</td>
                <td><input type="text" id="username" name="username" /></td>
            </tr>
            <tr>
                <td>MySQL password*</td>
                <td>:</td>
                <td><input type="text" id="password" name="password" /></td>
            </tr>
            <tr>
                <td>MySQL database name*</td>
                <td>:</td>
                <td><input type="text" id="databasename" name="databasename" /></td>
            </tr>
            <tr>
                <td colspan="2">Backup <input type="radio" name="backupRestore" id="backup" value="backup" checked="true" onclick="showHide(this.id);" /></td>
                <td>
                    <div class="backupRadio">
                        <input type="radio" name="data" value="wd" checked="true" />With data 
                        <input type="radio" name="data" value="wod"/>With out data
                    </div>
                </td>
            </tr>
            
            <tr>
                <td colspan="3" align="center"><input type="submit" value="Submit"/></td>
            </tr>
        </table>
        </form>
    </body>   
</html>