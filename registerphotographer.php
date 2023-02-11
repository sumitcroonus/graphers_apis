<?php 

$db = mysqli_connect('localhost:8083','root','','test');

if(!$db){
    echo "Database not connected";
}
$json=file_get_contents('php://input');
$obj=json_decode($json,true);
$name=$obj['Name'];
$email=$obj['Email'];
$phoneNo=$obj['PhoneNo'];
$sql = "SELECT * FROM photographers WHERE phoneNo ='" . $phoneNo."'AND email='".$email."'";

$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);
if($count==1){
    $photographer="UPDATE photographers SET name='".$name."'WHERE phoneNo=$phoneNo" ;
    $res=mysqli_query($db,$photographer);
}
else{
    $insert="INSERT INTO photographers(email,name,phoneNo) VALUES('".$email."','".$name."','".$phoneNo."')";
   
    $query=mysqli_query($db,$insert);
    echo("Success");
}