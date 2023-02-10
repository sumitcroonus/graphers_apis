<?php
$db = mysqli_connect('localhost:8083','root','','test');
if(!$db){
    echo "Database not connected";
}
$query="SELECT * FROM categories";
$exe=mysqli_query($db,$query);
$arr=[];

while($row=mysqli_fetch_assoc($exe))
{
    $arr[]=$row;
}
echo json_encode($arr);
?>