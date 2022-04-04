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



<?php include('templates/footer.php'); ?>

</html>