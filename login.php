<?php 

$db = mysqli_connect('localhost:8083','root','','test');

if(!$db){
    echo "Database not connected";
}
$json=file_get_contents('php://input');
$obj=json_decode($json,true);
$phoneNo=$obj['PhoneNo'];


$sql = "SELECT * FROM registeration WHERE phoneNo ='" . $phoneNo."' ";

$result = mysqli_query($db,$sql);
$count = mysqli_num_rows($result);

if ($count == 1) {
    $api_key = "460A4A36EA5E71";
    $from = "HTCAMP";
    $otp=rand(1000,9999);
    $sms = "Dear ".$otp." you have successfully submitted admission form. After scrutiny and confirmation from college side, you will receive SMS.";
    $template_id = "1207162391997051529";
    $sms_text = urlencode($sms);
    $api_url = "http://sms.maemarketingservices.com/app/smsapi/index.php?key=".$api_key."&campaign=10506&routeid=70&type=text&contacts=".$phoneNo."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id."";	
    $response = file_get_contents($api_url);
    $otpupdate="UPDATE registeration SET otp='".$otp."'WHERE phoneNo=$phoneNo" ;
    $result = mysqli_query($db,$otpupdate);
    $getotp = "SELECT otp FROM registeration WHERE phoneNo ='" . $phoneNo."' ";
     $res = mysqli_query($db, $getotp);
        $row = mysqli_fetch_assoc($res);
        
        echo json_encode($row);
}

else{
    $otp=rand(1000,9999);
    $insert="INSERT INTO registeration(phoneNo,otp) VALUES('".$phoneNo."','".$otp."')";
   
    $query=mysqli_query($db,$insert);

    if($query){

        $api_key = "460A4A36EA5E71";
        $from = "HTCAMP";
        $sms = "Dear ".$otp." you have successfully submitted admission form. After scrutiny and confirmation from college side, you will receive SMS.";
        $template_id = "1207162391997051529";
        $sms_text = urlencode($sms);
        $api_url = "http://sms.maemarketingservices.com/app/smsapi/index.php?key=".$api_key."&campaign=10506&routeid=70&type=text&contacts=".$phoneNo."&senderid=".$from."&msg=".$sms_text."&template_id=".$template_id."";	
        $response = file_get_contents($api_url);
        $getotp = "SELECT otp FROM registeration WHERE phoneNo ='" . $phoneNo."' ";
        $res = mysqli_query($db, $getotp);
        $row = mysqli_fetch_assoc($res);
        
        echo json_encode($row['otp']);
    }

}

$getotp = "SELECT otp FROM registeration WHERE phoneNo ='" . $phoneNo."' ";
$res = mysqli_query($db, $getotp);
$row = mysqli_fetch_assoc($res);

echo json_encode($row['otp']);

?>
