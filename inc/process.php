<?php
session_start();
//var_dump($_POST['format']);
$format = $_POST['format'];
unset($_SESSION['format invalid'], $_SESSION['sucessPrint']);


if (ValidateWhithList($format) == true) {
   $db = connection_db('localhost', 'db_user', 'stez5TSvX959vhqz', 'project_php');
   
   $results = selectcontact($db);
   $tempArray = [];
   foreach ($results as $result) {
      
      array_push($tempArray, $result['name'], " ", $result['mobile'], " ", $result['email'], PHP_EOL);
   }
   
   $filePath = "/var/www/html/Google_contact/inc/Files/";
   $nameFile = $filePath . 'Contacts-' . date('y-m-d h:m:i') . '.' . $format;
   file_put_contents($nameFile, $tempArray);
   $_SESSION['sucessPrint'] = "sucessPrint";
   header("location: http://localhost/Google_contact/Exporter.php");
   exit;
} else {
   $_SESSION['format invalid'] = "format invalid!!";
   header("location: http://localhost/Google_contact/Exporter.php");
   exit;
}



function selectcontact($db)
{
   $id = $_SESSION['id'];
   $db->userTable = 'contacts';
   $sql = "SELECT * FROM $db->userTable where user_id=$id and date > '2022-04-24' ";
   $result = $db->query($sql);
   return $count = $result->fetch_all(1);
}
function connection_db($localhost, $user, $password, $project)
{
   $db = new mysqli($localhost, $user, $password, $project);
   
   // for farsi data transfer to/from database
   $db->query("SET NAMES UTF8;");
   return $db;
}
function ValidateWhithList($format)
{
   $whithList = ['Text', 'Pdf', 'Csv'];
   return in_array($format, $whithList);
}
