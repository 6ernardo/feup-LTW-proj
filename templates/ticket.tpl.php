<?php declare(strict_types = 1); ?>

<?php function drawTicketSubmit(array $departments) { ?>
<form action="../actions/action_submit_ticket.php" method="POST">
    <label>
        Subject
        <input type="text" name="subject">
    </label>
    <label>
        Content
        <textarea name="content" rows="5" cols="50"></textarea>
    </label>
    <label>
        Department
        <select name="department">
            <option value="" selected>Undefined Department</option>
            <?php foreach($departments as $dept) { ?>
                <option value="<?=$dept->id?>"><?=$dept->name?></option>
            <?php } ?>
        </select>
    </label>
    <button type="submit" name="submit_ticket">Submit Ticket</button>
</form>
<?php } ?>

<?php function drawTickets(array $tickets) { ?>
<h2>Your tickets</h2>
<ul>
    <li>Subject</li>
    <li>Department</li>
    <li>Status</li>
</ul>
<?php foreach($tickets as $ticket) { ?>
    <ul><a href="../pages/ticket.php?id=<?=$ticket->id?>">
        <li><?=$ticket->subject?></li>
        <li><?=$ticket->department_id?></li>
        <li><?=$ticket->status_id?></li>
    </a></ul>
<?php } ?>
<?php } ?>

<?php function drawAgentTickets(array $tickets) { ?>
<h2>Assigned tickets</h2>
<ul>
    <li>Subject</li>
    <li>Department</li>
    <li>Status</li>
</ul>
<?php foreach($tickets as $ticket) { ?>
    <ul><a href="../pages/ticket.php?id=<?=$ticket->id?>">
        <li><?=$ticket->subject?></li>
        <li><?=$ticket->department_id?></li>
        <li><?=$ticket->status_id?></li>
    </a></ul>
<?php } ?>
<?php } ?>

<?php function drawTicketInfo(Ticket $ticket) { ?>
    <h2><?=$ticket->subject?></h2>
    <p><?=$ticket->submitter_id?></p>
    <p><?=$ticket->department_id?></p>
    <p><?=$ticket->status_id?></p>
    <p><?=$ticket->assignee_id?></p>
    <p><?=$ticket->content?></p>
<?php } ?>

<?php function drawTicketInquirySection(Ticket $ticket, array $inquiries) { ?>
    <?php foreach($inquiries as $inq) { ?>
        <p><?=$inq->user_id?></p>
        <p><?=$inq->content?>
    <?php } ?>
    <form action="../actions/action_submit_inquiry.php?id=<?=$ticket->id?>" method="POST">
        <input type="text" name="inquiry" placeholder="Message..." required>
        <button type="submit" name="submit_inquiry">Send</button>
    </form>
<?php } ?>

<?php function drawAgentTicketTools(Ticket $ticket, array $departments, array $agents, array $faqs) { ?>
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
<?php } ?>