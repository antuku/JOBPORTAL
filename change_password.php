<?php
session_start();
$_SESSION["userId"] = "2";
//$conn = new mysqli("localhost", "id15987690_root", "XcfTp3qV_l0+/X6!", "id15987690_db_jobportal");

$conn = mysqli_connect("localhost","id15983047_root","/T~!E8?\[b>_=N5S","id15983047_db_jobportal");
// Perform query

if (count($_POST) > 0) {
    
    //$result = mysqli_query($conn, "SELECT * from users WHERE userId='" . $_SESSION["userId"] . "'");
    //$row = mysqli_fetch_array($result);
    $sql = "SELECT * from users WHERE userId= ".$_SESSION["userId"]."";
    if ($result = mysqli_query($conn,$sql)) {
          //echo "Returned rows are: " . mysqli_num_rows($result);
          // Free result set
          $row = mysqli_fetch_array($result);
    }
    //echo'<pre>';print_r($row);echo'</pre>';
    if ($_POST["currentPassword"] == $row["password"]) {
        mysqli_query($conn, "UPDATE users set password='" . $_POST["newPassword"] . "' WHERE userId='" . $_SESSION["userId"] . "'");
        $message = "Password Changed";
    } else
        $message = "Current Password is not correct";
}
?>
<html>
<head>
<title>Change Password</title>
<link rel="stylesheet" type="text/css" href="styles.css" />
<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
	currentPassword.focus();
	document.getElementById("currentPassword").innerHTML = "required";
	output = false;
}
else if(!newPassword.value) {
	newPassword.focus();
	document.getElementById("newPassword").innerHTML = "required";
	output = false;
}
else if(!confirmPassword.value) {
	confirmPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "required";
	output = false;
}
if(newPassword.value != confirmPassword.value) {
	newPassword.value="";
	confirmPassword.value="";
	newPassword.focus();
	document.getElementById("confirmPassword").innerHTML = "not same";
	output = false;
} 	
return output;
}
</script>
</head>
<body>
    <form name="frmChange" method="post" action=""
        onSubmit="return validatePassword()">
        <div style="width: 500px;">
            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
            <table border="0" cellpadding="10" cellspacing="0"
                width="500" align="center" class="tblSaveForm">
                <tr class="tableheader">
                    <td colspan="2">Change Password</td>
                </tr>
                <tr>
                    <td width="40%"><label>Current Password</label></td>
                    <td width="60%"><input type="password"
                        name="currentPassword" class="txtField" /><span
                        id="currentPassword" class="required"></span></td>
                </tr>
                <tr>
                    <td><label>New Password</label></td>
                    <td><input type="password" name="newPassword"
                        class="txtField" /><span id="newPassword"
                        class="required"></span></td>
                </tr>
                <td><label>Confirm Password</label></td>
                <td><input type="password" name="confirmPassword"
                    class="txtField" /><span id="confirmPassword"
                    class="required"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><input type="submit" name="submit"
                        value="Submit" class="btnSubmit"></td>
                </tr>
            </table>

            <div class="container" style="background-color:#f1f1f1">
            <button type="button" onclick="window.location.href='index.php'" class="cancelbtn">Close</button>
            </div>
        </div>
    </form>
</body>
</html>