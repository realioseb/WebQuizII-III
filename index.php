<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz II and III</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <section id="content">
            <form method="post" action="notes.php"> 
                <fieldset> 
                    <legend>Add note</legend> 
                    <div> 
                        <textarea name="note" cols="12" rows="4"></textarea> 
                    </div> 
                </fieldset> 
                <div> 
                    <button type="submit" name="save">Save</button> 
                </div>
            </form>
            
            <table>
                <thead>
                    <th>Note</th>
                    <th>ID</th>
                    <th>Date</th>
                    <th><a href='delete.php'>Del</a></th>
                </thead>
                <tbody>
                    <?php
                        $db = new PDO('mysql:host=localhost;dbname=notes', "root", "");

                        $select = $db->prepare("SELECT * FROM notes");
                        $select->execute();

                        $notes = $select->fetchAll();
                        $length = count($notes);

                        $result = "";

                        foreach ($notes as $note) {
                            $result .= "<tr>";
                            
                            $result .= "<td>" . $note['note'] . "</td>";
                            $result .= "<td>" . $note['id'] . "</td>";
                            $result .= "<td>" . $note['date'] . "</td>";
                            $result .= "<td><input type='checkbox' value='" . $note['id'] . "'></td>";
                            
                            $result .= "</tr>";
                        }
                        
                        echo $result;
                    ?>
                </tbody>
            </table>
        </section>
        <section id="msg">
            
        </section>
        <script src="js.js"></script>
    </body>
</html>
