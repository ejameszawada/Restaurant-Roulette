<?php

include('/home/ejzawada/config/db_connect.php');

$username = $password = '';
$errors = array('username' => '', 'password' => '', 'incorrect' => '');

if (isset($_POST['guest'])) {
    $usertype = ['usertype'];
    session_start();
    $_SESSION['usertype'] = 2;
    $_SESSION['auth'] = 'true';
    header('Location: index.php');
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $usertype = ['usertype'];

    $salt = "4252faefa1515" . $password . "aefqefqwef14143efafe";

    $hash = hash("sha512", $salt);


    // check email
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required <br/>';
    }

    // check title
    if (empty($_POST['password'])) {
        $errors['password'] = 'A password is required <br/>';
    }

    $sql = "SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . $hash . "' LIMIT 1";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($result);

    if (mysqli_num_rows($result) == 1) {
        if ($row['usertype'] == 0) {
            session_start();
            $_SESSION['auth'] = 'true';
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['usertype'] = 0;
            header('Location: index.php');
        } elseif ($row['usertype'] == 1) {
            session_start();
            $_SESSION['auth'] = 'true';
            $_SESSION['username'] = $username;
            $_SESSION['users_id'] = $row['users_id'];
            $_SESSION['usertype'] = 1;
            header('Location: admin.php');
        }
    } else {
        $errors['incorrect'] = 'Incorrect Username or Password <br/>';
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
    <link rel="shortcut icon" type="image/png" href="images/roulette.png" />
    <style type="text/css">
        .brand {
            background: #8d6e63 !important;
        }

        .brand-text {
            color: #8d6e63 !important;
        }

        .rr {
            margin-left: 15%;
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

        nav {
            border-bottom: 5px solid #8d6e63;
        }

        @media only screen and (max-width: 600px) {
            .brand-logo {
                font-size: 1.3em !important;
            }
        }
    </style>
</head>

<body class="grey lighten-4">
    <div class="navbar-fixed">
        <nav class="white z-depth-0">
            <div class="nav-wrapper">
                <div class="center brand-logo brand-text"><i class="material-icons left">restaurant</i> Restaurant Roulette</div>
            </div>
        </nav>
    </div>
    <div class="container">
        <section class="grey-text">
            <h4 class="center">Welcome! Login Below</h4>
            <form method="POST" class="white" autocomplete="off">
                <div class="red-text"><?php echo $errors['incorrect']; ?></div>
                <div class="red-text"><?php echo $errors['username']; ?></div>
                <div class="red-text"><?php echo $errors['password']; ?></div>
                <Label>Username:</Label>
                <input type="text" name="username" value="<?php echo htmlspecialchars("$username"); ?>" autocomplete="off">
                <Label>Password:</Label>
                <input type="password" name="password" value="<?php echo htmlspecialchars("$password"); ?>" autocomplete="off">
                <div class="center-align">
                    <ul>
                        <li><input type="submit" name="login" value="Login" class="btn brand z-depth-0"></li>
                        <li>
                            <p>OR</p>
                        </li>
                        <li><input type="submit" name="guest" value="Continue as Guest" class="btn brand z-depth-0"></li>
                    </ul>
                </div>
            </form>
        </section>

        <div class="center brand-text"> Don't have an account? Click <a href="register.php">here</a> to create one</div>
    </div>

    <?php include('templates/footer.php'); ?>


</body>

</html>