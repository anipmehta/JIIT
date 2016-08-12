<?php
$json = file_get_contents('php://input');
$obj = json_decode($json,true);
// print $json;
$enos = $obj['eno'];
// print $enos;
$passwords= $obj["password"];
$dobs = $obj["dob"];
$eno = urlencode($enos);
$dob = urlencode($dobs);
$password = urlencode($passwords);
$txtPin = urlencode("Password/Pin");
$txtCode = urlencode("Enrollment No");
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://webkiosk.jiit.ac.in/CommonFiles/UserActionn.jsp",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "x=null&txtInst=Institute&InstCode=JIIT&txtuType=Member%20Type&UserType=S&txtCode=Enrollment%20No&MemberCode=$eno&DOB=DOB&DATE1=$dob&txtPin=Password%2FPin&Password=$password&BTNSubmit=Submit",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache",
    "content-type: application/x-www-form-urlencoded"
   
  ),
));
// print $txtPin.$txtCode;
$response = curl_exec($curl);
// print $response;
$err = curl_error($curl);
curl_close($curl);
$a = htmlentities($response);
if (strpos($a, 'Please give the correct Institute name and Enrollment No. !!') !== false) {
    $result = array('response' => 'Please give the correct Institute name and Enrollment No. !!');
    exit(json_encode($result));
}
else if (strpos($a, 'Invalid Password') !== false) {
     $result = array('response' => 'Invalid Password');
     exit(json_encode($result));
}
else if ($err) {
     $result = array('response' => 'Unknown Error');
     exit(json_encode($result));
} 
else {
     $result = array('response' => 'Success');
     exit(json_encode($result));
}
?>