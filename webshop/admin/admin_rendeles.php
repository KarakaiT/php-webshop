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

    <h1 class="text-center mt-5 mb-5">Összes Termék!</h1>



    <table class="table table-striped text-center shadow-lg ">
        <tr>
            <th>Vevő Azonosító</th>
            <th>Vevő Név</th>
            <th>Vevő e-mail cím</th>
            <th>Vevő cím</th>
            <th>Szállitási mód</th>
            <th>Fizetési mód</th>
            <th>Dátum</th>
            <th>Státusz</th>
            <th>Db</th>
            <th>Termék név</th>
            <th>Végösszeg</th>
        </tr>

        <?php


                $sql = "SELECT vevok.id,vevok.nev,vevok.email,vevok.cim,rendelesek.szallitas,rendelesek.fizmod,rendelesek.datum,rendelesek.statusz,rendelesek.bosszeg, rend_term.db, termekek.nev FROM vevok,rendelesek,rend_term,termekek WHERE vevok.id=rendelesek.vevoid AND rendelesek.id=rend_term.rendelesid AND rend_term.termekid=termekek.id ORDER BY vevok.id;";

                $result = mysqli_query($con, $sql);

                while($row = mysqli_fetch_array($result)){

                    $vevoid = $row["id"];
                    $nev = $row["nev"];
                    $email = $row["email"];
                    $cim = $row["cim"];
                    $szallitas = $row["szallitas"];
                    $fizmod = $row["fizmod"];
                    $datum = $row["datum"];
                    $statusz = $row["statusz"];
                    $bosszeg = $row["bosszeg"];
                    $db = $row["db"];
                    $termeknev = $row["nev"];

                    echo "
                        <tr class='text-center'>

                            <td>".$vevoid."</td>
                            <td>".$nev."</td>
                            <td>".$email."</td>
                            <td>".$cim."</td>
                            <td>".$szallitas."</td>
                            <td>".$fizmod."</td>
                            <td>".$datum."</td>
                            <td>".$statusz."</td>
                            <td>".$db."</td>
                            <td>".$nev."</td>
                            <td>".number_format($bosszeg,0,".",".")." Ft</td>

                        </tr>
                    
                    ";
                }
            ?>
    </table>

    </div>



</body>
</html>