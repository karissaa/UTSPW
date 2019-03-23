<?php
    class Post{
        public $idPost;
        private $type;
        private $text;
        private $datePost;
        private $idUser;
        private $imgDirectory;
        private $comments;

        public function getIDPost(){return $this->idPost;}
        public function getType(){return $this->type;}
        public function getText(){return $this->text;}
        public function getDatePost(){return $this->datePost;}
        public function getIDUser(){return $this->idUser;}
        public function getImageDir(){return $this->imgDirectory;}
    }
?>