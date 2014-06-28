<?php

if(isset($_POST['note'])) {
    $note[] = (string)$_POST['note'];
    
    $db = new PDO('mysql:host=localhost;dbname=notes', "root", "");
    
    $select = $db->prepare("INSERT INTO notes (note) VALUES (?)");
    $select->execute($note);
    
    if($select->rowCount() != 0) {
        //do something useful
        echo "recorded";
    } else {
        //meeh...
        echo "Unable to create note…";
    }
} else {
    echo "there's nothing to show";
}