<?php  require "../connection.php"; 

    $succes = "";

    $termekid = $_GET["id"];

    if(isset($_POST["update"])){

        $termekkep = $_POST["termekkep"];
        $termeknev = $_POST["termeknev"];
        $termekar = $_POST["termekar"];
        $cikkszam = $_POST["cikkszam"];
        $keszlet = $_POST["keszlet"];
        $rleiras = $_POST["rleiras"];
        $hleiras = $_POST["hleiras"];

        $sql = "UPDATE termekek SET nev='$termeknev', ar='$termekar', cikkszam='$cikkszam', keszlet='$keszlet', rleiras='$rleiras', hleiras='$hleiras', kep='$termekkep' WHERE id='$termekid'";

        mysqli_query($con, $sql);

        $success = "Sikeres módositás!";

    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin termék módosítása</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Admin</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Kezdőoldal</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_feltolt.php">Termék feltöltése</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_rendeles.php">Rendelések áttekintése</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <div class="container">

        <h2 class="text-center my-4"> Termék modosítása</h2>

        <?php 
        
            if(isset($_GET["id"])){

                $termekid = $_GET["id"];

                $sql = "SELECT * FROM termekek WHERE id='$termekid'";

                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)){

                    ?>

                        <form action="" method="post" class="mx-auto w-75 text-center p-5">

                            <span class="d-block my-3 text-success"><?php if(!empty($success)){echo $success;} ?></span>

                            <label for="">Termékkép</label>
                            <input type="text" name="termekkep" class="form-control mb-3" value="<?php echo $row["kep"];?>">

                            <label for="">Terméknév</label>
                            <input type="text" name="termeknev" class="form-control mb-3" value="<?php echo $row["nev"];?>">

                            <label for="">Termékár</label>
                            <input type="text" name="termekar" class="form-control mb-3" value="<?php echo $row["ar"];?>">

                            <label for="">Cikkszám</label>
                            <input type="text" name="cikkszam" class="form-control mb-3" value="<?php echo $row["cikkszam"];?>">

                            <label for="">Készlet</label>
                            <input type="text" name="keszlet" class="form-control mb-3" value="<?php echo $row["keszlet"];?>">

                            <label for="">Termék Rövid leirása</label>
                            <input type="text" name="rleiras" class="form-control mb-3" value="<?php echo $row["rleiras"];?>">

                            <label for="">Termék részletes leirása</label>
                            <textarea name="hleiras" class="form-control mb-3" cols="30" rows="10"> <?php echo $row["hleiras"]?></textarea>

                            <button type="submit" name="update" class="btn btn-primary">Termék módosítása</button>

                        </form>


                    <?php
                }
            }
        
        
        ?>

    </div>

</body>
</html>