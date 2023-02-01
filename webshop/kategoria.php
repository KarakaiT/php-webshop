<?php 

    //kategortiák lekérése és megjelenitése 

    $sql = "SELECT id,katnev FROM kategoriak ORDER BY katsorrend ASC";

    $resoult = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($resoult)){

        $id = $row["id"];
        $katnev = $row["katnev"];


        echo "
        
            <div class='katlista'>
                <a href='termekek.php?katid=$id'>".$katnev."</a>
            </div>
        
        ";

    }