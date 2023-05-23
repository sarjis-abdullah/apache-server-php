<?php
if (file_exists('todo.json')) {
    $FILE_NAME = 'todo.json';
    $jsonTodos = file_get_contents($FILE_NAME);
    $todos = json_decode($jsonTodos, true);



    function filterItem($item){
        $id = $_POST['deleteableId'];

        if ($item['id'] != $id){
            return $item;
        }
    }

    $todos = array_filter($todos, 'filterItem');
    $jsonTodos = json_encode($todos, JSON_PRETTY_PRINT);
    file_put_contents($FILE_NAME, $jsonTodos);
//        echo '<pre>';
//        print_r($todos);
//        echo '</pre>';
}else {
    $todos = [];
}
header('Location: index.php');