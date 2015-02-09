<?php 

require_once('db.php');

$db                     =   mysql_connect($host, $username, $password) or die('Could not connect');
mysql_select_db($db_name, $db) or die('');

$paramArray             =   array();
$paramArray[]           =   $_POST['name'];
$paramArray[]           =   $_POST['gender'];
$paramArray[]           =   $_POST['bloodGroup'];
$paramArray[]           =   $_POST['address'];
$paramArray[]           =   $_POST['city'];
$paramArray[]           =   $_POST['pincode'];
$paramArray[]           =   implode($_POST['interests'], ", ");
$paramArray[]           =   $_POST['phone'];
$paramArray[]           =   $_POST['mailID'];
$paramArray[]           =   $_POST['facebook'];
$paramArray[]           =   $_POST['timeToVolunteer'];

$paramValues            =   "'" . implode("','", $paramArray) . "'";
//$paramValues            =   $paramValues . ', now()';
//echo $paramValues;

$sql                    =   "INSERT INTO registration (name, gender, bloodGroup, address, city, pincode, interests, phone, mailID, facebook, timeToVolunteer) VALUES ($paramValues)";

$db_insert              =   mysql_query($sql);

if (!$db_insert) {
    $json       =   array();
    $json['status'] = 'fail';
    $json['message'] = mysql_error();;
    //echo json_encode($json);
} else {
    $json       =   array();
    $json['status'] = 'success';
    $json['contactID'] = mysql_insert_id();
    //echo json_encode($json);
}

mysql_close();

?>

<h2> Registration is succesfull :) </h2>
