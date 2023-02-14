<?php
$db = mysqli_connect('localhost:8083','root','','test');
if(!$db){
    echo "Database not connected";
}
$image=$_FILES['image']['name'];
$caption=$_POST['caption'];
$imagePath='uploads/'.$image;
$temp_name=$_FILES['image']['tmp_name'];

move_uploaded_file($temp_name,$imagePath);

$db->query("INSERT INTO posts SET image_url='$image',caption='$caption'");


?>