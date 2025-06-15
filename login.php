<?php
session_start();
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);

$koneksi = mysqli_connect('localhost', 'root', '', 'informatika2');
if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$submit = isset($_POST['submit']) ? $_POST['submit'] : '';

if ($submit) {

    $sql = "SELECT * FROM user WHERE username = ? AND password = ?";
    $stmt = mysqli_prepare($koneksi, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $username, $password);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_array($result);

    if ($row['username'] != "") {

        $_SESSION['username'] = $row['username'];
        $_SESSION['status'] = $row['status'];
        ?>
        <script>
            alert('Anda Login Sebagai <?php echo $row["username"]; ?>');
            document.location = 'hasillogin.php';
        </script>
        <?php
    } else {

        ?>
        <script>
            alert('Gagal Login');
            document.location = 'login.php';
        </script>
        <?php
    }
}
?>

<form method='post' action='login.php'>
    <p align='center'>
        Username: <input type='text' name='username'><br>
        Password: <input type='password' name='password'><br>
        <input type='submit' name='submit' value='Login'>
    </p>
</form>