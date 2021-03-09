<?php
    //including php file to enable access to local database
    include "db.php";

    //CRUD operation to manipulate data in database, selecting all columns from table and put the data and db-connection variable into result
    $query = "SELECT * FROM todo";
    $result = mysqli_query($connection, $query);

    //the global variable POST is used to pass variables and collect form data after submitting an HTML form with it as method
    //enable processing of form data when form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $todo = $_POST['todo'];
        $date = date('F j, Y, g:i a');
        $sql = "INSERT INTO todo(name, date) VALUES ('$todo', '$date');";
        $results = mysqli_query($connection, $sql);
        
        if (!$results) {
            die("Didn't go through");
        }else{
            header("Location:index.php?todo-added");
        }
    }
    // isset function with CRUD class, allowing users to delete mySQL database entries
    if (isset($_GET['delete_todo'])) {
        $dlt_todo = $_GET['delete_todo'];
        $sqli = "DELETE FROM todo WHERE id = $dlt_todo";
        $resultss = mysqli_query($connection, $sqli);
    
        if (!$resultss) {
            die("Didn't go through");
        }else{
            header("Location:index.php?todo-deleted");
        }
    }

        



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U04-Todo-Application - PHP and MySQL database</title>
    <!--link to bootstrapCDN content delivery network to enable utilization of their css library-->
    <link rel="stylesheet" type="text/css"
        href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--local stylesheet, loading current timestamp on file path so it doesn't load from cache and remain unique-->
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
</head>

<body>
    <!--container class grouping several html-elements and some php-code to easier be able to style the visable content in css/bootstrap-->
    <main class="container">
        <section class="todo">
            <!--display-4 and other uncommon class names are examples of bootstrap typography, allowing addition of unique styles to html-elements-->
            <h1 class="display-4">Todo-app</h1>
            <h2 class="lead">Add Todo</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <!--form-classes are used with bootstrap to style and add structure to forms..-->
                <div class="form-group">
                    <input type="text" class="form-control" name="todo" placeholder="Todo name">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Add new Todo to Task List">
                </div>
            </form>
        </section>

        <section class="search">
            <!--form-control provides styling with bootstrap..-->
            <!--using HTTP post transaction method to send form-data-->
            <form action="search.php" method="POST">
                <input type="text" class="form-control" name="search" placeholder="Search Todo">
            </form>
        </section>

        <div class="table-responsive col-lg-12">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                    <th>ID</th>
                    <th>Task/todo</th>
                    <th>Date</th>
                    <th>Mark Todo</th>
                    <th>Edit Todo</th>
                    <th>Delete Todo</th>
                </thead>
                <tbody>
                    <?php
                    //associative arrays assigned to values placed on todo-tables located in dbTodo database
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $date = $row['date'];
                            ?>
                    <!--getting output from database -->
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $date; ?></td>
                        <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Todo Done</label>
                        </td>
                        <!--linking to isset functions in php containing CRUD operations to manipulate data-->
                        <td><a href="edit.php?edit-todo=<?php echo $id; ?>" class="btn btn-primary">Edit Todo</a></td>
                        <td><a href="index.php?delete_todo=<?php echo $id; ?>" class="btn btn-danger">Delete Todo</a>
                        </td>
                    </tr>



                    <?php }

                    ?>
                </tbody>
            </table>
        </div>

    </main>

</body>

</html>