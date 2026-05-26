<?php 

$tasks_to_json = "./task.json";

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
        $task = $argv[2];
        $data['description'] = $task;

        if(!file_exists($tasks_to_json)) {
            file_put_contents($tasks_to_json, json_encode($data, JSON_PRETTY_PRINT));
        }
        
        $tasks_file = file_get_contents($tasks_to_json);
        $current_tasks = json_decode($tasks_file, true);
        $current_tasks[] = $data;
        file_put_contents($tasks_to_json, json_encode($current_tasks, JSON_PRETTY_PRINT));
        

        if(isset($argv[2])) {
            echo ('Task added sucessfully');
        }
        
        break;

    case 'update':
        
        break;

    case 'delete':
        
        break;

    case 'list':
        
        include "task.json";
        break;
    
    case 'list-in-progress':
        
        break;

    case 'list-done':
        
        break;

    case 'list-not-done':
        
        break;

    case 'mark-in-progress':
        
        break;

    case 'mark-done':
        
        break;

    
}
