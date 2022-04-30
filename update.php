<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}
if ($_SESSION['usertype'] != 1) {
    header('Location: login.php');
}

include('/home/ejzawada/config/db_connect.php');

$restaurant_id = $_GET['update_id'];

$restaurant_name = $cuisine_id = $price_id = $location = $eatery_id = $website_link = '';
$errors = array('restaurant_name' => '', 'cuisine_id' => '', 'price_id' => '', 'location' => '', 'website_link' => '');


$restaurant_id = $_GET['update_id'];

$sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
        LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
         WHERE restaurant_id = $restaurant_id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$restaurant_name = $row['restaurant_name'];
$location = $row['location'];
$cuisine_id = $row['cuisine_id'];
$cuisine_name = $row['cuisine_name'];
$price_id = $row['price_id'];
$price_range = $row['price_range'];
$eatery_id = $row['eatery_id'];
$eatery_name = $row['eatery_name'];
$website_link = $row['website_link'];

if (isset($_POST['submit'])) {
    $restaurant_name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $cuisine_id = mysqli_real_escape_string($conn, $_POST['cuisine_id']);
    $price_id = mysqli_real_escape_string($conn, $_POST['price_id']);
    $eatery_id = mysqli_real_escape_string($conn, $_POST['eatery_id']);
    $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);

    // check cuisine
    if (empty($_POST['cuisine_id'])) {
        $errors['cuisine_id'] = 'Cuisine type is required <br/>';
    }

    $sql = "UPDATE restaurants SET restaurant_id = $restaurant_id, restaurant_name = '$restaurant_name', 
    location = '$location', cuisine_id = $cuisine_id, price_id = $price_id, eatery_id = $eatery_id, website_link = '$website_link' WHERE restaurant_id = $restaurant_id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('Location: admin.php');
    } else {
        die(mysqli_error($conn));
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>
<div class="container">
    <div class="row">
        <section class="grey-text">
            <h4 class="center">Update a Restaurant</h4>
            <form method="POST" class="white adminForm" autocomplete="off">
                <label>Restaurant Name:</label>
                <input type="text" name="restaurant_name" value="<?php echo htmlspecialchars("$restaurant_name"); ?>">
                <div class="red-text"><?php echo $errors['restaurant_name']; ?></div>
                <label>Adress of Restaurant:</label>
                <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>">
                <div class="red-text"><?php echo $errors['location']; ?></div>
                <label for="cuisine_id">Cuisine Type:</label>
                <select class="center" name="cuisine_id" id="cuisine_id" value="<?php echo htmlspecialchars($cuisine_id); ?>">
                    <option value="<?php echo htmlspecialchars($cuisine_id); ?>"><?php echo htmlspecialchars($cuisine_name); ?></option>
                    <option value="0" disabled>-------</option>
                    <option value="1">Asian</option>
                    <option value="14">Barbecue</option>
                    <option value="6">Breakfast</option>
                    <option value="11">Burgers and Fries</option>
                    <option value="7">Cajun</option>
                    <option value="16">Fine Dining</option>
                    <option value="13">Fried Chicken</option>
                    <option value="2">Greek</option>
                    <option value="10">Hawaiian</option>
                    <option value="9">Indian</option>
                    <option value="4">Italian</option>
                    <option value="5">Mexican</option>
                    <option value="8">Pizza</option>
                    <option value="15">Sandwiches</option>
                    <option value="12">Seafood</option>
                </select>
                <div class="red-text"><?php echo $errors['cuisine_id']; ?></div>
                <label for="price_id">Price Range:</label>
                <select class="center" name="price_id" id="price_id" value="<?php echo htmlspecialchars($price_id); ?>">
                    <option value="<?php echo htmlspecialchars($price_id); ?>"><?php echo htmlspecialchars($price_range); ?></option>
                    <option value="0" disabled>-------</option>
                    <option value="1">Under $10</option>
                    <option value="2">$10-$20</option>
                    <option value="3">$20 or More</option>
                </select>
                <div class="red-text"><?php echo $errors['price_id']; ?></div>
                <label for="eatery_id">Eatery Type:</label>
                <select class="center" name="eatery_id" id="eatery_id" value="<?php echo htmlspecialchars($eatery_id); ?>">
                    <option value="<?php echo htmlspecialchars($eatery_id); ?>"><?php echo htmlspecialchars($eatery_name); ?></option>
                    <option value="0" disabled>-------</option>
                    <option value="1">Restaurant</option>
                    <option value="2">Fast Food</option>
                    <option value="3">CarryOut</option>
                </select>
                <label>URL Link:</label>
                <input type="text" name="website_link" value="<?php echo htmlspecialchars("$website_link"); ?>">
                <div class="red-text"><?php echo $errors['website_link']; ?></div>
                <div class="center">
                    <button class="btn center-align brand z-depth-0" name="submit">Update</button>
                </div>
            </form>
        </section>
    </div>
</div>

<?php include('templates/footer.php'); ?>

</html>