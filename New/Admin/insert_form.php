<!DOCTYPE html>
<html>
  <head>
    <meta charset = "utf-8">
    <title>Insert Form</title>
    <link rel="stylesheet" href="styles.css">
  </head>

  <body>
    <header><img src = "tamuc-logo.png" alt = "TAMUC" />
      <div class = "flexbox">
        <?php include 'menu.php';?>
      </div>
    </header>	

    <div class = "body_box">
      <div><form action="insert.php" method = "post">
	      Title: <input type= "text" name = "Title" required><br>
	      Body:<br><textarea name= "Body" rows="50" cols="50" required></textarea><br>
	      Post Date: <input type= "text" name = "post_date" placeholder = "yyyy-mm-dd" required><br>
	      Author: <input type= "text" name = "author" required><br>
	      <input type = "submit">
          </form>
    </div></div>
 
  </body>
</html>
