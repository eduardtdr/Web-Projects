<!DOCTYPE html>
<html>
<body>
<?php             

include "connect.php";

 if(isset($_SESSION['username']) && $_SESSION['username'] != '') {
    echo '<script type="text/javascript">window.location = "statuspage1.php"; </script>';
 }

?>
<html>

    <body>
        <form>
            <table class="mytable">
                <tr>
                    <td>Username</td>
                    <td>
                        <input type="text" name="username" id="username" class="as_input" value="s"/>
                    </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td>
                        <input type="password" name="password" id="password" class="as_input" value="s"/>
                    </td>
                </tr>
                <tr>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="login" id="login" class="as_button" value="Login &raquo;" />
                    </td>
           