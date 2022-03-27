<?php 

    include('config/db_connect.php');

    if (isset($_POST['delete'])) {
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

        $sql = "DELETE FROM pizza WHERE id = $id_to_delete";

        if(mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }

    if (isset($_GET['id'])) {
        $id = mysqli_real_escape_string($conn, $_GET['id']);

        $sql = "SELECT * FROM pizza WHERE id = $id";

        $result = mysqli_query($conn, $sql);

        $pizza = mysqli_fetch_assoc($result);

        mysqli_free_result($result);

        mysqli_close($conn);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <?php include('templates/header.php')?>

    <div class="my-8 max-w-xl mx-auto">
        <div class="bg-white p-3 text-center rounded-lg mx-3 shadow">
            <?php if ($pizza): ?>
                <h2 class="font-bold my-4 text-2xl text-blue-900 uppercase"><?php echo htmlspecialchars($pizza['title']) ?></h2>
                <p class="text-gray-400 text-sm">Created by: <?php echo htmlspecialchars($pizza['email']) ?></p>
                <p class="text-gray-400 text-sm"><?php echo date($pizza['created_at']) ?></p>
                <div class="w-32 text-left mx-auto my-4">
                    <h4 class="text-lg">Ingredients:</h4>
                    <ul>
                        <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                            <li class="capitalize">- <?php echo htmlspecialchars($ing) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <form action="details.php" method="POST">
                    <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id'] ?>">
                    <input type="submit" name="delete" value="Delete" class="text-white px-6 py-2 bg-blue-900 hover:bg-blue-800 my-4 rounded-lg cursor-pointer">
                </form>
            <?php else: ?>
                <h3>No such pizza exists</h3>
            <?php endif ?>
        </div>
    </div>

    <?php include('templates/footer.php')?>
    
</html>