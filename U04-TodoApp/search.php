<?php
    //including php file to enable access to local database
    include "db.php";

    //query to enable searching of implemented todos
    //LIKE operator is used in conjunction with %$variable % to search for a pattern
    if (isset($_POST['search'])) {
        $search = $_POST['search'];
        $query = "SELECT * FROM todo WHERE name LIKE '%$search%'";
        $result = mysqli_query($connection, $query);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>U04-Todo-Application - PHP and MySQL database</title>
        <!--link to bootstrapCDN content delivery network to enable utilization of their css library-->
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!--local stylesheet, loading current timestamp on file path so it doesn't load from cache and remain unique-->
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
</head>
<body>
    <!--container class grouping several html-elements and some php-code to easier be able to style the visable content in css/bootstrap-->
    <div class="container">
        <div class="todo">
    <!--display-4 and other uncommon class names are examples of bootstrap typography, allowing addition of unique styles to html-elements-->
            <h1 class="display-4"><a href="index.php">Todo-app</a></h1> 
            <h2 class="lead">Search Todo</h2>
            
        <div class="search">
            <!--form-control provides styling with bootstrap..-->
            <!--using HTTP post transaction method to send form-data-->
            <form action="search.php" method="POST">
                <input type="text" class="form-control" name="search" placeholder="Todo Name">
            </form>
        </div>

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
                    <!--if result variable is equal to zero, witch means nothing is found, text will show up indicating no results found -->
                    <!--else, run while statement -->
                     <?php
                            if (mysqli_num_rows($result) === 0) {
                                echo "<tr>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<td>No result found</td>";
                                echo "<td></td>";
                                echo "<td></td>";
                                echo "<tr>";
                            }
                            else{                            
                    //associative arrays assigned to values placed on todo-tables located in dbTodo database
                        while ($row = mysqli_fetch_assoc($result)) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $date = $row['date'];
                            ?>
                    <?php

                            ?>

                    <!--getting output from database -->
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $date; ?></td>
                        <td> 
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Todo Done</label></td>
                        <!--linking to isset functions in php containing CRUD operations to manipulate data-->        
                        <td><a href="edit.php?edit-todo=<?php echo $id; ?>" class="btn btn-primary">Edit Todo</a></td>
                        <td><a href="index.php?delete_todo=<?php echo $id; ?>" class="btn btn-danger">Delete Todo</a></td>
                    </tr>



                       <?php }}

                    ?>
                </tbody>
            </table>
        </div>
    
    </div>
</body>
</html>