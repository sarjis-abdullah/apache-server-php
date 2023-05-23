<?php
$todos = [];
if (file_exists('todo.json')) {
    $jsonTodos = file_get_contents('todo.json');
    $todos = json_decode($jsonTodos, true);

    $text1 = "hello";
    $text2 = "world";
//    $o = substr($text2, 1, 4);
//    $o = str_replace('hello', 'bye', $text1.$text2);
    $o = strtoupper($text1.$text2);
    print_r($o);

    $queries = [];
    parse_str($_SERVER['QUERY_STRING'], $queries);
    parse_str($_SERVER['QUERY_STRING'], $aa);

    if (count($queries) && isset($queries['complete'])){
        $todos = array_filter($todos, function ($item){
            if ($item['completed'])
                return $item;
        });
    }

    if (count($queries) && isset($queries['incomplete'])){
        $todos = array_filter($todos, function ($item){
            if (!$item['completed'])
                return $item;
        });
    }
    if (!empty($_POST['toggleableId']) && $_POST['toggleableId'] != ''){

        print_r($_POST['toggleableId']);
        $toggleableId = $_POST['toggleableId'];
        $todos = array_map(function ($todo) use ($toggleableId){
            if ($toggleableId == $todo['id']){
                $todo['completed'] = !$todo['completed'];
                return $todo;
            }
            return $todo;
        }, $todos);

        file_put_contents('todo.json', json_encode($todos, JSON_PRETTY_PRINT));
//        echo '<pre>';
//        print_r($todos);
//        echo '</pre>';
        unset($_POST['toggleableId']);
    }
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
<div style="display: flex; gap: 1rem">
    <a href="/"> Home </a>
    <a href="/?complete=true"> Complete </a>
    <a href="/?incomplete=true"> In Complete </a>
</div>
<ul>
    <h1>
        <?php echo count($todos)?>
    </h1>
    <ul>
        <?php foreach ($todos as $todo): ?>
            <li style="display: flex; gap: 1rem; border: 1px solid gray; max-width: 300px">
                <form action="" method="post">
                    <input type="checkbox" name="toggleableTodo" id="<?php echo $todo['id'] ?>"
                        <?php echo $todo['completed'] ? 'checked': ''; ?> >

                    <input type="hidden" name="toggleableId" value="<?php echo $todo['id'] ?>">

                </form>
                <?php echo $todo['name']; ?>
                <form action="delete.php" method="post">
                    <input type="hidden" name="deleteableId" value="<?php echo $todo['id'] ?>">
                    <input type="submit" value="Delete">
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</ul>

  <script>

      const selected = document.querySelectorAll('input[type=checkbox][name=toggleableTodo]')
        console.log(selected)
      selected?.forEach(item=> {
          item.onclick = function (){
              this.parentNode.submit()
          }
      })
  </script>
</body>
</html>