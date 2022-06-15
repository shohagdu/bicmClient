<?php
extract($_GET);
if($to=="") exit;
$subject="No reply";
$this->lib->email($to,$subject,$txt);

?>