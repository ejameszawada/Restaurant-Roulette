<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

if ($_SESSION['usertype'] != 2) {
    header('Location: login.php');
}

include('/home/ejzawada/config/db_connect.php');

include('templates/header.php');

$errors = array('filterChecker' => '');

if (!empty($_POST['cuisineCheck']) && !empty($_POST['priceCheck']) && !empty($_POST['eateryCheck'])) {

    $hide = "hidden";

    $prices = $_POST['priceCheck'];

    $cuisines = $_POST['cuisineCheck'];

    $eatery = $_POST['eateryCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.cuisine_id IN  ('" . implode("','", $cuisines) . "')) 
        AND (restaurants.price_id IN ('" . implode("','", $prices) . "'))
        AND (restaurants.eatery_id IN ('" . implode("','", $eatery) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s12">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
            </div>
            
            ';
        }
    }
} elseif (!empty($_POST['cuisineCheck']) && !empty($_POST['priceCheck'])) {

    $hide = "hidden";

    $prices = $_POST['priceCheck'];

    $cuisines = $_POST['cuisineCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.cuisine_id IN  ('" . implode("','", $cuisines) . "')) 
        AND (restaurants.price_id IN ('" . implode("','", $prices) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s6">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
                <div class="col s6">
                    <div>
                        <button class="btn green lighten-1 z-depth-0"><a class="white-text" href="insertRecent.php?get_id=' . $restaurant_id . '">Let\'s Eat!</a></button>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
} elseif (!empty($_POST['cuisineCheck']) && !empty($_POST['eateryCheck'])) {

    $hide = "hidden";

    $cuisines = $_POST['cuisineCheck'];

    $eatery = $_POST['eateryCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.cuisine_id IN  ('" . implode("','", $cuisines) . "')) 
        AND (restaurants.eatery_id IN ('" . implode("','", $eatery) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s6">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
                <div class="col s6">
                    <div>
                        <button class="btn green lighten-1 z-depth-0"><a class="white-text" href="insertRecent.php?get_id=' . $restaurant_id . '">Let\'s Eat!</a></button>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
} elseif (!empty($_POST['priceCheck']) && !empty($_POST['eateryCheck'])) {

    $hide = "hidden";

    $prices = $_POST['priceCheck'];

    $eatery = $_POST['eateryCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.price_id IN ('" . implode("','", $prices) . "'))
        AND (restaurants.eatery_id IN ('" . implode("','", $eatery) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s6">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
                <div class="col s6">
                    <div>
                        <button class="btn green lighten-1 z-depth-0"><a class="white-text" href="insertRecent.php?get_id=' . $restaurant_id . '">Let\'s Eat!</a></button>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
} elseif (!empty($_POST['cuisineCheck'])) {

    $hide = "hidden";

    $cuisines = $_POST['cuisineCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.cuisine_id IN  ('" . implode("','", $cuisines) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s6">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
                <div class="col s6">
                    <div>
                        <button class="btn green lighten-1 z-depth-0"><a class="white-text" href="insertRecent.php?get_id=' . $restaurant_id . '">Let\'s Eat!</a></button>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
} elseif (!empty($_POST['priceCheck'])) {

    $hide = "hidden";

    $prices = $_POST['priceCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.price_id IN ('" . implode("','", $prices) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s6">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
                <div class="col s6">
                    <div>
                        <button class="btn green lighten-1 z-depth-0"><a class="white-text" href="insertRecent.php?get_id=' . $restaurant_id . '">Let\'s Eat!</a></button>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
} elseif (!empty($_POST['eateryCheck'])) {

    $hide = "hidden";

    $eatery = $_POST['eateryCheck'];

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
        WHERE (restaurants.eatery_id IN ('" . implode("','", $eatery) . "')) ORDER BY RAND() LIMIT 1";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $restaurant_id = $row['restaurant_id'];
            $restaurant_name = $row['restaurant_name'];
            $location = $row['location'];
            $cusine_id = $row['cuisine_name'];
            $price_id = $row['price_range'];
            $eatery_id = $row['eatery_name'];
            $website_link = $row['website_link'];
            echo '
            <div class="container">
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>

            <div class="row">
            <div class="center col s12 md6 l6 offset-l3">
                <div class="card z-depth-0">
                    <div class="card-content center">
                        <h5 class="center-align center">' . $restaurant_name . '</h5>
                        <p class="brand-text topRight">' . $eatery_id . '</p>
                        <hr>
                        <div>
                            <ul class="container">
                                <li>
                                    <h6>Type of Cuisine:</h6> ' . $cusine_id . '
                                </li>
                                <li>
                                    <h6>Price Range: </h6>' . $price_id . '
                                </li>
                                <li>
                                    <h6>Address: </h6>' . $location . '
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <a href="' . $website_link . '" class="brand-text" target="_blank" style="target-new: tab;">More Info</a>
                    </div>
                </div>
            </div>
            <div class="row container center">
            <div class="col s6">
                <div>
                    <button onclick="spinAgain()" class="btn brand z-depth-0" name="spin-again">Spin Again!</button>
                </div>
            </div>
                <div class="col s6">
                    <div>
                        <button class="btn green lighten-1 z-depth-0"><a class="white-text" href="insertRecent.php?get_id=' . $restaurant_id . '">Let\'s Eat!</a></button>
                    </div>
                </div>
            </div>
            
            ';
        }
    }
} elseif (isset($_POST['apply']) && (empty($_POST['cuisineCheck']) && empty($_POST['priceCheck']) && empty($_POST['eateryCheck']))) {
    $hide = "";

    if (empty($_POST['cuisineCheck'])) {
        $errors['filterChecker'] = 'Please select at least one <br/>';
    }

    if (empty($_POST['priceCheck'])) {
        $errors['filterChecker'] = 'Please select at least one <br/>';
    }

    if (empty($_POST['eateryCheck'])) {
        $errors['filterChecker'] = 'Please select at least one <br/>';
    }

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id) ORDER BY restaurant_name LIMIT 0";

    // make query and get result
    $result = mysqli_query($conn, $sql);

    // fetch the resulting rows as an array
    $restaurants = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo '<div class="container">
    
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>';

    // free result from memory
    // mysqli_free_result($result);

    // // close connection
    // mysqli_close($conn);
} else {
    $hide = "";

    $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id) ORDER BY restaurant_name LIMIT 0";

    // make query and get result
    $result = mysqli_query($conn, $sql);


    // fetch the resulting rows as an array
    $restaurants = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo '<div class="container">
    
            <h4 id="ready" class="center grey-text">Ready to eat, Guest?</h4>
            <div class="row">
        <div class="red-text">' . $errors['filterChecker'] . '</div>
        <div class="col s6">
            <h4 class="left-align left grey-text">Filters <button data-target="modal" class="btn brand z-depth-0 modal-trigger"><i class="material-icons">arrow_drop_down</i></button></h4>
        </div>
    </div>';

    // // free result from memory
    // mysqli_free_result($result);

    // // close connection
    // mysqli_close($conn);
}





mysqli_free_result($result);

// close connection
mysqli_close($conn);



?>

<!DOCTYPE html>
<html lang="en">

<br>


<!-- Modal Structure -->
<div id="modal" class="modal modal-fixed-footer grey lighten-4">
    <div class="modal-content">
        <form method="post" action="guestRoulette.php">

            <div class="row">
                <div class="col s12 md4 l4">
                    <div class="card z-depth-0">
                        <div class="card-content">
                            <h6 class="center grey-text">Cuisines</h6>
                            <hr>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="checkAllCuisine(this)" />
                                    <span>All Cuisines</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="1" name="cuisineCheck[]" <?php if (in_array("1", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Asian</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="14" name="cuisineCheck[]" <?php if (in_array("14", $cuisines)) echo "checked='checked'"; ?>class="filled-in checkbox-brown" />
                                    <span>Barbecue</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="6" name="cuisineCheck[]" <?php if (in_array("6", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Breakfast</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="11" name="cuisineCheck[]" <?php if (in_array("11", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Burgers and Fries</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="7" name="cuisineCheck[]" <?php if (in_array("7", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Cajun</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="16" name="cuisineCheck[]" <?php if (in_array("7", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Fine Dining</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="13" name="cuisineCheck[]" <?php if (in_array("13", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Fried Chicken</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="2" name="cuisineCheck[]" <?php if (in_array("2", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Greek</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="10" name="cuisineCheck[]" <?php if (in_array("10", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Hawaiian</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="9" name="cuisineCheck[]" <?php if (in_array("9", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Indian</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="4" name="cuisineCheck[]" <?php if (in_array("4", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Italian</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="5" name="cuisineCheck[]" <?php if (in_array("5", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Mexican</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="8" name="cuisineCheck[]" <?php if (in_array("8", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Pizza</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="15" name="cuisineCheck[]" <?php if (in_array("8", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Sandwiches</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="12" name="cuisineCheck[]" <?php if (in_array("12", $cuisines)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Seafood</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col s12 md4 l4">
                    <div class="card z-depth-0">
                        <div class="card-content">
                            <h6 class="center grey-text">Price Range</h6>
                            <hr>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="priceCheckAll(this)" />
                                    <span>All Price Ranges</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="1" name="priceCheck[]" <?php if (in_array("1", $prices)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Under $10</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="2" name="priceCheck[]" <?php if (in_array("2", $prices)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>$10-$20</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="3" name="priceCheck[]" <?php if (in_array("3", $prices)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>$20 or More</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col s12 md4 l4">
                    <div class="card z-depth-0">
                        <div class="card-content">
                            <h6 class="center grey-text">Restaurant or Fast Food</h6>
                            <hr>
                            <p>
                                <label>
                                    <input type="checkbox" class="filled-in checkbox-brown" onclick="eateryCheckAll(this)" />
                                    <span>Any Type</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="1" name="eateryCheck[]" <?php if (in_array("1", $eatery)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Restaurant</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="2" name="eateryCheck[]" <?php if (in_array("2", $eatery)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>Fast Food</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input type="checkbox" value="3" name="eateryCheck[]" <?php if (in_array("3", $eatery)) echo "checked='checked'"; ?> class="filled-in checkbox-brown" />
                                    <span>CarryOut</span>
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <div class="modal-footer">
        <input type="button" value="Close" class="btn brand closeBtn z-depth-0 modal-action modal-close" name="closeModal" id="closeModal">
        <input type="submit" value="Apply" class="btn brand z-depth-0" name="apply">
    </div>
    </form>
</div>

<h4 class="grey-text center <?= $hide ?>">Use the Filters to get a Restaurant at Random!</h4>


<?php include('templates/footer.php'); ?>


</html>