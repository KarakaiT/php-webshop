<?php require "header.php"; ?>


<div id="top">
    <?php require "menu.php"; ?>
</div>

<div id="left">
    <?php  require "kategoria.php"; ?>
</div>

<div id="right">
    <h2 id="cart_text">Kosár tartalma</h2>

    <table width="80%" align="center" cellpadding="8">

        <tr>
            <th>Azonosító</th>
            <th>Terméknév</th>
            <th>Bruttó ár</th>
            <th>Darabszám</th>
            <th>Cikkszám</th>
            <th>Érték</th>
            <th> <a href="kosarmuvelet.php?action=empty"> <i class="fas fa-trash-alt"></i></a></th>
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
                        $cikszam = $row["cikkszam"];
                        $ertek = $bruttoar * $db;

                        echo "
                        
                            <tr align='center'>
                                <td>".$product_id."</td>
                                <td>".$termeknev."</td>
                                <td>".number_format($bruttoar,0,".",".")." Ft</td>
                                <td>".$db."</td>
                                <td>".$cikszam."</td>
                                <td>".number_format($ertek,0,".",".")." Ft</td>
                                <td>
                                    <a href='kosarmuvelet.php?id=$product_id&action=add'><i class='fas fa-plus'></i></a>
                                    <a href='kosarmuvelet.php?id=$product_id&action=remove'><i class='fas fa-minus'></i></a>
                                </td>
                            </tr>
                        
                        ";

                        $vegosszeg += $ertek;
                    }

                }
            }
            else{

                echo "<h2 align='center'>A kosár üres!</h2>";
            }
            
        ?>

        <tr>
            <td colspan="7" align="right"> 
                <strong>Végösszeg: </strong> <?php echo number_format($vegosszeg,0,".",".")  ?> Ft
            </td>
        </tr>

    </table>

    <?php

            if($_SESSION["logged"] == true){

                echo "<a href='megrendeles.php' class='megrendeles'>Megrendelem</a>";
            }

            else{

                echo "<a href='login.php' class='megrendeles'>Rendelés leadásához kérem jelentkezen be!</a>";
            }
    
    
    ?>

    
</div>

</body>
</html>