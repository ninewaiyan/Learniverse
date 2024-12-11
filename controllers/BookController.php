<?php
include_once '../includes/db.php';
include_once '../models/book.php';

Class BookController{

    private $book;

    public function __construct(){
        $this->book = new Book();
    }

    public function createBook($title,$description,$image,$file,$user_id)
    {
       
        $book = new Book($title,$description,$image,$file,$user_id);
        $result = $book->createBook();
        return $result;
    }


    public function getAllBook(){
        $book = new Book();
        $books = $book->getAllBook();
        return $books;
    }

    public function getBookbyId($id){
        $book = new Book();
        $book = $book->getBookById($id);
        return $book;
    }

    public function deleteBook($id){
        $book = new Book();
        $result = $book->deleteBook($id);
        return $result;
    }

    public function updateBook($id,$title,$description){
        $book = new Book();
        $result = $book->editBook($id,$title,$description,);
        return $result;
    }
    

}

?>