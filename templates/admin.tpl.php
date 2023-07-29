<?php declare(strict_types = 1); ?>

<?php function drawUsers(array $users) { ?>
<div class="users_section">
    <div class="users_table">
        <h2>Users</h2>
        <ul>
            <li>ID</li>
            <li>Username</li>
            <li>Email</li>
            <li>Role</li>
        </ul>
    </div>
    <div class="user_instance">
        <?php foreach($users as $user) { ?>
            <a href="../pages/usermanagement.php?id=<?=$user->id?>"><ul>
                <li><?=$user->id?></li>
                <li><?=$user->username?></li>
                <li><?=$user->email?></li>
                <li><?=$user->role?></li>
            </ul></a>
        <?php } ?>
    </div>
</div>
<?php } ?>

<?php function drawElementSection(array $elements, string $element_designation) { ?>
<div class="element_section">
    <h2><?=$element_designation?> List</h2>
    <div class="element_lists">
    <?php foreach($elements as $elem) { ?>
        <p><?=$elem->name?></p>
    <?php } ?>
    </div>
    <form action="../actions/action_create_<?=$element_designation?>.php" method="POST">
        <label>
            New <?=$element_designation?> name
            <input type="text" name="<?=$element_designation?>_name" required>
            <button type="submit" name="submit_new_<?=$element_designation?>">Create</button>
        </label>
    </form>
</div>
<?php } ?>

<?php function drawUserInfo(User $user, array $dept_assigned, array $roles, array $departments) { ?>
    <p>User: <?=$user->username?> #<?=$user->id?></p>
    <p>Email: <?=$user->email?></p>
    <p>Role: <?=$user->role?></p>
    <?php if($user->role < 3) { ?>
        <p>Assigned Departments:</p>
        <?php foreach($dept_assigned as $dept) { ?>
            <p><?=$dept->name?></p>
        <?php } ?>
        <?php drawDepartmentAssign($user, $departments) ?>
    <?php } ?>
    <?php drawRoleChanger($user, $roles); ?>
    
<?php } ?>

<?php function drawRoleChanger(User $user, array $roles) { ?>
<form action="../actions/action_change_role.php?id=<?=$user->id?>" method="POST">
    <label>
        Change Role to
        <select name="role">
            <?php foreach($roles as $role) { ?>
                <option value=<?=$role->id?>><?=$role->name?></option>
            <?php } ?>
        </select>
    </label>
    <button type="submit" name="submit_role_change">Change Role</button>
</form>
    
<?php } ?>

<?php function drawDepartmentAssign(User $user, array $departments) { ?>
<form action="../actions/action_assign_department.php?id=<?=$user->id?>" METHOD="POST">
    <label>
        Assign to Department
        <select name="department">
            <?php foreach($departments as $dept) { ?>
                <option value=<?=$dept->id?>><?=$dept->name?></option>
            <?php } ?>
        </select>
    </label>
    <button type="submit" name="submit_department_assign">Assign Department</button>
</form>
<?php } ?>

