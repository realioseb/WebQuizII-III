<?php
$db = new PDO('mysql:host=localhost;dbname=notes', "root", "");

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note[] = $_POST['note'];
    
    $insert = $db->prepare("INSERT INTO notes (note) VALUES (?)");
    $insert->execute($note);

    if($insert->rowCount() != 0) {
        $stat = array(
            'status' => array(
                'message' => 'Note was created succesfully...'
            )
        );
        
        header('HTTP/1.1 201 Created', true, 201);
        header('Content-Type: application/json');
        echo json_encode($stat);
    } else {
        $stat = array(
            'status' => array(
                'message' => 'Unable to create note'
            )
        );
        
        header('HTTP/1.1 400 Bad Request', true, 400);
        echo json_encode($stat);
    }
} elseif($_SERVER['REQUEST_METHOD'] === 'GET') {
    $select = $db->prepare("SELECT * FROM notes");
    $select->execute();
    
    $notes = $select->fetchAll();
    
    $length = count($notes);

    $result = array();

    foreach($notes as $key => $note) {
        $result[] = array();
        
        $result[$key]['id'] = $note['id'];
        $result[$key]['note'] = $note['note'];
        $result[$key]['date'] = $note['date'];
    }
    
    echo json_encode($result);
}