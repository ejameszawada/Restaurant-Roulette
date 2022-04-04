<?php

include('config/db_connect.php');

$email = $password = '';
$errors = array('email' => '', 'password' => '');

if (isset($_POST['email'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $email)) {
            $errors['email'] = 'Incorrect email or password';
        }
    }

    // check title
    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required <br/>';
    }

    $sql = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        session_start();
        $_SESSION['auth'] = 'true';
        header('Location: index.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Roulette</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style type="text/css">
        .brand {
            background: #8d6e63 !important;
        }

        .brand-text {
            color: #8d6e63 !important;
        }

        li {
            outline: 2px solid white;
            outline-offset: -2px;
        }

        form {
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }
    </style>
</head>

<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <div class="center brand-logo brand-text"><i class="material-icons left">restaurant</i> Restaurant Roulette</div>
        </div>
    </nav>

    <section class="grey-text">
        <h4 class="center">Welcome! Login Below</h4>
        <form method="POST" class="white" autocomplete="off">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <div class="red-text"><?php echo $errors['password']; ?></div>
            <Label>Email:</Label>
            <input type="text" name="email" autocomplete="off">
            <Label>Password:</Label>
            <input type="password" name="password" autocomplete="off">
            <div class="center">
                <input type="submit" name="login" value="Login" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <div class="center brand-text"> Don't have an account? Click <a href="register.php">here</a> to create one</div>


    <?php include('templates/footer.php'); ?>


</body>

</html>