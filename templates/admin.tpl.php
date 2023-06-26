<?php declare(strict_types = 1); ?>

<?php function drawUsers(array $users) { ?>
<h2>Users</h2>
<ul>
    <li>ID</li>
    <li>Username</li>
    <li>Email</li>
    <li>Role</li>
</ul>
<?php foreach($users as $user) { ?>
    <ul>
        <li><?=$user->id?></li>
        <li><?=$user->username?></li>
        <li><?=$user->email?></li>
        <li><?=$user->role?></li>
    </ul>
<?php } ?>
<?php } ?>

<?php function drawElementSection(array $elements, string $element_designation) { ?>
<h2><?=$element_designation?> List</h2>
<?php foreach($elements as $elem) { ?>
    <?=$elem->name?>
<?php } ?>
<form action="../actions/action_create_<?=$element_designation?>.php" method="POST">
    <label>
        New <?=$element_designation?> name
        <input type="text" name="<?=$element_designation?>_name" required>
        <button type="submit" name="submit_new_<?=$element_designation?>">Create</button>
    </label>
</form>
<?php } ?>

