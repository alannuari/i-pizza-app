<?php

    include('config/db_connect.php');

    $sql = "SELECT title, email, id FROM pizza ORDER BY created_at";

    $result = mysqli_query($conn, $sql);

    $pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php')?>

    <h2 class="text-center mt-8 text-blue-900 font-bold text-3xl">PIZZAS</h2>
    <div class="max-w-6xl mx-auto p-4">
        <div class="flex justify-center flex-wrap mb-6">
            <?php foreach($pizzas as $pizza): ?>
                <div class="bg-white p-3 w-60 rounded-lg mx-5 mb-3 mt-20 shadow">
                    <img src="img/pizza.png" alt="pizza" class="w-28 mx-auto relative mb-[-60px] top-[-60px]">
                    <div class="text-center">
                        <h4 class="my-3 font-bold text-2xl uppercase"><?php echo htmlspecialchars($pizza['title']) ?></h4>
                        <p class="text-gray-400 text-sm">Created by:</p>
                        <p class="text-gray-400 text-sm"><?php echo htmlspecialchars($pizza['email']) ?></p>
                    </div>
                    <div class="text-right mt-6 mb-3">
                        <a href="details.php?id=<?php echo $pizza['id'] ?>" class="underline text-blue-900">More info</a>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <?php include('templates/footer.php')?>        
    
</html>