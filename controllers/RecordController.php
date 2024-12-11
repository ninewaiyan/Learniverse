<?php

include_once '../models/record.php';

class RecordController{

    private $record;

    public function __construct(){
        $this->record=new Record();
    }

    public function storeRecord($quizz_name, $achievement, $score, $user_id) {
        $record = new Record($quizz_name, $achievement, $score, $user_id);
        return $record->storeRecord(); // Return result directly
    }

    public function getAllRecord(){
        $record = new Record();
        $records = $record->getAllRecord();
        return $records;
    }

    public function getRecordByUserId($id){
        $record = new Record();
        $records = $record->getRecordByUserId($id);
        return $records;
    }

    function deleteRecord($id){
        $record= new Record();
        $records=$record->deleteRecord($id);
        return $records;
    }

    function searchRecord($data){
        $record=new Record();
        $records=$record->search($data);
        return $records;
    }
}

?>