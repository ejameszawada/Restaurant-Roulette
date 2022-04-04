<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

include('config/db_connect.php');

// write query for all pizzas
$sql = 'SELECT * FROM restaurants LEFT JOIN cuisines ON restaurants.cuisine_id = cuisines.cuisine_id 
LEFT JOIN prices ON restaurants.price_id = prices.price_id ORDER BY restaurant_name';

// make query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$restaurants = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn)



?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<h4 class="center-align grey-text">Restaurants!</h4>


<div class="container">


    <div class="row">
        <?php foreach ($restaurants as $restaurant) : ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5><?php echo htmlspecialchars($restaurant['restaurant_name']); ?></h5>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> <?php echo htmlspecialchars($restaurant['cuisine_name']); ?>
                                </li>
                                <li>
                                    <h6>Price Range: </h6><?php echo htmlspecialchars($restaurant['price_range']); ?>
                                </li>
                                <li>
                                    <h6>Address: </h6><?php echo htmlspecialchars($restaurant['location']); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="<?php echo $restaurant['website_link'] ?>" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                        <div class="left brand-text"><i class="material-icons left">favorite_border</i>Favorite</div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php include('templates/footer.php'); ?>


</html>