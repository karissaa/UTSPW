<?php
    //Dipake untuk display data-data User, data-data rahasia ga perlu ditampilkan
    class User{
        private $idUser;
        //Username tidak diperlukan
        //Password juga
        private $dispName;
        private $gender;
        private $birthDate;
        private $email;
        //Date registered tidak perlu
        private $bio;
        private $phoneNum;
        private $profPic;

        public function getIDUser(){return $this->idUser;}
        public function getDisplayName(){return $this->dispName;}
        public function getGender(){return $this->gender;}
        public function getBirthDate(){return $this->birthDate;}
        public function getEmail(){return $this->email;}
        public function getBio(){return $this->bio;}
        public function getPhoneNum(){return $this->phoneNum;}
        public function getProfPic(){return $this->profPic;}
    }
?>