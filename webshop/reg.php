<?php require "connection.php"; 

    $error = "";
    $success = "";

    if(isset($_POST["reg"])){

    $user = $_POST["user"];
    $email = $_POST["email"];
    $jelszo = $_POST["jelszo"];

    if( empty($user) || empty($email) || empty($jelszo)){

        $error = "Regisztráciohoz minden mező kitöltése kötelező!";
    }
    else if(strlen($jelszo) < 8){

        $error= "A jelszó hossza min. 8karakter legyen!";

    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){

        $error = "Nem megfelelő e-mail formátum!";

    }
    else{


        $user_exist = "SELECT user FROM adatok WHERE user='$user'";

        $user_result = mysqli_query($con, $user_exist);

        if(mysqli_num_rows($user_result) == 1){

            $error = "A felhasználónév már foglalt!";
        }
        else{

            $sql = "INSERT INTO adatok(user,email,pwd) VALUES('$user','$email', sha1('$jelszo'))";

            mysqli_query($con, $sql);

            $success = "Sikeres regisztráció!";

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
    <title>Webshop - Regisztráció</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="text-center w-50 mx-auto p-5 shadow-lg">
            <h2 class="mb-5">Webshop - Regisztráció</h2>

            <span class="text-danger mb-3 d-block"><?php if(!empty($error)){echo $error;}  ?></span>
            <span class="text-success mb-3 d-block"><?php if(!empty($success)){echo $success;}  ?></span>

            <label>Felhasználónév:</label>
            <input type="text" name="user" class="form-control mb-3">

            <label>Email-cím:</label>
            <input type="email" name="email" class="form-control mb-3">

            <label>Jelszó:</label>
            <input type="password" name="jelszo" class="form-control">
            <small class="form-text mb-3 d-block">A jelszó hossza min. 8 karakter legyen!</small>

            <button class="btn btn-primary" name="reg">Regisztráció</button>

            <p>Van már fiokod?<a href="login.php">Jelentkezz be!</a></p>
        </form>
    </div>
</body>
</html>