<?php

include __DIR__ . "/helpers.php";

$tasks_to_json = "./task.json"; // tasks path

if(!isset($argv[1])) {
    exit ("You have to add an action argument"); // error output
}

$action = strtolower($argv[1]); // transforming all input into lowercase

$current_date = date('Y/m/d H:i:s A', time());


$data = [
    'id' => 1,
    'description' => null,
    'status' => 'Todo',
    'created_at' => $current_date,
    'updated_at' => null
];



switch($action) {

    case 'add':
        if(!isset($argv[2])) {
            exit ('Description is required');
        }
        
        $data['description'] = $argv[2];

        if(!file_exists($tasks_to_json)) {
            file_put_contents($tasks_to_json, "[]");
        }

        $current_tasks = get_task_helper(); // decoding json to array
        $count = count($current_tasks);
        foreach($current_tasks as $curr) {
    
            if($curr['id'] <= $count) {
                $curr['id'] += $count;
                $data['id'] = $curr['id'];  
            }
            break;
        }
        $current_tasks[] = $data; // adding new data into array
        save_task_helper($current_tasks); // saving new data and parsing back to json
    

        if(isset($argv[2])) {
            echo ('Task added sucessfully');
        }
        
        break;

    case 'update':
        if(!isset($argv[2])) {
            exit ('Select ID task to update');
        }

        
        $task_id = $argv[2];
        $new_task = $argv[3] ?? null;
        
        $current_tasks = get_task_helper();


        for($i = 0; $i < count($current_tasks); $i++){
            
            if($current_tasks[$i]['id'] == $task_id) {
                if($new_task == null){
                    continue;
                } else {
                    $current_tasks[$i]['description'] = $new_task;
                }
                $current_tasks[$i]['updated_at'] = $current_date;
                
            }
        }
        
        save_task_helper($current_tasks);
        
        
        
        break;

    case 'delete':
        if(!isset($argv[2])) {
            exit ('ID is required to delete task');
        }
        
        $task_id = $argv[2];
        $found = 0;
        
        $current_tasks = get_task_helper();

        for($i = 0; $i < count($current_tasks); $i++) {
        
            // Fazer ele deletar todas as Tasks // PARA FAZER DEPOIS

            if($current_tasks[$i]['id'] == $task_id) {
                unset($current_tasks[$i]); // unset function deletes even the index and doesnt reindex automaticly       
                echo "Task $task_id deleted successfully";
                $found = true;      
            }

        }

        if($found) {

            $current_tasks = array_values($current_tasks); // Reindex the array
            
            save_task_helper($current_tasks);

        } else {
            exit("This ID does not exists");
        }
        break;

    case 'list':
        
        // include "task.json";
        $current_tasks = get_task_helper();
        // var_dump($current_tasks);
        // die();
        display_tasks_helper($current_tasks);

        break;
    
    case 'list-in-progress':
        
        break;

    case 'list-done':
        
        break;

    case 'list-not-done':
        
        break;

    case 'mark-in-progress':
         // TODO NEXT
        break;

    case 'mark-done':
        
        break;

    
}
