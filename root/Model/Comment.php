<?php
    class Comment{
        private $idComment;
        private $idPost;
        private $idUser;
        private $text;
        private $dateComment;

        public function getIDComment(){return $this->idComment;}
        public function getIDPost(){return $this->idPost;}
        public function getIDUser(){return $this->idUser;}
        public function getText(){return $this->text;}
        public function getDateComment(){return $this->dateComment;}
    }
?>