<?php
require_once __DIR__ . '/../vendor/autoload.php'; 

setcookie("register", 'false', time() + 3600 * 24 * 30, "/");

if (isset($_SESSION["login"])) {
    header("location: /");
    exit;
}

if (isset($_SESSION['auth_error'])) {
    $response = $_SESSION['auth_error'];
    unset($_SESSION['auth_error']); 
}

?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles_user.css">
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300..700&display=swap" rel="stylesheet">
    <title>Вход</title>
</head>
<body>
    <div id="container">
    <form id="Form" method="post" action="/auth-active">
        <h1>Вход в аккаунт</h1>
        <?php if (isset($response)) echo "<p>$response</p>";?>
        <input type="text" id="username" name="login" placeholder="Логин..">
        <br>
        <input type="password" id="password" placeholder="Пароль.." name="password">
        <br>
        <a id="link">Еще не регистрировался</a>
        <button type="submit" id="submit">Войти</button>
    </form>
    </div>
    <script>
        document.getElementById("link").addEventListener("click", () => {
            fetch("/register?register=false", {
                method: "GET",
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
            })
            .then(response => {
                if (response.ok) {
                    console.log("Перенаправление на регистрацию");
                    setTimeout(() => {
                        window.location = "/register";
                    }, 500);
                } else {
                    console.error("Ошибка при перенаправлении:", response.status);
                }
            })
            .catch(error => {
                console.error("Ошибка при выполнении запроса:", error);
            });
        });

        function CheckInp(){
            const inpUsername = document.getElementById("username");
            const inpPassword = document.getElementById("password");
    

            if(inpUsername.value == null || inpUsername.value == ""){
                alert("Введите имя пользователя")
                return false;
            }

            if(inpPassword.value == null || inpPassword.value == ""){
                alert("Введите пароль")
                return false;
            }

            return true;
        }

        document.getElementById("submit").addEventListener("click", () =>{
            if (!CheckInp()) {
                event.preventDefault();
            }
        })
    </script>
</body>
</html>