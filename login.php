<?php
 include('database.php');
 $db = new Database();


if (isset($_POST['submit'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $user = $_POST["username"];
        $pass = $_POST["password"];
       
       $query = $db->login($user, $pass);
        if (($query) > 0) {
            $data = $query;
            session_start();
            $_SESSION["login"] = TRUE;
            $_SESSION["username"] = $data['username'];
            $_SESSION["nama"] = $data['nama'];
            $_SESSION["id"] = $data['id_pengguna'];
            $remember = $_POST["remember"];
            if ($remember != "") {
                $kodeacak = hash(CRYPT_SHA256, $user);
                setcookie('login', $kodeacak, time() + 3600);
            }
            header("Location:index.php");
        } else {
           $err = true;
        }
    } else {
        $kosong = true;
    }
}

if (!empty($_COOKIE['login'])) {
    $_SESSION["login"] = TRUE;
    header("Location:index.php");
}

?>


<!DOCTYPE html>

<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <style>
        .container {
            border: 1px solid black;
            width: 50%;
            position: absolute;
            top: 25%;
            left: 10%;
            padding: 10px;
            border-radius: 20px;
            background-color: whitesmoke;

        }

        body {
            background: #7F7FD5;
            background: -webkit-linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
            background: linear-gradient(to right, #91EAE4, #86A8E7, #7F7FD5);
        }
    </style>


</head>




<body>
    <h2 style="left: 130px; position: relative;"><br><br><b>Log in</b></h2>


    <div class="container">
        <form method="post" action="">

            <?php if (isset($err)) : ?>
                <p style="color:red; font-style: italic;"> username dan password salah**</p>
            <?php endif; ?>

            <?php if (isset($kosong)) : ?>
                <p style="color:red; font-style: italic;"> form masih kosong**</p>
            <?php endif; ?>


            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="username">

            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1" name="remember"> ingat saya</label>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>


    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>