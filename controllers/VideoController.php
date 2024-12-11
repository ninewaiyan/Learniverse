<?php
include_once '../includes/db.php';
include_once '../models/video.php';

class VideoController
{

    private $video;

    public function __construct()
    {
        $this->video = new Video();
    }


    public function Upload($title, $url, $user_id)
    {
        $video = new Video($title, $url, $user_id);

        $result = $video->createVideo();
    }

    function getAllVideo()
    {
        $video = new Video();
        $videos = $video->getAllVideo();
        return $videos;

    }

    public function deleteVideoById($id)
    {
        $video = new Video();
        $result = $video->deleteVideo($id);
        return $result;

    }

    public function editVideoById($id, $title)
    {
        $video = new Video();
        $result = $video->editVideo($id, $title);
        return $result;
    }



}