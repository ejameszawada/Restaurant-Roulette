<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

include('config/db_connect.php');

$restaurant_id = $_GET['update_id'];

$restaurant_name = $cuisine_id = $price_id = $location = $website_link = '';
$errors = array('restaurant_name' => '', 'cuisine_id' => '', 'price_id' => '', 'location' => '', 'website_link' => '');

// if (isset($_POST['update_id'])) {
//     // check email
//     if (empty($_POST['restaurant_name'])) {
//         $errors['restaurant_name'] = 'A restaurant name is required <br/>';
//     } else {
//         $restaurant_name = $_POST['restaurant_name'];
//         if (!preg_match('/^[a-zA-Z\s]+$/', $restaurant_name)) {
//             $errors['restaurant_name'] = 'Restaurant name must be letters and spaces only';
//         }
//     }
//     // check location
//     if (empty($_POST['location'])) {
//         $errors['location'] = 'A location is required <br/>';
//     }

    // // check cuisine
    // if (empty($_POST['cuisine_id'])) {
    //     $errors['cuisine_id'] = 'Cuisine type is required <br/>';
    // }

//     // check price range
//     if (empty($_POST['price'])) {
//         $errors['price'] = 'Price range is required <br/>';
//     }

//     // check website link
//     if (empty($_POST['website_link'])) {
//         $errors['website_link'] = 'URL is required <br/>';
//     }

//     if (array_filter($errors)) {
//     } else {
//         $restaurant_name = mysqli_real_escape_string($conn, $_POST['restaurant_name']);
//         $location = mysqli_real_escape_string($conn, $_POST['location']);
//         $cuisine = mysqli_real_escape_string($conn, $_POST['cuisine']);
//         $price = mysqli_real_escape_string($conn, $_POST['price']);
//         $website_link = mysqli_real_escape_string($conn, $_POST['website_link']);

//         // create sql
//         $sql = "UPDATE restaurants SET restaurant_id = $restaurant_id, restaurant_name = '$restaurant_name', location = '$location', cuisine = '$cuisine', price = '$price', website_link = '$website_link' WHERE restaurant_id = $restaurant_id";
//         // $sql = "INSERT INTO restaurants(restaurant_name, location, cuisine, price, website_link) VALUES('$restaurant_name', '$location', '$cuisine', '$price', '$website_link')";

//         // save to db and check
//         if (mysqli_query($conn, $sql)) {
//             // success
//             echo "Update success";
//         } else {
//             echo 'Not Successful';
//         }
//     }
// } // end of POST check

$restaurant_id = $_GET['update_id'];

$sql = "SELECT * FROM restaurants WHERE restaurant_id = $restaurant_id";

$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$restaurant_name = $row['restaurant_name'];
$location = $row['location'];
$cuisine_id = $row['cuisine_id'];
$price_id = $row['price_id'];
$website_link = $row['website_link'];

if (isset($_POST['submit'])) {
    $restaurant_name = $_POST['restaurant_name'];
    $location = $_POST['location'];
    $cuisine_id = $_POST['cuisine_id'];
    $price_id = $_POST['price_id'];
    $website_link = $_POST['website_link'];

    // check cuisine
    if (empty($_POST['cuisine_id'])) {
        $errors['cuisine_id'] = 'Cuisine type is required <br/>';
    }


    $sql = "UPDATE restaurants SET restaurant_id = $restaurant_id, restaurant_name = '$restaurant_name', 
    location = '$location', cuisine_id = $cuisine_id, price_id = $price_id, website_link = '$website_link' WHERE restaurant_id = $restaurant_id";

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

<div class="row">
    <section class="grey-text">
        <h4 class="center">Update a Restaurant</h4>
        <form method="POST" class="white adminForm" autocomplete="off">
            <label>Restaurant Name:</label>
            <input type="text" name="restaurant_name" value="<?php echo htmlspecialchars($restaurant_name); ?>">
            <div class="red-text"><?php echo $errors['restaurant_name']; ?></div>
            <label>Adress of Restaurant:</label>
            <input type="text" name="location" value="<?php echo htmlspecialchars($location); ?>">
            <div class="red-text"><?php echo $errors['location']; ?></div>
            <label for="cuisine_id">Cuisine Type:</label>
            <select class="center" name="cuisine_id" id="cuisine_id" value="<?php echo htmlspecialchars($cuisine_id); ?>">
                <option>-------</option>
                <option value="1">Asian</option>
                <option value="2">Greek</option>
                <option value="3">Fast Food</option>
                <option value="4">Italian</option>
                <option value="5">Mexican</option>
            </select>
            <div class="red-text"><?php echo $errors['cuisine_id']; ?></div>
            <label for="price_id">Price Range:</label>
            <select class="center" name="price_id" id="price_id" value="<?php echo htmlspecialchars($price_id); ?>">
                <option>-------</option>
                <option value="1">Under $10</option>
                <option value="2">$10-$20</option>
                <option value="3">$20-$30</option>
                <option value="4">More than $30</option>
            </select>
            <div class="red-text"><?php echo $errors['price_id']; ?></div>
            <label>URL Link:</label>
            <input type="text" name="website_link" value="<?php echo htmlspecialchars($website_link); ?>">
            <div class="red-text"><?php echo $errors['website_link']; ?></div>
            <div class="center">
                <button class="btn center-align brand z-depth-0" name="submit">Update</button>
            </div>
        </form>
    </section>
</div>

<?php include('templates/footer.php'); ?>

</html>