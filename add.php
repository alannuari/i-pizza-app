<?php

include('config/db_connect.php');

$email = $title = $ingredients = '';
$errors = ['email' => '', 'title' => '', 'ingredients' => ''];

if (isset($_POST['submit'])) {
    if (empty($_POST['email'])) {
        $errors['email'] = 'An email is required';
    } else {
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Email must be a valid email address';
        }
    }
    
    if (empty($_POST['title'])) {
        $errors['title'] = 'An title is required';
    } else {
        $title = $_POST['title'];
        if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    if (empty($_POST['ingredients'])) {
        $errors['ingredients'] = 'At least one ingredient is required';
    } else {
        $ingredients = $_POST['ingredients'];
        if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
            $errors['ingredients'] = 'Ingredients must be a comma separated list';
        }
    }

    if (array_filter($errors)) {
        
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        $sql = "INSERT INTO pizza(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

        if (mysqli_query($conn, $sql)) {
            header('Location: index.php');
        } else {
            echo 'Query error: ' . mysqli_error($conn);
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php')?> 
    
    <section class="bg-gray-100 text-blue-900 my-4">
        <h3 class="text-center text-3xl font-bold py-6">Add a Pizza</h3>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" class="bg-white flex flex-col p-8 max-w-4xl mx-auto text-lg rounded-lg shadow">
            <label class="my-3">Your Email:</label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>" class="bg-gray-100 p-2">
            <div class="text-red-400"><?php echo $errors['email'] ?></div>
            
            <label class="my-3">Pizza title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>" class="bg-gray-100 p-2">
            <div class="text-red-400"><?php echo $errors['title'] ?></div>

            <label class="my-3">Ingredients (comma separated):</label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>" class="bg-gray-100 p-2">
            <div class="text-red-400"><?php echo $errors['ingredients'] ?></div>

            <div class="text-center">
                <input type="submit" name="submit" value="Submit" class="cursor-pointer text-white px-6 py-2 bg-blue-900 hover:bg-blue-800 rounded-lg my-6">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php')?>        
    
</html>