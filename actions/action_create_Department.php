<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    $db = getDatabaseConnection();

    require_once(__DIR__ . '/../database/classes/department.class.php');

    $name = $_POST['Department_name'];

    if(Department::departmentNameAvailable($db, $name)){
        $stmt = $db->prepare('INSERT INTO departments (name) VALUES (?)');
        $stmt->execute(array($name));

        $session->addMessage('success', 'Department created with success!');
    }
    else $session->addMessage('error', 'Department with same name already exists.');

    header('Location: ../pages/admindashboard.php')
?>