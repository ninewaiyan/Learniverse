<?php
include_once '../includes/db.php';
include_once '../models/feedback.php';

class FeedBackController
{

    private $feedback;

    public function __construct()
    {
        $this->feedback = new Feedback();
    }


    public function createFeedback($comment,$user_id){
        $feedback = new Feedback($comment,$user_id);
        $result =  $feedback->createFeedback();
        return $result;
    }

    function getAllFeedack()
    {
        $feedback = new Feedback;
        $feedbacks=$feedback->getAllFeedBack();
        return $feedbacks;

    }
}