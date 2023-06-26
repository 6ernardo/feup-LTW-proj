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
    <ul>
        <li><?=$ticket->subject?></li>
        <li><?=$ticket->department_id?></li>
        <li><?=$ticket->status_id?></li>
    </ul>
<?php } ?>
<?php } ?>