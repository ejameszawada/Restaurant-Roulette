<?php

include('/home/ejzawada/config/db_connect.php');

$password = $username = $password2 = '';
$errors = array('username' => '', 'password' => '', 'match' => '');
$flag = FALSE;
$strength = FALSE;

if (isset($_POST['register'])) {

    // check username
    if (empty($_POST['username'])) {
        $errors['username'] = 'A username is required <br/>';
    } else {
        $username = $_POST['username'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $username)) {
            $errors['username'] = 'Username must be letters and spaces only';
        }
    }

    // check password
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required <br/>';
    }

    if (strlen($_POST['password']) >= 8) {
        if (!ctype_lower($_POST['password']) && !ctype_upper($_POST['password'])) {
            if (!ctype_digit($_POST['password']) && !ctype_alpha($_POST['password'])) {
                $strength = TRUE;
            }
        } else {
            $errors['password'] = 'Password must have at least one Upper and Lower case and one Number';
        }
    } else {
        $errors['password'] = 'Password must be at least 8 characters long';
    }

    if (array_filter($errors)) {
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password2 = mysqli_real_escape_string($conn, $_POST['password2']);

        if ($password == $password2) {
            $flag = TRUE;
        } else {
            $errors['match'] = 'Passwords do not match';
        }

        $sql_u = "SELECT * FROM users WHERE username = '$username'";

        $reg_u = mysqli_query($conn, $sql_u);

        if (mysqli_num_rows($reg_u) > 0) {
            $errors['username'] = 'Sorry, that username is taken';
        } else {
            # code...
            if ($flag == TRUE && $strength == TRUE) {
                $salt = "4252faefa1515" . $password . "aefqefqwef14143efafe";

                $hash = hash("sha512", $salt);

                // create sql
                $sql = "INSERT INTO users(username, password) VALUES('$username', '$hash')";

                // save to db and check
                if (mysqli_query($conn, $sql)) {
                    // success
                    header('Location: login.php');
                } else {
                    echo 'query error: ' . mysqli_error($conn);
                }
            }
        }
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
    <nav class="white z-depth-0">
        <div class="container">
            <div class="center brand-logo brand-text"><i class="material-icons left">restaurant</i> Restaurant Roulette</div>
        </div>
    </nav>
    <div class="container">
        <section class="grey-text">
            <h4 class="center">Register Below</h4>
            <form action="register.php" method="POST" class="white">
                <label>Username:</label>
                <input type="text" name="username" value="<?php echo htmlspecialchars("$username"); ?>">
                <div class="red-text"><?php echo $errors['username']; ?></div>
                <label>Password:</label>
                <input type="password" name="password" value="<?php echo htmlspecialchars("$password"); ?>">
                <div class="red-text"><?php echo $errors['password']; ?></div>
                <label>Re-Type Password:</label>
                <input type="password" name="password2" value="<?php echo htmlspecialchars("$password2"); ?>">
                <div class="red-text"><?php echo $errors['match']; ?></div>
                <div class="center">
                    <input type="submit" name="register" value="register" class="btn brand z-depth-0">
                </div>
            </form>
        </section>

        <div class="center brand-text"> Already have an account? Click <a href="login.php">here</a> to create one</div>
    </div>
    <?php include('templates/footer.php'); ?>


</body>

</html>