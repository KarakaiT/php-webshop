<?php 


    if($_SESSION["logged"] == true){


    

?>

        <nav>
            <form action="" method="post">
                <a href="index.php">Kezdőoldal</a>
                <a href="termekek.php">Termékek</a>
                <a href="kereses.php">Keresés</a>
                <a href="kapcsolat.php">Kapcsolat</a>
                <a href="kosar.php">Kosár</a>
                <a href="#"><?php echo "<i class='fas fa-user'></i>".$_SESSION["user"].""?></a>
                <button type="submit "name="logout">Kijelentkezés</button>
            </form>
        </nav>


<?php 

    }
    else{

        $_SESSION["user"] ="";
        $_SESSION["logged"] = false;
?>

        <nav>
            <a href="index.php">Kezdőoldal</a>
            <a href="termekek.php">Termékek</a>
            <a href="kereses.php">Keresés</a>
            <a href="kapcsolat.php">Kapcsolat</a>
            <a href="kosar.php">Kosár</a>
            <a href="login.php">Jelentkezz be</a>
        </nav>

<?php 

    }

    if(isset($_POST["logout"])){

        unset($_SESSION["logged"]);
        $_SESSION["logged"] = false;
        header("Location : index.php");
    }

?>