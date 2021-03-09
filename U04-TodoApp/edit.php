<?php
    //including php file to enable access to local database
    include "db.php";

    if (isset($_GET['edit-todo'])) {
        $e_id = $_GET['edit-todo'];
    }

    if (isset($_POST['edit_todo'])) {
        $edit_todo = $_POST['todo'];
        $query = "UPDATE todo SET name = '$edit_todo' WHERE id = $e_id";
        $run = mysqli_query($connection, $query);

        if (!$run) {
            die("Didn't go through");
        }else{
            header("Location: index.php?updated");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U04-Todo-Application</title>
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <main class="container">
        <section class="todo">
            <h1 class="display-4">Todo-app</h1>
            <h2 class="lead">Edit Todo</h2>
            
            <form action="" method="POST">
            <!-- SQL statement-->
            <?php
               $sql = "SELECT * FROM todo WHERE id = $e_id";
               $result = mysqli_query($connection, $sql);
               $data = mysqli_fetch_array($result);
            ?>
            <!--form-classes are used with bootstrap to style and add structure to forms-->
                <div class="form-group">
                    <input type="text" class="form-control" name="todo" placeholder="Todo Name" value="<?php echo $data['name']; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Save changes to Task List" name="edit_todo">
                </div>
            </form>
        </section>
    </main>
</body>
</html>