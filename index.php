<?php
    session_start();
    $username = "Andre";
    $password = "password";

    if (isset($_POST['username'])) 
    {
        if ($username == $_POST['username'])
        {
            echo "Username Confirmado <br>";

            if ($password == $_POST['password'])
            {    
                echo $password ."-". $_POST['password'];
                $_SESSION['username'] = $_POST['username'];
                header("Location: http://127.0.0.1/ti/dashboard.php");
            }
            else
            {
                echo "Password Errada <br>";
            }
        }
        else
        {
            echo "Username Errado";
        }
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    
    <div class="container" style="width:50%">
        
        <form method="POST" style="width:350px; padding:15px; margin: 0 auto" class="was-validated">
        <a href="#"> <img src="Ficheiros(img, vid, etc)/estg.png" alt=""> </a>
            <div class="form-group">
                <label for="usr">Name:</label>
                <input type="text" class="form-control" id="usr" name="username" placeholder="Escreva o username" required>
            </div>
            <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd" name="password" placeholder="Escreva a password" required>
            </div>
            <button type="submit"  class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>