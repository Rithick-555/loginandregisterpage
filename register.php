+<?php

$uname = $_POST['uname'];
$email  = $_POST['email'];
$pnum = $_POST['pnum'];
$role = $_POST['role'];
$pass = $_POST['pass'];
$repass = $_POST['rpass'];

if (!empty($uname) || !empty($email) || !empty($pnum)||!empty($role) || !empty($pass) || !empty($rpass) )
{
$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "project";

$conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);

if (mysqli_connect_error()){
  die('Connect Error ('. mysqli_connect_errno() .') '
    . mysqli_connect_error());
}
else{
  $SELECT = "SELECT email From project Where email = ? Limit 1";
  $INSERT = "INSERT Into project (uname ,email ,pnum,role,pass,rpass )values(?,?,?,?,?,?)";

//Prepare statement
     $stmt = $conn->prepare($SELECT);
     $stmt->bind_param("s", $email);
     $stmt->execute();
     $stmt->bind_result($email);
     $stmt->store_result();
     $rnum = $stmt->num_rows;

     //checking username
      if ($rnum==0) {
      $stmt->close();
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("ssssss", $uname1,$email,$pnum,$role,$pass,$rpass);
      $stmt->execute();
      echo "New record inserted sucessfully";
     } else {
      echo "Someone already register using this email";
     }
     $stmt->close();
     $conn->close();
    }
} else {
 echo "All field are required";
 die();
}
?>