<?php 
if (file_exists('todo.json')) {
  $jsonTodos = file_get_contents('todo.json');
  $todos = json_decode($jsonTodos, true);
  $unique = [];

  foreach ($todos as $todo){
    if (!in_array($todo["id"], array_column($unique, 'id'))){
      $unique[] = $todo;
    }
  }
  $todos = $unique;
}else {
  $todos = [];
}
if (isset($_POST['fname']) && $_POST['fname'] != '') {
  $todos = [...$todos, [
    'id' => uniqid(),
    'completed' => true,
    'name' => $_POST['fname']
  ]];

  $jsonTodos = json_encode($todos, JSON_PRETTY_PRINT);
  file_put_contents('todo.json', $jsonTodos);
}

header('Location: index.php');
exit();




