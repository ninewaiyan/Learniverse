<?php

include_once("../controllers/RecordController.php");
$id=$_GET['id'];

$recordController = new recordController();
$result = $recordController-> deleteRecord($id);
if($result){
    header("location:recordTable.php?msg=itsdelete");
}else{
    header("location:recordTable.php?msg=deletefails");
}

?>