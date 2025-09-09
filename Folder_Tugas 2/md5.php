<?php

// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["submit"])) {

    // cek username dan password
    if ($_POST["username"] == "admin" && $_POST["password"] == "123") {

        // jika benar di direct ke halaman admin
        header("Location: admin.php");
        exit;
    } else {
        // jika salah beri tau kesalahan
        $error = true;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>

<body>
    <h1>Login Admin</h1>

    <?php if (isset($error)): ?>
        <p style="color: crimson; font-style: italic;">Username / Password salah!</p>
    <?php endif; ?>



    <ul>
        <form action="" method="post">
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">


            </li>
            <li>
                <label for="password"> Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <button type="submit" name="submit">Login</button>
            </li>

            

    </ul>


    </form>
</body>

</html>