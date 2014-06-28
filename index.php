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
                        <textarea name="note" cols="43" rows="4"></textarea> 
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
                    <tr>
                        <td>a</td>
                        <td>b</td>
                        <td>c</td>
                        <td>d</td>
                    </tr>
                    <tr>
                        <td>a1</td>
                        <td>b1</td>
                        <td>c1</td>
                        <td>d1</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </body>
</html>
