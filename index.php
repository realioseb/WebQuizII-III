<html>
    <head>
        <meta charset="UTF-8">
        <title>Quiz II and III</title>
        <link href="style.css" rel="stylesheet">
    </head>
    <body>
        <section>
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
                    <th>Delete</th>
                </thead>
                <tbody>
                    <?php
                        $db = new PDO('mysql:host=localhost;dbname=notes', "root", "");

                        $select = $db->prepare("SELECT * FROM notes");
                        $select->execute();

                        $notes = $select->fetchAll();
                        $length = count($notes);

                        $result = "";

                        for($i = 1; $i <= $length; $i++) {
                            $j = $length-$i;
                            $result .= "<tr>";
                            $result .= "<td> note " . ($j+1) . " </td>";
                            $result .= "<td>" . $notes[$j]['id'] . "</td>";
                            $result .= "<td>" . $notes[$j]['date'] . "</td>";
                            $result .= "<td><a href='#'>delete</td>";
                            $result .= "</tr>";
                        }
                        
                        echo $result;
                    ?>
                </tbody>
            </table>
        </section>
    </body>
</html>
