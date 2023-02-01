<?php  require "../connection.php"; 

    $success = "";

    $termekid = $_GET["id"];

    if(isset($_POST["delete"])){

        $sql = "DELETE FROM termekek WHERE id='$termekid'";

        mysqli_query($con, $sql);

        $success = "termek törölve!";

        echo "<META HTTP-EQUIV=Refresh CONTENT='3; URL=index.php' />";
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
    <title>Admin </title>
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

        <h2 class="text-center my-3">Termék törlése</h2>

        <span class="d-block text-succes mb-3 text-center" ><?php if(!empty($success)){echo $success;} ?></span>

        <table class="table table-light text-center mb-3 w-100 mx-auto">

            <tr>
                <th>Termmék Kép</th>
                <th>Termék Id</th>
                <th>Termék Név</th>
                <th>Termék Cikkszám</th>
                <th>Termék Ár</th>
                <th>Termék Készlet</th>
            </tr>


            <?php 
            
                if(isset($_GET["id"])){

                    $termekid = $_GET["id"];

                    $sql = "SELECT * FROM termekek WHERE id='$termekid'";

                    $result = mysqli_query($con, $sql);
                    
                    while($row = mysqli_fetch_array($result)){

                    $kep = $row["kep"];
                    $termekid = $row["id"];
                    $nev = $row["nev"];
                    $cikkszam = $row["cikkszam"];
                    $ar = $row["ar"];
                    $keszlet = $row["keszlet"];

                    echo "
                        <tr class='text-center'>
                            <td>
                                <img src='../img/$kep' alt='$kep' title='$kep' style='height: 75px; width : 120px;'/>
                            </td>
                            <td>".$termekid."</td>
                            <td>".$nev."</td>
                            <td>".$cikkszam."</td>
                            <td>".number_format($ar,0,".",".")." Ft</td>
                            <td>".$keszlet."</td>
                            
                        </tr>
                    
                    ";
                    }
                }
            
            ?>

        </table>

        <form action="" method="post" class="text-center">
            <button type="submit" name="delete" class="btn btn-danger">Termék törlése</button>
        </form>


    </div>


</body>
</html>