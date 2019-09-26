<!DOCTYPE html>

<html>
    <head>
        <meta charset = "utf-8">
        <title>Search Results</title>
        <link rel="stylesheet" type="text/css" href="my.css">
    </head>

    <body>
        <?
        
        include 'config.php';
        
        // connect to database
        try {
            $dsn = "mysql:host=$DB[HOST];dbname=$DB[NAME]";
            $pdo = new PDO($dsn, $DB['USER'], $DB['PASS'], $pdo_opts); 
        } catch(PDOException $e) { 
            die("ERROR: Could not connect. " . $e->getMessage()); 
        } 
        
        $sql = "SELECT taskid,datecreatemodify,datedue,title,complete
                FROM tasks
                ORDER BY complete ASC, datedue ASC";

        try {
            $qry = $pdo->query($sql);
            $data = $qry->fetchall();
        } catch (PDOException $e) {
            echo "ERROR: Could not able to execute $sql. " .
            $e->getMessage(); 
        }
        

        ?>
        <h1>My Task Tracker</h1>
        <form action="form.php" method="post">
            <button type="cancel" onclick="window.location='index.html';return false;">Main Page</button>
            <button type="submit">Add Task</button>
        </form>
        <br>
        <table>
            <caption>Tasks are presented in ascending order by duedate</caption>
            <tr>
                <th>ID</th>
                <th>Date Created</th>
                <th>Date Due</th>
                <th>Title</th>
                <th>Complete</th>
                <th>Action</td>
            </tr>
            <?
            $numOfRows = sizeof($data);
            
            // Current unix time
            $currentEpoch = time();
            
            if (DEBUG) {
                echo "Current Epoch: $currentEpoch<br>";
                echo "Warning Epoch: $threshold[warning] <br>";
            }
            
            for ($i=0; $i < $numOfRows; $i++) {
                $eventEpoch = strtotime($data[$i]["datedue"]);
                $diff = $currentEpoch - $eventEpoch;
                
                if (DEBUG)
                    echo "Event Epoch: $eventEpoch Difference from Current: $diff <br>";
                
                if ($data[$i]["complete"])
                    echo "<tr class=\"complete\">";
                else
                    
                    if ($diff > 0 )
                        echo "<tr class=\"critical\">";
                    elseif (abs($diff) <= $threshold['warning'] )
                        echo "<tr class=\"warning\">";
                    else
                        echo "<tr class=\"pending\">";
                    
                print("<td>" . stripslashes($data[$i]["taskid"]) . "</td>");
                print("<td>" . stripslashes($data[$i]["datecreatemodify"]) . "</td>");
                print("<td>" . stripslashes($data[$i]["datedue"]) . "</td>");
                print("<td>" . stripslashes($data[$i]["title"]) . "</td>");
    
                if ($data[$i]["complete"])
                    print("<td>Complete</td>");
                else
                    print("<td>Not Complete</td>");
                
                ?>    
                <td>
                    <form class="formfloat" action="form.php" method="post">
                        <input type="hidden" name="id" 
                            value="<? echo $data[$i]["taskid"]; ?>" />
                        <input type="hidden" name="action" 
                            value="edit" />
                        <button type="submit">Edit</button>
                    </form>
                    <form class="formfloat" action="form.php" method="post">
                        <input type="hidden" name="id" 
                            value="<? echo $data[$i]["taskid"]; ?>" />
                        <input type="hidden" name="action" 
                            value="delete" />
                        <button type="submit">Delete</button>
                    </form>
                </td></tr>
                <?
            }
            unset ($pdo);    
        ?>
        </table>
        <br>
        <p>Legend:
            <strong class="greenbg">Complete</strong>&nbsp;&nbsp;
            <strong class="yellowbg">Due within 48 hours or less</strong>&nbsp;&nbsp;
            <strong class="redbg">Over Due</strong>&nbsp;&nbsp;
        </p>
        <br><p><strong>Reference time (Central): <? 
            date_default_timezone_set("America/Chicago");
            echo date('d-m-Y H:i:s');
        ?></strong></p>
    </body>
</html>