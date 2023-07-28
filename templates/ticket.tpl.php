<?php 
declare(strict_types = 1); 
require_once('../database/classes/department.class.php');
require_once('../database/classes/status.class.php');
require_once('../database/classes/user.class.php');
?>

<?php function drawTicketSubmit(array $departments) { ?>
<div class="submit_ticket">
    <h2>Submit new Ticket</h2>
    <form action="../actions/action_submit_ticket.php" method="POST">
        <input type="text" name="subject" placeholder="Subject">
        <textarea name="content" rows="5" cols="50" placeholder="Content"></textarea>
        <label>
            Select Department
            <select name="department">
            <option value="" selected>Undefined Department</option>
            <?php foreach($departments as $dept) { ?>
                <option value="<?=$dept->id?>"><?=$dept->name?></option>
            <?php } ?>
            </select>
        </label>
        <button type="submit" name="submit_ticket">Submit Ticket</button>
    </form>
</div>
<?php } ?>

<?php function drawTickets(PDO $db, array $tickets) { ?>
<div class="ticket_tables">
    <h2>Your tickets</h2>
    <ul>
        <li>Subject</li>
        <li>Department</li>
        <li>Status</li>
        <li>Created</li>
        <li>Last Change</li>
    </ul>
</div>
<div class="ticket_instance">
    <?php foreach($tickets as $ticket) { ?>
        <a href="../pages/ticket.php?id=<?=$ticket->id?>"><ul>
            <li><?=$ticket->subject?></li>
            <li><?=Department::getDepartmentName($db, intval($ticket->department_id))?></li>
            <li><?=Status::getStatusName($db, intval($ticket->status_id))?></li>
            <li><?=$ticket->created?></li>
            <li><?=$ticket->updated ?? '-'?></li>
        </ul></a>
    <?php } ?>
</div>
<?php } ?>

<?php function drawAgentTickets(PDO $db, array $tickets, array $departments, array $status) { ?>
<div class="ticket_tables">
    <h2>Assigned tickets</h2>
    <ul>
        <li>Subject</li>
        <li>Department</li>
        <li>Status</li>
        <li>Created</li>
        <li>Last Change</li>
    </ul>
</div>
<div class="ticket_instance">
    <?php foreach($tickets as $ticket) { ?>
        <a href="../pages/ticket.php?id=<?=$ticket->id?>"><ul>
            <li><?=$ticket->subject?></li>
            <li><?=Department::getDepartmentName($db, intval($ticket->department_id))?></li>
            <li><?=Status::getStatusName($db, intval($ticket->status_id))?></li>
            <li><?=$ticket->created?></li>
            <li><?=$ticket->updated ?? '-'?></li>
        </ul></a>
    <?php } ?>
</div>
<form>
    <label>
        Filter by Department
        <select id="department">
            <option value="" selected>Any department</option>
            <?php foreach($departments as $dept) { ?>
                <option value="<?=$dept->id?>"><?=$dept->name?></option>
            <?php } ?>
        </select>
    </label>
    <label>
        Filter by Status
        <select id="status">
        <option value="" selected>Any status</option>
            <?php foreach($status as $st) { ?>
                <option value="<?=$st->id?>"><?=$st->name?></option>
            <?php } ?>
        </select>
    </label>
    <button type="submit" id="submit_ticket_filter">Filter</button>
</form>
<?php } ?>

<?php function drawTicketInfo(PDO $db, Ticket $ticket) { ?>
    <h2><?=$ticket->subject?></h2>
    <p><?=User::getUsername($db, intval($ticket->submitter_id))?></p>
    <p><?=$ticket->created?></p>
    <p><?=$ticket->updated ?? '-'?></p>
    <p><?=Department::getDepartmentName($db, intval($ticket->department_id))?></p>
    <p><?=Status::getStatusName($db, intval($ticket->status_id))?></p>
    <p><?=User::getUsername($db, intval($ticket->assignee_id)) ?? 'No assigned agent' ?></p>
    <p><?=$ticket->content?></p>
<?php } ?>

<?php function drawTicketInquirySection(Ticket $ticket, array $inquiries) { ?>
    <?php foreach($inquiries as $inq) { ?>
        <p><?=$inq->user_id?></p>
        <p><?=$inq->date?></p>
        <p><?=$inq->content?>
    <?php } ?>
    <form action="../actions/action_submit_inquiry.php?id=<?=$ticket->id?>" method="POST">
        <input type="text" name="inquiry" placeholder="Message..." required>
        <button type="submit" name="submit_inquiry">Send</button>
    </form>
<?php } ?>

<?php function drawAgentTicketTools(Ticket $ticket, array $departments, array $agents, array $faqs, array $statuses) { ?>
    <p><a href='../pages/tickethistory.php?id=<?=$ticket->id?>'>Ticket History</a></p>
    <form action="../actions/action_answer_faq.php?id=<?=$ticket->id?>" method="POST">
        <label>
            Answer with FAQ
            <select name="faq">
                <?php foreach($faqs as $faq) { ?>
                    <option value="<?=$faq->id?>"><?=$faq->question?></option>
                <?php } ?>
            </select>
            <button type="submit" name="submit_faq_inquiry">Send</button>
        </label>
    </form>
    <form action="../actions/action_change_department.php?id=<?=$ticket->id?>" method="POST">
        <label>
            Change to Department
            <select name="department">
                <?php foreach($departments as $dept) { ?>
                    <option value="<?=$dept->id?>"><?=$dept->name?></option>
                <?php } ?>
            </select>
            <button type="submit" name="submit_dept_change">Change</button>
        </label>
    </form>
    <form action="../actions/action_assign_agent.php?id=<?=$ticket->id?>" method="POST">
        <label>
            Assign to Agent
            <select name="agent">
                <?php foreach($agents as $agent) { ?>
                    <option value="<?=$agent->id?>"><?=$agent->username?></option>
                <?php } ?>
            </select>
            <button type="submit" name="submit_agent_assign">Assign</button>
        </label>
    </form>
    <form action="../actions/action_change_status.php?id=<?=$ticket->id?>" method="POST">
        <label>
            Change Status
            <select name="status">
                <?php foreach($statuses as $status) { ?>
                    <option value="<?=$status->id?>"><?=$status->name?></option>
                <?php } ?>
            </select>
        </label>
        <button type="submit" name="submit_status_change">Change</button>
    </form>
<?php } ?>

<?php function drawTicketHistory(Ticket $ticket, array $history) { ?>
    <h2><?=$ticket->subject?></h2>
    <p>Ticket #<?=$ticket->id?></p>
    <?php foreach($history as $change) {?>
        <p><?=$change['date']?></p>
        <p><?=$change['changed_field']?></p>
    <?php } ?>
<?php } ?>