<?php
    declare(strict_types = 1);

    require_once('department.class.php');

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

        static function getTicket(PDO $db, int $id) : ?Ticket {
            $stmt = $db->prepare('SELECT * FROM tickets WHERE id = ?');
            $stmt->execute(array($id));

            $ticket = $stmt->fetch();

            if($ticket){
                return new Ticket($ticket['id'], $ticket['subject'], $ticket['content'], $ticket['submitter_id'], $ticket['assignee_id'], $ticket['department_id'], $ticket['status_id']);
            }
            else return null;
        }

        static function getDepartmentTickets(PDO $db, int $dept) : array {
            $stmt = $db->prepare('SELECT * FROM tickets WHERE department_id = ?');
            $stmt->execute(array($dept));

            $tickets = array();

            while($ticket = $stmt->fetch()){
                $tickets[] = new Ticket($ticket['id'], $ticket['subject'], $ticket['content'], 
                $ticket['submitter_id'], $ticket['assignee_id'], 
                $ticket['department_id'], $ticket['status_id']);
            }

            return $tickets;
        }

        // Tickets assigned to agent, and tickets of departments the agent is assigned to
        static function getAgentTickets(PDO $db, int $agent) : array {
            $stmt = $db->prepare('SELECT t.id, t.subject, t.content, t.submitter_id, t.assignee_id, t.department_id, t.status_id 
                                FROM tickets t LEFT JOIN departments d ON t.department_id = d.id LEFT JOIN agent_departments ad 
                                ON ad.department_id = d.id WHERE (ad.agent_id = ? OR t.assignee_id = ?)');
            $stmt->execute(array($agent, $agent));

            $tickets = array();

            
            while($ticket = $stmt->fetch()){
                $tickets[] = new Ticket($ticket['id'], $ticket['subject'], $ticket['content'], 
                                        $ticket['submitter_id'], $ticket['assignee_id'], 
                                        $ticket['department_id'], $ticket['status_id']);
            }

            return $tickets;
        }
    }

?>