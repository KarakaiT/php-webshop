<?php require "header.php";  ?>

<div id="top">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php";  ?>
</div>

<div id="right">
   <h2>Megrendelés összesítése</h2>

   <table align="center" width="80%" cellpadding="8">
        <tr>
            <th>Azonosító</th>
            <th>Terméknév</th>
            <th>Bruttó ár</th>
            <th>Darabszám</th>
            <th>Cikkszam</th>
            <th>Érték</th>
        </tr>

        <?php

            $vegosszeg = 0;

            if(isset($_SESSION["cart"])){

                foreach($_SESSION["cart"] as $product_id => $db){

                    $sql = "SELECT * FROM termekek WHERE id='$product_id'";

                    $result = mysqli_query($con, $sql);

                    while($row = mysqli_fetch_array($result)){

                        $termeknev = $row["nev"];
                        $bruttoar = $row["ar"];
                        $cikkszam = $row["cikkszam"];
                        $ertek = $bruttoar * $db;

                        echo "

                            <tr align='center'>
                                <td>".$product_id."</td>
                                <td>".$termeknev."</td>
                                <td>".number_format($bruttoar,0,".",".")." Ft</td>
                                <td>".$db."</td>
                                <td>".$cikkszam."</td>
                                <td>".number_format($ertek,0,".",".")." Ft</td>

                            </tr>
                        
                        ";

                        $vegosszeg += $ertek;
                    }
                }
            }

        ?>

        <tr>
            <td colspan="7" align="right">
                <strong>Végösszeg: </strong> <?php echo number_format($vegosszeg,0,".",".") ?> Ft
            </td>
        </tr>

   </table>




   <?php

        $error = "";
        $error2 = "";

        if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 1)){

            $nev = $_POST["nev"];
            $email = $_POST["email"];
            $telefon = $_POST["telefon"];
            $szcim = $_POST["szcim"];
            $szmod = $_POST["szmod"];
            $fizmod = $_POST["fizmod"];

            if(empty($nev) || empty($email) || empty($telefon) || empty($szcim)){

                $error = "Rendelés leadásához minden mező kitöltése kötelező!";
            }
            else{

                $sql = "INSERT INTO vevok(nev,email,cim,telefon,szcim) VALUES('$nev', '$email', '$szcim', '$telefon', '$szcim')";

                mysqli_query($con, $sql);


                $utolsovevoid = "SELECT id FROM vevok ORDER BY id DESC LIMIT 1";

                $result = mysqli_query($con, $utolsovevoid);

                $get_vevoid = mysqli_fetch_array($result);

                $vevoid = $get_vevoid[0];


                $sql2 = "INSERT INTO rendelesek(vevoid,szallitas,fizmod,datum,statusz,bosszeg) VALUES ('$vevoid','$szmod', '$fizmod', NOW(), 'függöben', '$vegosszeg') ";

                mysqli_query($con, $sql2);

                $utolsorendelesid = "SELECT id FROM rendelesek ORDER BY id DESC LIMIT 1";

                $result2 = mysqli_query($con, $utolsorendelesid);

                $get_rendelesid = mysqli_fetch_array($result2);

                $rendelesid = $get_rendelesid[0];

                foreach($_SESSION["cart"] as $product_id => $db){

                    $sql3 = "INSERT INTO rend_term(rendelesid,termekid,db) VALUES('$rendelesid', '$product_id', '$db') ";

                    mysqli_query($con, $sql3);

                    $sql4 = "UPDATE termekek SET keszlet=keszlet-'$db' WHERE id='$product_id'";
                    mysqli_query($con, $sql4);
                }

                echo "<h3 style='color: green; text-align: center;'>Rendelésed sikeresen rögzitettük</h3>";
                unset($_SESSION["cart"]);

                echo "<META HTTP-EQUIV=Refresh CONTENT='1; URL=megrendeles.php' />";
            }
        }

        else if(isset($_POST["megrendel"]) && (isset($_POST["check"]) == 0)){

            $error2 = "Vásárlási feltételek elfogadása kötelező!";

            $nev = $_POST["nev"];
            $email = $_POST["email"];
            $telefon = $_POST["telefon"];
            $szcim = $_POST["szcim"];
        
            if(empty($nev) || empty($email) || empty($telefon) || empty($szcim)){

                $error = "Rendelés leadásához minden mező kitöltése kötelező!";
            }
        }



   ?>


   <div id="megrendeles">
            
        <form action="" method="post">
            <h4> <?php if(!empty($error)){echo $error;} ?> </h4>

            <input type="text" name="nev" placeholder="Teljes név...">
            <input type="email" name="email" placeholder="E-mail cím...">
            <input type="text" name="telefon" placeholder="Telefonszám (+36 30 123 4567) ...">
            <input type="text" name="szcim" placeholder="Szállítási cím (irsz,város,utca,házszám) ...">

            <select name="szmod" >
                <option value="gls">GLS futár</option>
                <option value="posta-utanvet">Postai utánvét</option>
                <option value="szemelyes">Személyes átvétel</option>
            </select>

            <select name="fizmod" >
                <option value="obk">Online bankkártya</option>
                <option value="utanvet">Utnávét</option>
                <option value="atutalas">Átutalás</option>
            </select>

            <h4> <?php if(!empty($error2)){echo $error2;} ?> </h4>
            <p> <a href="tajekoztato.php">Elfogadom a vásárlási feltételeket</a> </p>

            <input type="checkbox" name="check">

            <button type="submit" name="megrendel" class="megrendeles">Rendelés leadása</button>

        </form>
   </div>
</div>

</body>
</html>