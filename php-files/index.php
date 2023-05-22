<?php
$todos = [];
if (file_exists('todo.json')) {
    $jsonTodos = file_get_contents('todo.json');
    $todos = json_decode($jsonTodos, true);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Hello PHP</title>
</head>
<body>
<form action="/create.php" method="POST">
  <label for="fname">First todo:</label>
  <input type="text" id="fname" name="fname"><br><br>
  <input type="submit" value="Submit">
</form>
<ul>
    <ul>
        <?php
        foreach ($todos as $todo):
            ?>
            <li>
                <?php echo $todo['name']; ?>
            </li>
        <?php
        endforeach;
        ?>
    </ul>
</ul>

  
</body>
</html>