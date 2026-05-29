<?php 

function display_tasks_helper(array $tasks) {
    echo "+--------------------------------------------------------------+\n";
    echo "|  ID  |  Description  | Status  |  Created At  |  Updated At  |\n";
    echo "+--------------------------------------------------------------+\n";
    foreach($tasks as $t) {
        printf ("|%4s  | %9s     |   %4s  | %4s |  %4s   |\n", $t['id'], $t['description'], $t['status'], $t['created_at'], $t['updated_at']);
        echo "+--------------------------------------------------------------+\n";
    }
    

}

function get_task_helper() {
    global $tasks_to_json;
    $task_file = file_get_contents($tasks_to_json);
    return json_decode($task_file, true);
}

function save_task_helper($tasks_to_save) {
    global $tasks_to_json;
    return file_put_contents($tasks_to_json, json_encode($tasks_to_save, JSON_PRETTY_PRINT));
}