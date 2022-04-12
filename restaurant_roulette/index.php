<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

include('config/db_connect.php');

$errors = array('cuisineChecker' => '', 'priceChecker' => '');


if (!empty($_POST['cuisineCheck']) && !empty($_POST['priceCheck'])) {

    $prices = $_POST['priceCheck'];

    $cuisines = $_POST['cuisineCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) WHERE (restaurants.cuisine_id IN  ('" . implode("','", $cuisines) . "')) 
        AND (restaurants.price_id IN ('" . implode("','", $prices) . "'))  ORDER BY restaurant_name";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    // write query for all restuarants




    $restaurants = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    // $cuisines = implode(",", $_POST['cuisineCheck']);

    // $cuisine_array = explode(",", $cuisines);

    // echo $cuisines


} else {
    $errors['priceChecker'] = 'Select at least one Price Range <br/>';
    $errors['cuisineChecker'] = 'Select at least one type of Cuisine <br/>';
    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) ORDER BY restaurant_name";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    // write query for all restuarants




    $restaurants = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);
}








// fetch the resulting rows as an array


// free result from memory








?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>
<br>

<div class="container">
    <div class="row">
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button onclick="dropDownHide()" class="btn brand z-depth-0"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
        <div class="col s5 right">
            <div class="card">
                <div class="nav-wrapper searchBar">
                    <form>
                        <div class="input-field">
                            <input id="search" type="search" placeholder="Find Restaurant" required>
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form method="post" action="index.php">
        <div id="hiddenFilters" style="display: none;">

            <div class="row">
                <div class="col s4">
                    <div class="card z-depth-0">
                        <div class="card-content">
                            <h6 class="center grey-text">Cuisines</h6>
                            <hr>
                            <div class="red-text"><?php echo $errors['cuisineChecker']; ?></div>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="checkAllCuisine(this)" />
                                    <span>All Cuisines</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="1" name="cuisineCheck[]" class="filled-in checkbox-brown" />
                                    <span>Asian</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="2" name="cuisineCheck[]" class="filled-in checkbox-brown" />
                                    <span>Greek</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="4" name="cuisineCheck[]" class="filled-in checkbox-brown" />
                                    <span>Italian</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="5" name="cuisineCheck[]" class="filled-in checkbox-brown" />
                                    <span>Mexican</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card z-depth-0">
                        <div class="card-content">
                            <h6 class="center grey-text">Restaurant or Fast Food</h6>
                            <hr>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="priceCheckAll(this)" />
                                    <span>Both</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="priceCheckAll(this)" />
                                    <span>Restaurant</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="priceCheckAll(this)" />
                                    <span>Fast Food</span>
                                </label>
                            </p>
                            <h6 class="center grey-text">Price Range</h6>
                            <hr>
                            <div class="red-text"><?php echo $errors['priceChecker']; ?></div>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="priceCheckAll(this)" />
                                    <span>All Price Ranges</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="1" name="priceCheck[]" class="filled-in checkbox-brown" />
                                    <span>Under $10</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="2" name="priceCheck[]" class="filled-in checkbox-brown" />
                                    <span>$10-$20</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="3" name="priceCheck[]" class="filled-in checkbox-brown" />
                                    <span>$20-$30</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="4" name="priceCheck[]" class="filled-in checkbox-brown" />
                                    <span>$30 or More</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col s4">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <input type="submit" value="Apply" class="btn brand z-depth-0" name="submit">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <?php foreach ($restaurants as $restaurant) : ?>
            <div class="center col s12 md6 l6">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center"><?php echo htmlspecialchars($restaurant['restaurant_name']); ?></h5>
                        <p class="brand-text restOrFF">Restaurant</p>
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