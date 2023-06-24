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

        public function getID() : ?int {
            return isset($_SESSION['id']) ? $_SESSION['id'] : null;
        }

        public function getUsername() : ?int {
            return isset($_SESSION['username']) ? $_SESSION['username'] : null;
        }

        public function getRole() : ?int {
            return isset($_SESSION['role']) ? $_SESSION['role'] : null;
        }

        public function setID(int $id) {
            $_SESSION['id'] = $id;
        }

        public function setUsername(string $username) {
            $_SESSION['username'] = $username;
        }

        public function setRole(int $role) {
            $_SESSION['role'] = $role;
        }

    }
