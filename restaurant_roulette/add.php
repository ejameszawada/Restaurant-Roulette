<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

include('config/db_connect.php');

$restaurant_name = $cuisine_id = $price_id = $location = $website_link = '';
$errors = array('restaurant_name' => '', 'cuisine_id' => '', 'price_id' => '', 'location' => '', 'website_link' => '');

if (isset($_POST['add_restaurant'])) {

    // check email
    if (empty($_POST['restaurant_name'])) {
        $errors['restaurant_name'] = 'A restaurant name is required <br/>';
    } else {
        $restaurant_name = $_POST['restaurant_name'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $restaurant_name)) {
            $errors['restaurant_name'] = 'Restaurant name must be letters and spaces only';
        }
    }
    // check location
    if (empty($_POST['location'])) {
        $errors['location'] = 'A location is required <br/>';
    } else {
        $location = $_POST['location'];
    }

    // check cuisine
    if ($_POST['cuisine_id'] == 0) {
        $errors['cuisine_id'] = 'Cuisine type is required <br/>';
    } else {
        $cuisine_id = $_POST['cuisine_id'];
    }

    // check price range
    if ($_POST['price_id']== 0) {
        $errors['price_id'] = 'Price range is required <br/>';
    } else {
        $price_id = $_POST['price_id'];
    }

    // check website link
    if (empty($_POST['website_link'])) {
        $errors['website_link'] = 'URL is required <br/>';
    } else {
        $website_link = $_POST['website_link'];
    }

    if (array_filter($errors)) {
    } else {
        $restaurant_name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
        $location = mysqli_real_escape_string($conn, $_POST['location']);
        $cuisine_id = mysqli_real_escape_string($conn, $_POST['cuisine_id']);
        $price_id = mysqli_real_escape_string($conn, $_POST['price_id']);
        $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);

        // create sql
        $sql = "INSERT INTO restaurants(restaurant_name, location, cuisine_id, price_id, website_link) VALUES('$restaurant_name', '$location', '$cuisine_id', '$price_id', '$website_link')";

        // save to db and check
        if (mysqli_query($conn, $sql)) {
            // success
            header('Location: admin.php');
        } else {
            echo 'query error: ' . mysqli_error($conn);
        }
    }
} // end of POST check

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<div class="row">
    <section class="grey-text">
        <h4 class="center">Add a Restaurant</h4>
        <form action="add.php" method="POST" class="white adminForm" autocomplete="off">
            <label>Restaurant Name:</label>
            <input type="text" name="restaurant_name" value="<?php echo htmlspecialchars($restaurant_name); ?>">
            <div class="red-text"><?php echo $errors['restaurant_name']; ?></div>
            <label>Adress of Restaurant:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>">
            <div class="red-text"><?php echo $errors['location']; ?></div>
            <label for="cuisine_id">Cuisine Type:</label>
            <select class="center" name="cuisine_id" id="cuisine_id" value="<?php echo htmlspecialchars($cuisine_id); ?>">
                <option value="0">-------</option>
                <option value="1">Asian</option>
                <option value="2">Greek</option>
                <option value="3">Fast Food</option>
                <option value="4">Italian</option>
                <option value="5">Mexican</option>
            </select>
            <!-- <input type="text" name="cuisine_id" value="<?php echo htmlspecialchars($cuisine_id); ?>"> -->
            <div class="red-text"><?php echo $errors['cuisine_id']; ?></div>
            <label for="price_id">Price Range:</label>
            <select class="center" name="price_id" id="price_id" value="<?php echo htmlspecialchars($price_id); ?>">
                <option value="0">-------</option>
                <option value="1">Under $10</option>
                <option value="2">$10-$20</option>
                <option value="3">$20-$30</option>
                <option value="4">More than $30</option>
            </select>
            <!-- <input type="text" name="price_id" value="<?php echo htmlspecialchars($price_id); ?>"> -->
            <div class="red-text"><?php echo $errors['price_id']; ?></div>
            <label>URL Link:</label>
            <input type="text" name="website_link" value="<?php echo htmlspecialchars($website_link); ?>">
            <div class="red-text"><?php echo $errors['website_link']; ?></div>
            <div class="center">
                <input type="submit" name="add_restaurant" value="submit" class="btn brand z-depth-0">
            </div>
        </form>
    </section>
</div>


<?php include('templates/footer.php'); ?>

</html>