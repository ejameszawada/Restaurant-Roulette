<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}


include('config/db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="center">
    <img src="./images/1.png" class="avatar" />
</div>


    <?php include('templates/footer.php'); ?>

</html>