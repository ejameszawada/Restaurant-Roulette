<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}


include('/home/ejzawada/config/db_connect.php');

$username = $_SESSION['username'];
$users_id = $_SESSION['users_id'];

$count = "SELECT COUNT(*) FROM recents LEFT JOIN users ON recents.users_id = users.users_id WHERE users.users_id = '" . $users_id . "'";

$result = mysqli_query($conn, $count);
$row = mysqli_fetch_array($result);

$total = $row[0];


if ($total >= 4) {
    $del = "DELETE FROM recents WHERE users_id = '" . $users_id . "' LIMIT 1";
    $res = mysqli_query($conn, $del);
}

$sql = "SELECT *, DATE_FORMAT(date_eaten,'%M %d, %Y') AS fixedDate FROM recents LEFT JOIN restaurants ON recents.restaurant_id = restaurants.restaurant_id
LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
LEFT JOIN users on recents.users_id = users.users_id WHERE username = '" . $username . "' ORDER BY date_eaten DESC";

$result = mysqli_query($conn, $sql);

$recents = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>
<!-- 
<div class="center">
    <img src="./images/1.png" class="avatar" />

</div> -->

<div class="center-align grey-text">
    <h5>Username: <?php echo $_SESSION['username']; ?></h5>
    <br>
    <div>
        <h4>Restuarant History</h4>
    </div>
</div>

<div class="container">
    <div class="row">

        <?php foreach ($recents as $recent) : ?>
            <div class="col s12 md4 l4">
                <div class="card">
                    <div class="card-content center">
                        <h5><?php echo htmlspecialchars($recent['restaurant_name']); ?></h5>
                        <p class="brand-text topLeft"><?php echo htmlspecialchars($recent['fixedDate']); ?></p>
                        <p class="brand-text topRight"><?php echo htmlspecialchars($recent['eatery_name']); ?></p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> <?php echo htmlspecialchars($recent['cuisine_name']); ?>
                                </li>
                                <li>
                                    <h6>Price Range: </h6><?php echo htmlspecialchars($recent['price_range']); ?>
                                </li>
                                <li>
                                    <h6>Address: </h6><?php echo htmlspecialchars($recent['location']); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="<?php echo $recent['website_link'] ?>" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>
    </div>
</div>
</div>



<?php include('templates/footer.php'); ?>

</html>