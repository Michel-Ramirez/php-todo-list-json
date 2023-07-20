<?php

// consento accesso al server 

header("Access-Control-Allow-Origin: null");
header("Access-Control-Allow-Headers: X-Requested-With");


//recupero i dati dal file con una directory
$database_path = __DIR__ . '/../../database/tasks.json';


//legge il contenuto dal file json
$json_data = file_get_contents($database_path);

//trasforma un file json in un array o in array associativo php
$tasks = json_decode($json_data, true);


//controllo se abbiamo qualcosa in POST
$new_task = $_POST['task'] ?? null;

//se c'è un nuovo task allora lo pusho
if ($new_task) {
    //lo aggiungo ai task
    $tasks[] = $new_task;

    //lo converto in file json
    $json_tasks = json_encode($tasks);
    //lo pusho nel file json
    file_put_contents($database_path, $json_tasks);

    //comunico che tipo di file riceve
    header('Content-type: application/json');

    echo $new_task;
} else {

    //comunico che tipo di file riceve
    header('Content-type: application/json');

    //converto in file json
    echo json_encode($tasks);
};
