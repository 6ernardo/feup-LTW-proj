<?php
    declare(strict_types = 1);

    class Status {
        public int $id;
        public string $name;

        public function __construct(int $id, string $name){
            $this->id = $id;
            $this->name = $name;
        }

        static function getAllStatus(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM status');
            $stmt->execute();

            $statuses = array();

            while($status = $stmt->fetch()){
                $statuses[] = new Status($status['id'], $status['name']);
            }

            return $statuses;
        }

        static function getStatusName(PDO $db, int $id) : string {
            $stmt = $db->prepare('SELECT * FROM status WHERE id = ?');
            $stmt->execute(array($id));

            $status = $stmt->fetch();

            if($status){
                return $status['name'];
            }
            else return 'No defined Status';
        }

        static function statusNameAvailable(PDO $db, string $name) : bool {
            $stmt = $db->prepare('SELECT * FROM status WHERE name = ?');
            $stmt->execute(array($name));
            $count = $stmt->fetchColumn();

            return ($count == 0);
        }
    }
?>