<?php

use class\DataBase;
use class\User;

require_once "db.php";
require_once "user.php";


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    $reminderTime = isset($_POST["reminder_time"]) ? $_POST["reminder_time"] : null;


    $database = new DataBase();
    $db = $database->getConnection();

    $user = new User($db);

    $user->setId($id);
    $user->setTitle($title);
    $user->setContent($content);
    if($reminderTime !== null){
        $user->setReminderTime($reminderTime);
    }

    $user->update();
}
?>