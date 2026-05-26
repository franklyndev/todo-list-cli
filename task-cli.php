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
        
        $data['description'] = $argv[2];

        if(!file_exists($tasks_to_json)) {
            file_put_contents($tasks_to_json, "[]");
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
        if(!isset($argv[2])) {
            exit ('Select ID task to update');
        }
        if(!isset($argv[3])) {
            exit ('Rewrite the task');
        }
        $task_id = $argv[2];
        $new_task = $argv[3];

        $tasks_file = file_get_contents($tasks_to_json);
        $current_tasks = json_decode($tasks_file, true);

        $task_updated = $current_tasks;
        $task_updated[$task_id]['description'] = $new_task;

        file_put_contents($tasks_to_json, json_encode($task_updated, JSON_PRETTY_PRINT));
        
        
        break;

    case 'delete':
        if(!isset($argv[2])) {
            exit ('ID is required to delete task');
        }
        $task_id = $argv[2];
        $task_file = file_get_contents($tasks_to_json);
        $task_decoded = json_decode($task_file, true);
        
        unset($task_decoded[$task_id]);
        
        $task_encoded = json_encode($task_decoded, JSON_PRETTY_PRINT);

        file_put_contents($tasks_to_json, $task_encoded);


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
