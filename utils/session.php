<?php
    class Session {
        private array $messages;
        
        public function __construct(){
            session_start();

            $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
            unset($_SESSION['messages']);
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

        public function getUsername() : ?string {
            return isset($_SESSION['username']) ? $_SESSION['username'] : null;
        }

        public function getRole() : ?int {
            return isset($_SESSION['role']) ? $_SESSION['role'] : null;
        }

        public function getEmail() : ?string {
            return isset($_SESSION['email']) ? $_SESSION['email'] : null;
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

        public function setEmail(string $email) {
            $_SESSION['email'] = $email;
        }

        public function addMessage(string $type, string $text) {
            $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
        }
      
        public function getMessages() {
            return $this->messages;
        }
    }
