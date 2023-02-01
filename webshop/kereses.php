<?php require "header.php";  ?>

<div id="top">
    <?php  require "menu.php";  ?>
</div>

<div id="left">
    <?php require "kategoria.php";  ?>
</div>

<div id="right">
    <form action="" method="post">
        <h2>Termék keresése</h2>

        <input type="text" name="search" id="search" placeholder="Írja be a termék nevét...">
    </form>

    <div class="products-container"></div>
</div>

    <script>
        $(function(){

            //Ha beírok valamit a search id-val ellátott inputba akkor lefut egy függvény...
            $("#search").keyup(function(){

                //Eltárolom az input mezőm értékét egy változóba
                var text = $("#search").val();

                //Megnézem, hogy van-e valami az inputba -> írtam-e bele
                if(text != ""){

                    //Ha van, akkor indítom az ajax hívást
                    $.ajax({

                        url: "fetch.php",
                        type: "post",
                        dataType: "text",
                        data: {text:text},   //az első text-> php oldalon a változó neve ($_POST["text]) amivel lehivatkozom, a második text-> az input mező értéke amit áküldök
                        success: function(data){

                            $(".products-container").html(data);
                        }
                    })
                }
                else{

                    $(".products-container").html("");
                }
            })
        })
    </script>
</body>
</html>