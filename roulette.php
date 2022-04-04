<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

include('config/db_connect.php');

$current_user = get_current_user();


$sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON restaurants.cuisine_id = cuisines.cuisine_id 
LEFT JOIN prices ON restaurants.price_id = prices.price_id ORDER BY RAND() LIMIT 1";

$result = mysqli_query($conn, $sql);

$restaurants = mysqli_fetch_all($result, MYSQLI_ASSOC);

mysqli_free_result($result);

mysqli_close($conn);

?>


<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>


<div class="container">
    <h4 id="ready" class="center grey-text">Ready to eat, <?php echo $current_user; ?>?</h4>
    <div id="loader" class="center" style="display: none;"></div>
    <div id="roulette-hidden" style="display:none" class="animate-bottom center">
        <div class="row">
            <?php foreach ($restaurants as $restaurant) : ?>
                <h4 id="ready" class="center grey-text">How does <?php echo htmlspecialchars($restaurant['restaurant_name']); ?> sound?</h4>
                <div class="col s6 offset-s3">
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


        <div class="row">
            <div class="center col s5 offset-s2">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
            <div class="col s5 pull-s2">
                <div>
                    <button class="btn green lighten-1 z-depth-0">Sounds Good!</button>
                </div>
            </div>
        </div>
    </div>


    <div class="center">
        <br>
        <br>
        <br>
        <button onclick="ShowAndHide(this), myFunction()" class="btn center-align brand z-depth-0">Find Restaurant</button>
    </div>


</div>



<?php include('templates/footer.php'); ?>


</html>