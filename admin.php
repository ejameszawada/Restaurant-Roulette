<?php

session_start();
if (!$_SESSION['auth']) {
    header('Location: login.php');
}

if ($_SESSION['usertype'] != 1) {
    header('Location: login.php');
}

include('/home/ejzawada/config/db_connect.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Admin Tools</h4>

<div class="container">
    <div class="row">
        <div class="left col s5 hideMobile">
            <a href="add.php" class="left-align left btn brand z-depth-0 addBtn">Add a Restaurant</a>
        </div>
        <div class="left col s5 showMobile">
            <a href="add.php" class="left-align left btn brand z-depth-0 addBtn">Add</a>
        </div>
        <div class="right col s7">
            <div class="card">
                <div class="nav-wrapper searchBar">
                    <form method="post" action="admin.php">
                        <div class="input-field">
                            <input id="search" name="search" type="search" placeholder="Find Restaurant" autocomplete="off" required>
                            <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                            <i class="material-icons">close</i>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <hr>
</div>



<br>

<table class="container centered highlight white-text">
    <thead>
        <tr>
            <th class="hideMobile">ID</th>
            <th>Name</th>
            <th class="hideMobile">Location</th>
            <th class="hideMobile">Cuisine</th>
            <th class="hideMobile">Price</th>
            <th class="hideMobile">Eatery</th>
            <th class="hideMobile">URL</th>
            <th>Operations</th>
        </tr>
    </thead>

    <tbody>

        <?php

        if (!empty($_POST['search'])) {

            $search =  mysqli_real_escape_string($conn, $_POST['search']);

            $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON (restaurants.cuisine_id = cuisines.cuisine_id)
            LEFT JOIN prices ON (restaurants.price_id = prices.price_id) LEFT JOIN eaterytype ON (restaurants.eatery_id = eaterytype.eatery_id)
            WHERE restaurant_name LIKE '%" . $search . "%' ORDER BY restaurant_name";

            $result = mysqli_query($conn, $sql);

            // fetch the resulting rows as an array
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $restaurant_id = $row['restaurant_id'];
                    $restaurant_name = $row['restaurant_name'];
                    $location = $row['location'];
                    $cusine_id = $row['cuisine_name'];
                    $price_id = $row['price_range'];
                    $eatery_id = $row['eatery_name'];
                    $website_link = $row['website_link'];
                    echo '<tr>
                        <td class="hideMobile">' . $restaurant_id . '</td>
                        <td>' . $restaurant_name . '</td>
                        <td class="hideMobile">' . $location . '</td>
                        <td class="hideMobile">' . $cusine_id . '</td>
                        <td class="hideMobile">' . $price_id . '</td>
                        <td class="hideMobile">' . $eatery_id . '</td>
                        <td class="hideMobile">' . $website_link . '</td>
                        <td>
                            <button class="btn white z-depth-0 opBtn"><a class="brand-text" href="update.php?update_id=' . $restaurant_id . '">Update</a></button>
                            <button class="btn red lighten-2 z-depth-0 opBtn"><a class="white-text" href="delete.php?delete_id=' . $restaurant_id . '">Delete</a></button>
                        </td>
                    </tr>';
                }
            }

            // free result from memory
            mysqli_free_result($result);

            // close connection
            mysqli_close($conn);
        } else {

            $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON restaurants.cuisine_id = cuisines.cuisine_id 
        LEFT JOIN prices ON restaurants.price_id = prices.price_id LEFT JOIN eaterytype ON restaurants.eatery_id = eaterytype.eatery_id";

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
                    echo '<tr>
                        <td class="hideMobile">' . $restaurant_id . '</td>
                        <td>' . $restaurant_name . '</td>
                        <td class="hideMobile">' . $location . '</td>
                        <td class="hideMobile">' . $cusine_id . '</td>
                        <td class="hideMobile">' . $price_id . '</td>
                        <td class="hideMobile">' . $eatery_id . '</td>
                        <td class="hideMobile">' . $website_link . '</td>
                        <td>
                            <button class="btn white z-depth-0 opBtn"><a class="brand-text" href="update.php?update_id=' . $restaurant_id . '">Update</a></button>
                            <button class="btn red lighten-2 z-depth-0 opBtn"><a class="white-text" href="delete.php?delete_id=' . $restaurant_id . '">Delete</a></button>
                        </td>
                    </tr>';
                }
            }

            // free result from memory
            mysqli_free_result($result);

            // close connection
            mysqli_close($conn);
        }
        ?>



    </tbody>
</table>


<?php include('templates/footer.php'); ?>

</html>