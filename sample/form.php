<!DOCTYPE html>

<html>
    <head>
        <meta charset = "utf-8">
        <title>Search Results</title>
        <link rel="stylesheet" type="text/css" href="my.css">
    </head>

    <body>
        <?
    
        include "config.php";
        
        $iserror = false;
        $action = isset($_POST[ "action" ]) ? $_POST[ "action" ] : "";
        $id = isset($_POST[ "id" ]) ? $_POST[ "id" ] : "";
        $datedue = isset($_POST[ "datedue" ]) ? $_POST[ "datedue" ] : "";
        $title = isset($_POST[ "title" ]) ? $_POST[ "title" ] : "";
        $body = isset($_POST[ "body" ]) ? $_POST[ "body" ] : "";
        $complete = isset($_POST[ "complete" ]) ? $_POST[ "complete" ] : "";
        
        // set action to submit if POST!
        // ensure that all fields have been filled in correctly
        if ( isset( $_POST["submit"] ) ) {
            if ( $title == "" ) {
                //$formerrors["title"] = true;
                $iserror = true;
            } // end if
            if ( $datedue == "" ) {
                //$formerrors["datedue"] = true;
                $iserror = true;
            } // end if
            //$action = 'update';
        }
        
        if (DEBUG)
            echo "<p>Running action: ".$action."</p>";
        //if ($action != "new" && $id == "")
        //    die("no ID passed...");
        
        // connect to database
        try {
            $dsn = "mysql:host=$DB[HOST];dbname=$DB[NAME]";
            $pdo = new PDO($dsn, $DB['USER'], $DB['PASS'], $pdo_opts); 
        } catch(PDOException $e) { 
            die("ERROR: Could not connect. " . $e->getMessage()); 
        } 


        // Handle actions
        switch ($action) {
        case "add":
            $data = [
                    'datedue'   => $datedue,
                    'title'     => $title,
                    'body'      => $body,
                    'complete'  => $complete,
                ];
            $sql = "INSERT INTO tasks (datedue,title,body,complete) 
                    VALUES (:datedue, :title, :body, :complete)";
                    
            if (DEBUG)
                echo ("<p>".$sql."</p>");
            try {
                $qry = $pdo->prepare($sql);
                $res = $qry->execute($data);
                echo "<p>$id successfully added task.</p>";
            } catch (PDOException $e) {
                echo "ERROR: Could not able to execute $sql. " .
                $e->getMessage(); 
            }
            
            ?>
            <script>
                var timer = setTimeout(function() {
                    window.location='list.php'}, 3000);
            </script>
            <?
            die();
            break;            
            
        case "edit":
            $sql = "SELECT taskid,datecreatemodify,datedue,title,body,complete 
                    FROM tasks 
                    WHERE taskid = ".$id;
            if (DEBUG)
                echo ("<p>".$sql."</p>");
            try {
                $qry = $pdo->query($sql);
                $res = $qry->fetch();
            } catch (PDOException $e) {
                echo "ERROR: Could not able to execute $sql. " .
                $e->getMessage(); 
                die();
            }

            if (DEBUG)
                foreach ($res as $key => $value)
                    echo "<p>key: $key, value: $value</p>";
            break;
            
        case "delete":
            $sql = "DELETE FROM tasks WHERE taskid = ".$id;
            if (DEBUG)
                echo ("<p>".$sql."</p>");

            try {
                $pdo->exec($sql);
                echo "<p>Task successfully deleted.</p>";
            } catch (PDOException $e) {
                echo "ERROR: Could not able to execute $sql. " .
                $e->getMessage();
                die();
            }
            ?>
            <script>
                var timer = setTimeout(function() {
                    window.location='list.php'}, 3000);
            </script>
            <?
            die();
            break;
            
        case "update":
            $sql = "UPDATE tasks
                    SET title = '".$title."', 
                    datedue = '".$datedue."', 
                    body = '".$body."',
                    complete = ".$complete."
                    WHERE taskid = ".$id;
            if (DEBUG)
                echo ("<p>".$sql."</p>");

            try {
                $pdo->exec($sql);
                echo "<p>Sucessfully updated - returning to list...</p>";
            } catch (PDOException $e) {
                echo "ERROR: Could not able to execute $sql. " .
                $e->getMessage(); 
                die();
            }
            
            ?>
            <script>
                var timer = setTimeout(function() {
                    window.location='list.php'}, 3000);
            </script>
            <?
            die();
            break;
    
        }

        ?>
        <h1>My Task Tracker - Edit</h1>
        <?

        // array of name values for the text input fields
        //$inputlist = array( "datedue" => "Date Due",
        //    "title" => "Task Title", "body" => "Long Description");
        ?>  
        
        <!-- post form data to form.php -->
        <form method = 'post' action = '#'>
            <h2>Task information</h2>
            <!-- create four text for user input -->
            
            <p>Title:&nbsp&nbsp<input type="text" name="title" 
                value='<? echo $res['title']; ?>'> </p>    
            <p>Date Due (e.g. 2019-04-28 23:32:46):&nbsp&nbsp
            <? if ($res['datedue'])
                    echo "<input type=\"text\" name=\"datedue\" value=\"$res[datedue]\">";
                else
                    echo "<input type=\"datetime-local\" name=\"datedue\">";
            ?></p>
            <p>Full Description:
            <textarea name="body"><? echo $res['body']; ?></textarea></p>                
        <?
        //foreach ( $inputlist as $inputname => $inputalt ) {
        //    if ( $inputname == 'body' )
        //        print( "<div><label>$inputalt:</label>
        //            <textarea
        //            name = '$inputname'>" . $res[$inputname] . "</textarea>" );
            //else
            //    print( "<div><label>$inputalt:</label><input type = 'text'
              //      name = '$inputname' value = '" . $res[$inputname] . "'>" );


            //if ( $formerrors[ ( $inputname )."error" ] == true )
            //    print( "<span class = 'error'>*</span>" );
            
            //print( "</div>" );
        //} // end foreach
        // Radio button for complete status
        if ( $res['complete'] == 1 ) { 
            ?>
            <input type="radio" name="complete" value="0">Not Complete
            <input type="radio" name="complete" value="1" checked>Complete<br>
            <?
        } else {
            ?>
            <input type="radio" name="complete" value="0" checked>Not Complete
            <input type="radio" name="complete" value="1">Complete<br>
            <?
        }
        if ($action == 'edit') {
        ?>
            <input type="hidden" name="id" value="<? echo "$id" ?>" />
            <input type="hidden" name="action" value="update" />
        <?
        // If no action specified, we assume add...
        } elseif ($action == '') {
        ?>
            <input type="hidden" name="action" value="add" />
        <? } ?>
            <button type="submit" name="submit">Submit</button>
            <button type="cancel" onclick="window.location='list.php';return false;">Cancel</button>
        </form>
        <?        
        
        unset($pdo);
        ?>
    </body>
</html>