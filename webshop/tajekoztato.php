<?php require "header.php"; ?>


<div id="top">
    <?php require "menu.php"; ?>
</div>

<div id="left">
    <?php  require "kategoria.php"; ?>
</div>

<div id="right">
    <?php

    $sql = "SELECT * FROM tajekoztato";

    $resoult = mysqli_query($con, $sql);

    while($row = mysqli_fetch_array($resoult)){

        $cim = $row["cim"];
        $content = $row["content"];

        echo "

        <h1>".$cim."</h1>
        <div>".$content."</div>
        
        ";

    };


    ?>
</div>

</body>
</html>