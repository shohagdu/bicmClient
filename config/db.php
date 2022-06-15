<?php
$db = new mysqli("localhost","root","","jfmgbicmac_site");
if ($db -> connect_errno) {
  echo "Failed to connect to MySQL: " . $db -> connect_error;
  exit();
}


$statusArray=array(0=>'Submitted to the Journal',2=>'With Editor',3=>'Under Review', 4=>'Review Completed', 10=>'Accepted', 9=>'Rejected');

$decision=array(3=>'Major revision', 4=>'Minor revision', 5=>'Reject & Resubmit',10=>'Accepted',11=>'Rejected');

function db_escape($data) {
$db = new mysqli("localhost","root","","jfmgbicmac_site");
$db->set_charset("utf8mb4");
$data = trim(htmlentities(strip_tags($data)));
if (get_magic_quotes_gpc())
$data = stripslashes($data);
$data = $db->real_escape_string($data);
return $data;
}
?>
