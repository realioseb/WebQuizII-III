<?php
$db = new PDO('mysql:host=localhost;dbname=notes', "root", "");

$deletables = json_decode($_POST['del']);
$check = 1;

foreach($deletables as $id) {
    $select = $db->prepare("DELETE FROM notes WHERE id = ?");
    $select->execute(array($id));
    
    $check *= $select->rowCount();
}

$stat = array(
    'status' => array(
        'message' => 'Unable to delete notes'
    )
);

if($check == 1) {
    $stat['status']['message'] = 'Deleted succesfully';
}

header('HTTP/1.1 200 OK', true, 200);
header('Content-Type: application/json');

echo json_encode($stat);