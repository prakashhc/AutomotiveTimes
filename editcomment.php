<?php
  date_default_timezone_set('America/New_York');
  include 'comments.inc.php';
  include 'dbh.inc.php';
  session_start();
?>

<html>
  <head>

    <link rel = "icon" href="assets/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Edit Comment</title>
    <!--Fonts:-->
    <!--Heading 1 and header-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald&family=Roboto:wght@100&family=Young+Serif&display=swap" rel="stylesheet">
    <link href="style.css" rel="stylesheet" type="text/css" />
    <!--Heading 2 (article titles)-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">
    <!--Article text font-->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:opsz,wght@6..12,500;6..12,700&family=Playfair+Display:wght@400;500;600&display=swap" rel="stylesheet">


  </head>

  <body>
    <div class="navigation">
      <div id="headline">
        <h1><i><a href=index.html>Automotive Times</h1></i></a>
      </div>
      <nav>
        <a href="index.html">Home</a> |
        <a href="reviews.html">Reviews</a> |
        <a href="picks.html">Top Picks</a> |
        <a href="about.html">About Us</a>

      </nav>

    </div>
    
      <div class='spacing'></div>
      <?php
      
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];


        echo "<form method='POST' action='".editComments($conn)."'>
          <input type='hidden' name='cid' value='".$cid."'>
          <input type='hidden' name='uid' value='".$uid."'>
          <input type='hidden' name='date' value='".$date."'>
          <textarea name = 'message'>$message</textarea><br>
          <div class='editorButton'>
            <button name='commentSubmitEdit' type='submit'>Edit</button>
          </div>
  
        </form>";      

        if (isset($_POST['commentSubmit'])) {
          // Call the editComments function to update the comment
          editComments($conn);
        }
      ?>

    </div>

  </body>

</html>