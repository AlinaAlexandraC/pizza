<?php

// MySQLi (below) or PDO

/*
moved to db_connect.php


// connect to database
$conn = mysqli_connect('localhost', 'Alina', 'test1234', 'ninja_pizza');

// check the connection
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}
*/

include('config/db_connect.php');

// write query for all pizzas (* for all;)
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

// make the query and get result
$result = mysqli_query($conn, $sql);

// fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result from memory
mysqli_free_result($result);

// close connection
mysqli_close($conn);

// print_r($pizzas);

// print_r(explode(',', $pizzas[0]['ingredients']));

?>

<!DOCTYPE html>
<html>
<?php include('templates/header.php'); ?>

<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
    <div class="row">

        <?php foreach ($pizzas as $pizza): ?>

            <div class="col s6 md3">
                <div class="card z-depth-0">
                    <img src="img/pizza-icon.svg" class="pizza">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                        <ul>
                            <?php foreach (explode(',', $pizza['ingredients']) as $ingredient): ?>
                                <li><?php echo htmlspecialchars($ingredient); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <div class="card-action right-align">
                        <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">More Info</a>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>

        <!-- <?php if (count($pizzas) >= 3): ?>
            <p>There are more than 3 pizzas</p>
        <?php else: ?>
            <p>There are less than 3 pizzas</p>
        <?php endif; ?> -->

    </div>
</div>

<?php include('templates/footer.php'); ?>

</html>