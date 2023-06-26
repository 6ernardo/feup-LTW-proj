<?php
    declare(strict_types = 1);

    class Ticket {
        public int $id;
        public string $subject;
        public ?string $content;
        public int $submitter_id;
        public ?int $assignee_id;
        public ?int $department_id;
        public int $status_id;

        public function __construct(int $id, string $subject, ?string $content, int $submitter_id, 
                                    ?int $assignee_id, $department_id, int $status_id) {
            $this->id = $id;
            $this->subject = $subject;
            $this->content = $content;
            $this->submitter_id = $submitter_id;
            $this->assignee_id = $assignee_id;
            $this->department_id = $department_id === "" ? null : $department_id;
            $this->status_id = $status_id;
        }

        static function getUserTickets(PDO $db, int $user_id) : array {
            $stmt = $db->prepare('SELECT * FROM tickets WHERE submitter_id = ?');
            $stmt->execute(array($user_id));

            $tickets = array();

            while ($ticket = $stmt->fetch()) {
                $tickets[] = new Ticket($ticket['id'], $ticket['subject'], $ticket['content'], 
                                        $ticket['submitter_id'], $ticket['assignee_id'], 
                                        $ticket['department_id'], $ticket['status_id']);
            }

            return $tickets;
        }

    }

?>