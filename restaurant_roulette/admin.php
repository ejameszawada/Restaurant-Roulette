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

<h4 class="center grey-text">Admin Tools</h4>

<div class="container">
    <a href="add.php" class="btn brand z-depth-0">Add a Restaurant</a>
    <hr>
</div>

<br>

<table class="container centered highlight white-text">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Location</th>
            <th>Cuisine</th>
            <th>Price</th>
            <th>URL</th>
            <th>Operations</th>
        </tr>
    </thead>

    <tbody>

        <?php

        $sql = "SELECT * FROM restaurants LEFT JOIN cuisines ON restaurants.cuisine_id = cuisines.cuisine_id 
        LEFT JOIN prices ON restaurants.price_id = prices.price_id";

        $result = mysqli_query($conn, $sql);
        
        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $restaurant_id = $row['restaurant_id'];
                $restaurant_name = $row['restaurant_name'];
                $location = $row['location'];
                $cusine_id = $row['cuisine_name'];
                $price_id = $row['price_range'];
                $website_link = $row['website_link'];
                echo '<tr>
                        <td>'.$restaurant_id.'</td>
                        <td>'.$restaurant_name.'</td>
                        <td>'.$location.'</td>
                        <td>'.$cusine_id.'</td>
                        <td>'.$price_id.'</td>
                        <td >'.$website_link.'</td>
                        <td>
                            <button class="btn white z-depth-0"><a class="brand-text" href="update.php ? update_id='.$restaurant_id.'">Update</a></button>
                            <button class="btn red lighten-2 z-depth-0"><a class="white-text" href="delete.php ? delete_id='.$restaurant_id.'">Delete</a></button>
                        </td>
                    </tr>';
            }
        }
        
        ?>

        

    </tbody>
</table>


<?php include('templates/footer.php'); ?>

</html>