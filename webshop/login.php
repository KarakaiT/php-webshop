<?php 

    session_start();

    $_SESSION["logged"] = false;




    require "connection.php"; 

    $error = "";
    $success = "";

    if(isset($_POST["bej"])){

    $user = $_POST["user"];
    $jelszo = sha1($_POST["jelszo"]);

    if(empty($user) || empty($jelszo)){

        $error = "Mindkét mező kitöltése kötelező!";
    }
    else{

        $con = mysqli_connect(host,user,pwd,dbname);
        mysqli_query($con, "SET NAMES utf8");

        $sql = "SELECT user,pwd FROM adatok WHERE user='$user' AND pwd='$jelszo'";

        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){


            $_SESSION["logged"] = true;
            $_SESSION["logged"] = $user;
            header("Location: index.php");
        }
        else{

            $error = "Hibás felhasználónév vagy jelszó!";
        }
    }
    
}
?>



<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Webshop - Bejelentkezés</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="text-center w-50 mx-auto p-5 shadow-lg">
            <h2 class="mb-5">Webshop - Bejelentkezés</h2>

            <span class="text-danger mb-3 d-block"><?php if(!empty($error)){echo $error;}  ?></span>
            <span class="text-success mb-3 d-block"><?php if(!empty($success)){echo $success;}  ?></span>

            <label>Felhasználónév</label>
            <input type="text" name="user" class="form-control mb-3">

            <label>Jelszó</label>
            <input type="password" name="jelszo" class="form-control my-3">

            <button class="btn btn-success" name="bej">Bejelentkezés</button>

            <p>Még nincs fiokód?<a href="reg.php">Regisztrálj!</a></p>
        </form>
    </div>
</body>
</html>