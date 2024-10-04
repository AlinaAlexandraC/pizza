<?php

include('config/db_connect.php');

if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        // success
        header('Location: index.php');
    } else {
        // error
        echo 'query error: ' . mysqli_error($conn);
    }
}

// check GET request id param
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    // get the query results
    $result = mysqli_query($conn, $sql);

    // fetch result in array format
    $pizza = mysqli_fetch_assoc($result);

    // free result from memory
    mysqli_free_result($result);

    // close connection
    mysqli_close($conn);

    // print_r($pizza);
}

?>

<!DOCTYPE html>
<html>

<?php include('templates/header.php'); ?>

<div class="container center">
    <?php if ($pizza): ?>
        <div class="card z-depth-0 details">
            <img src="img/pizza-icon.svg" class="pizza">
            <div class="card-content center">
                <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
                <div class="divider"></div>
                    <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?> at <?php echo date($pizza['created_at']); ?></p>
                <h5 class="ingredients">Ingredients:</h5>
                <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>
            </div>

            <!-- DELETE FORM -->
            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
            </form>

        <?php else: ?>
            <h5>No such pizza yet</h5>
        <?php endif ?>
        </div>

        <?php include('templates/footer.php'); ?>

</html>