<?php
    declare(strict_types = 1);

    class Department {
        public int $id;
        public string $name;

        public function __construct(int $id, string $name) {
            $this->id = $id;
            $this->name = $name;
        }

        static function getDepartments(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM departments');
            $stmt->execute();

            $departments = array();

            while ($department = $stmt->fetch()){
                $departments[] = new Department($department['id'], $department['name']);
            }

            return $departments;
        }

        static function departmentNameAvailable(PDO $db, string $name) : bool {
            $stmt = $db->prepare('SELECT * FROM departments WHERE name = ?');
            $stmt->execute(array($name));
            $count = $stmt->fetchColumn();

            return ($count == 0);
        }
    }
?>