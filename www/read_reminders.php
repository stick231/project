<?php

use class\DataBase;
use class\User;

require_once "db.php";
require_once "user.php";

if ($_SERVER["REQUEST_METHOD"] === "GET") {

    $database = new DataBase();
    $db = $database->getConnection();

    $user = new User($db);

    if(isset($_GET["search"])){
        $search = $_GET["search"];

        $user->setSearch($search);
        $user->readReminders();
    }
    else{
        $user->readReminders();
    }
} else {
    echo "Недопустимый метод запроса";
    exit;
}
?>