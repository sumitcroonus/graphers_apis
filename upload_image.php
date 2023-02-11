<?php
$db = mysqli_connect('localhost:8083','root','','test');
if(!$db){
    echo "Database not connected";
}
$image=$_FILES["image"]["caption"];

$caption=$_POST["caption"];
$imagePath="uploads/".$image;
$temp_caption=$_FILES["image"]["temp_caption"];

move_uploaded_file($temp_caption,$imagePath);

$db->query("INSERT INTO posts(image_url,caption)VALUES('".$image."','".$caption."')");
?>