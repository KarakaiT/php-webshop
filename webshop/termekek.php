<?php require "header.php";  ?>

<div id="top">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php";  ?>
</div>

<div id="right">
    <div id="sort">
        <a href="termekek.php?sort=price_asc"> <i class="fa-solid fa-arrow-up"></i> </a>
        <a href="termekek.php?sort=price_desc"> <i class="fa-solid fa-arrow-down"></i> </a>
        <a href="termekek.php?sort=newest"> <i class="fa-regular fa-calendar"></i> </a>
        <a href="termekek.php?sort=best"> <i class="fa-regular fa-star"></i> </a>
    </div>
    <div class="products-container">
    <?php

        //Megnézem, hogy az urlbe van-e eltárolva kategória id -> valamelyik kategóriára kattintva érkeztem emg a termékek oldalra
        if(isset($_GET["katid"])){

            $katid = $_GET["katid"];

            $sql = "SELECT * FROM termekek WHERE kategoria='$katid'";
        }
        //Ha nincs eltárolva kategória id -> akkor megjelenítem az összes terméket
        else{

            $sql = "SELECT * FROM termekek ORDER BY id DESC";
        }

        //Ha van beállítva az urlbe rendezéssel kapcsolatos információ (sort)
        if(isset($_GET["sort"])){

            $sort = $_GET["sort"];

            switch($sort){

                case "price_asc":
                    $sql = "SELECT * FROM termekek ORDER BY ar ASC";
                break;

                case "price_desc":
                    $sql = "SELECT * FROM termekek ORDER BY ar DESC";
                break;

                case "newest":
                    $sql= "SELECT * FROM termekek ORDER BY id DESC";
                break;

                case "best":
                    $sql = "SELECT * FROM termekek INNER JOIN rend_term ON termekek.id=rend_term.termekid GROUP BY nev ORDER BY SUM(db) DESC";
                break;
            }
        }

        $result = mysqli_query($con, $sql);

        while($row = mysqli_fetch_array($result)){

            $id = $row["id"];
            $termeknev = $row["nev"];
            $termekar = $row["ar"];
            $keszlet = $row["keszlet"];
            $termekkep = $row["kep"];

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

    ?>
    </div>
</div>

</body>
</html>