<?php  require "../connection.php"; ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Admin</title>
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
          <a class="nav-link" href="#">Kezdőoldal</a>
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


    <h1 class="text-center mt-5 mb-5">Összes Termék!</h1>

    <table class="table table-striped text-center shadow-lg ">
        <tr>
            <th>Termmék Kép</th>
            <th>Termék Id</th>
            <th>Termék Kategória</th>
            <th>Termék Név</th>
            <th>Termék Cikkszám</th>
            <th>Termék Ár</th>
            <th>Termék Készlet</th>
            <th>Termék Rövid Leirás</th>
            <th>Termék Hosszú Leirás</th>
            <th>Műveletek</th>
        </tr>

        <?php


                $sql = "SELECT * FROM termekek ORDER BY id";

                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)){

                    $kep = $row["kep"];
                    $id = $row["id"];
                    $nev = $row["nev"];
                    $kategoria = $row["kategoria"];
                    $cikkszam = $row["cikkszam"];
                    $ar = $row["ar"];
                    $rleiras = $row["rleiras"];
                    $hleiras = $row["hleiras"];
                    $keszlet = $row["keszlet"];

                    echo "
                        <tr class='text-center'>
                            <td>
                                <img src='../img/$kep' alt='$kep' title='$kep' style='height: 75px; width : 120px;'/>
                            </td>
                            <td>".$id."</td>
                            <td>".$kategoria."</td>
                            <td>".$nev."</td>
                            <td>".$cikkszam."</td>
                            <td>".number_format($ar,0,".",".")." Ft</td>
                            <td>".$keszlet."</td>
                            <td>".$rleiras."</td>
                            <td>".$hleiras."</td>
                            <td>
                                <a href='admin_modosit.php?id=$id' class='text-dark'><i class='fa-solid fa-pen-to-square'></i></a>
                                <a href='admin_torol.php?id=$id' class='text-dark'><i class='fa-solid fa-xmark'></i></a>
                            </td>
                        </tr>
                    
                    ";
                }
            ?>
    </table>



</body>
</html>