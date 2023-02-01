<?php   

    require "../connection.php";

    $error = "";
    $success = "";

    if(isset($_POST["upload"])){

        $target = "../img/".$_FILES["termekkep"]["name"];
        $termekkep = $_FILES["termekkep"]["name"];
        $termeknev =$_POST["termeknev"];
        $termekar = $_POST["termekar"];
        $kategoria = $_POST["kategoria"];
        $cikkszam = $_POST["cikkszam"];
        $keszlet = $_POST["keszlet"];
        $rleiras = $_POST["rleiras"];
        $hleiras = $_POST["hleiras"];

        if(empty($termekkep) || empty($termeknev) || empty($termekar) || empty($cikkszam) || empty($keszlet) || empty($rleiras) || empty($hleiras)){

            $error = "Minden mező kitöltése kötelező";
        }
        else{

            $sql = "INSERT INTO termekek(kategoria,nev,cikkszam,ar,rleiras,hleiras,kep,keszlet) VALUES('$kategoria', '$termeknev', '$cikkszam', '$termekar', '$rleiras', ' $hleiras', '$termekkep', '$keszlet')";
            

            mysqli_query($con, $sql);

            move_uploaded_file($_FILES["termekkep"] ["tmp_name"], $target);

            $success = "Sikeres feltöltés!";
        }
    }




?>







<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>PHP Webshop - Admin</title>
</head>
<body>
    <div class="container">
        <form action="" method="post" class="mx-auto w-50 p-5 shadow-sm text-center" enctype="multipart/form-data">

            <h2 class="mb-3">Termék feltöltése</h2>

            <h5 class="text-success mb-3"> <?php if(!empty($success)){echo $success;} ?></h5>
            <h5 class="text-danger mb-3"> <?php if(!empty($error)){echo $error;} ?></h5>
            
            <label>Termékkép</label>
            <input type="file" name="termekkep" class="form-control my-2">

            <label>Terméknév</label>
            <input type="text" name="termeknev" class="form-control my-2">

            <label>Termékár</label>
            <input type="text" name="termekar" class="form-control my-2">

            <label>Kategória</label>
            <select name="kategoria" class="form-control my-2">
                <option value="1">Számítógép</option>
                <option value="2">HP</option>
                <option value="3">DELL</option>
                <option value="4">ASUS</option>
                <option value="5">LENOVO</option>
                <option value="6">APPLE</option>
                <option value="7">TOSHIBA</option>
            </select>

            <label>Cikkszám</label>
            <input type="text" name="cikkszam" class="form-control my-2">


            <label>Készlet</label>
            <input type="text" name="keszlet" class="form-control my-2">

            <label>Termék rövid leirása</label>
            <input type="text" name="rleiras" class="form-control my-2">

            <label>Termék részletes leirása</label>
            <textarea name="hleiras"  cols="30" rows="10" class="form-control my-2"></textarea>

            <button class="btn btn-primary" name="upload">Termék feltöltése</button>
        </form>
    </div>
</body>
</html>