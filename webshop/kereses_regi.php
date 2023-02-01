<?php require "header.php"; ?>

<div id="top">
    <img id="logo" src="" alt="">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php"; ?>
</div>

<div id="right">
    <form action="" method="post">
        <h2>Írja be a termék nevét!</h2>
        <input type="text" name="termeknev" id="kereses">
        <button type="submit" name="search">Keresés</button>
    </form>

    <div class="products-container">
    <?php

        if(isset($_POST["search"])){

            $termeknev = $_POST["termeknev"];

            $sql = "SELECT * FROM termekek WHERE nev LIKE '%$termeknev%'";

            $result = mysqli_query($con, $sql);

            if(mysqli_num_rows($result) > 0){

                while($row = mysqli_fetch_array($result)){

                    $id = $row["id"];
                    $termeknev = $row["nev"];
                    $termekar = $row["ar"];
                    $termekkep = $row["kep"];
                    $keszlet = $row["keszlet"];
        
                    echo "
                    <div class='termekdoboz'>

                        <div class='termekkep'>
                            <a href='termek.php?termekid=$id'>
                                <img src='img/$termekkep' alt='$termekkep' title='$termekkep' />
                            </a>
                        </div>

                        <div class='termeknev'>
                            <h3>".$termeknev."</h3>
                        </div>

                        <div class='keszlet'>
                            <p>Készlet: ".$keszlet."db</p>
                        </div>

                        <div class='termekar'>
                            <h4>".number_format($termekar,0,".",".")." Ft</h4>
                        </div>

                        <div class='termekkosar'>
                            <a href='kosarmuvelet.php?id=$id&action=add'>Kosárba</a>
                        </div>

                    </div>
                    ";
                }
            }
            else{

                echo "<h3>Nincs ilyen termék az adatbázisban!</h3>";
            }
        }

    ?>
    </div>
</div>

</body>
</html>