<?php

    require "connection.php";

    $text = $_POST["text"];

    $sql = "SELECT * FROM termekek WHERE nev LIKE '%$text%'";

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