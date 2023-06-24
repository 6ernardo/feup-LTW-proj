<?php
    class Session {
        
        public function __construct(){
            session_start();
        }

        public function isLoggedIn() : bool {
            return isset($_SESSION['id']);
        }

        public function logout(){
            session_destroy();
        }

    }
?>