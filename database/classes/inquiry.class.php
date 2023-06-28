<?php
    declare(strict_types = 1);

    class Inquiry {
        public int $id;
        public int $ticket_id;
        public int $user_id;
        public string $content;

        public function __construct(int $id, int $ticket_id, int $user_id, string $content){
            $this->id = $id;
            $this->ticket_id = $ticket_id;
            $this->user_id = $user_id;
            $this->content = $content;
        }

        static function getTicketInquiries(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT * FROM ticket_inquiries WHERE ticket_id = ?');
            $stmt->execute(array($id));

            $inquiries = array();

            while($inq = $stmt->fetch()){
                $inquiries[] = new Inquiry($inq['id'], $inq['ticket_id'], $inq['user_id'], $inq['content']);
            }

            return $inquiries;
        }
    }

?>