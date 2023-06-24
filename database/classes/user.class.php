<?php
    declare(strict_types = 1);

    class User {
        public int $id;
        public string $username;
        public string $email;
        public int $role;

        public function __construct(int $id, string $username, string $email, int $role){
            $this->id = $id;
            $this->username = $username;
            $this->email = $email;
            $this->role = $role;
        }

        static function usernameAvailable(PDO $db, string $username) : bool {
            $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute(array($username));
            $count = $stmt->fetchColumn();

            return ($count > 0);
        }

        static function getUserWithPassword(PDO $db, string $username, string $password) : ?User {
            $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
            $stmt->execute(array($username));
            
            $user = $stmt->fetch();

            if($user && password_verify($password, $user['password'])){
                return new User($user['id'], $user['username'], $user['email'], $user['role_id']);
            }
            else return null;
        }
    }
?>