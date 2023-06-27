<?php

    declare(strict_types = 1);

    class Role {
        public int $id;
        public string $name;

        public function __construct(int $id, string $name) {
            $this->id = $id;
            $this->name = $name;
        }

        static function getRoles(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM roles');
            $stmt->execute();

            $roles = array();

            while ($role = $stmt->fetch()){
                $roles[] = new Role($role['id'], $role['name']);
            }

            return $roles;
        }
    }
?>