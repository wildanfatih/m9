<?php
session_start();
?>
<div align="center">
    <?php
    echo "Selamat Datang " . $_SESSION['username'] . "<br>";

    if ($_SESSION['status'] == "administrator") {
        echo "Anda login sebagai Administrator";
    } else {
        echo "Anda login sebagai Member";
    }
    ?>
    <br><br>
    <a href='logout.php'>Logout</a>
</div>
