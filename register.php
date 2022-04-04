<?php

include('config/db_connect.php');

$email = $password = $first_name = '';
$errors = array('email' => '', 'first_name' => '', 'password' => '');

if(isset($_POST['register'])){

    // check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required <br/>';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email']  = 'Must be a valid email adress';
        }
    }
    // check first name
    if (empty($_POST['first_name'])) {
        $errors['first_name'] = 'A name is required <br/>';
    } else {
        $first_name = $_POST['first_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $first_name)) {
            $errors['first_name'] = 'Name must be letters and spaces only';
        }
    }
    // check ingredients
    if (empty($_POST['password'])) {
        $errors['password'] = 'Password is required <br/>';
    } 

    if (array_filter($errors)) {

    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        // create sql
        $sql = "INSERT INTO users(email, first_name, password) VALUES('$email', '$first_name', '$password')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: login.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
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
        <h4 class="center">Register Below</h4>
        <form action="register.php" method="POST" class="white">
            <label>Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>
            <label>First Name:</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
            <div class="red-text"><?php echo $errors['first_name']; ?></div>
            <label>Password:</label>
            <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
            <div class="red-text"><?php echo $errors['password']; ?></div>
            <div class="center">
                <input type="submit" name="register" value="register" class="btn brand z-depth-0">
            </div>
        </form>
    </section>

    <div class="center brand-text"> Already have an account? Click <a href="login.php">here</a> to create one</div>

    <?php include('templates/footer.php'); ?>


</body>

</html>