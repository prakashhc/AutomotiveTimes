<?php
  ob_start();
  date_default_timezone_set('America/New_York');
  include 'dbh.inc.php';
  include 'comments.inc.php';
?>

<html>
  <head>

    <link rel = "icon" href="assets/logo.png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Toyota Camry Article</title>
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
    <!--HEADER-->
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



    <div class="camryArticle">
      <h2>The Legendary Toyota Camry Continues to Impress the Crowd</h2>
      <div class="overview">
      <p><strong>Overview: </strong>The Toyota Camry returns with the same design after being refreshed in the 2021 model year, but it continues to impress the crowds with its charm and diverse engine offerings.</p>
      </div>
      <img src="assets/camry.jpg">

      <div class = "camryArticleText">

        <h3>Engine Specifications</h3>
        <p>The Camry is available as a base four-cylinder, a hybrid, and a V6 - one that is quite rare in this segment. In the table below titled "Camry Engine Type vs. Specifications", we highlight some key differences in performance and price of the different engines to ease your search.</p>
        <div class="engineTable">
          <table>
            <thead>
              <th colspan="4">Camry Engine Type vs. Specifications</th>
            </tr>
            </thead>
            <tbody>
            <tr>
              <th></th>
              <th>4-Cyl</th>
              <th>Hybrid</th>
              <th>V6</th>
            </tr>


            <tr>
              <th>0-60</th>
              <td>7.9</td>
              <td>7.5</td>
              <td>5.8</td>

            </tr>
            <tr>
              <th>Horsepower (HP)</th>
              <td>203</td>
              <td>208</td>
              <td>301</td>

            </tr>
            <tr>
              <th>Base Cost</th>
              <td>$25,295</td>
              <td>$27,970</td>
              <td>$34,950</td>
            </tr>
            </tbody>
          </table>
        </div>


        <h3>Review</h3>
        <p>The Camry is not your grandma's car anymore. With the available options of designs, powertrains (AWD/FWD), and various number of colors, we think that the camry is a great option for all drivers. The nice, luxourious seats paired with the smooth drive make the car one of the best in its segment.</p>

        <div class ="pros-cons">
          <h3>Pros</h3>
          <ul>
            <li>Various color options</li>
            <li>Plentiful features</li>
            <li>Amazing Fuel Economy</li>
          </ul>
          <h3>Cons</h3>
          <ul>
            <li>Aged technology</li>
            <li>Must pay extra for optional features</li>
            <li>Body design needs an update -- last updated 5 years ago</li>
          </ul>
        </div>
      </div>
    </div>

    
      <h3 id=commentsTitle>Comments</h3>
      <div class="comments">
      <?php
        echo "<form method='POST' action='".setComments($conn)."'>

          <input type='hidden' name='date' value='".date('Y-m-d H:i:s')."'>
          <div class = 'formTitles'>
          <h2>Name: </h2><textarea name = 'uid'></textarea>
          <div class='anon'>
            <input type='checkbox' name='anonButton' id='checkBox'>Anonymous
          </div>
          <h2>Comment: </h2><textarea name = 'message'></textarea>
          </div>
          <div class='submitComment'>
          <button name='commentSubmit' type='submit'>Submit</button>
          </div>
        </form>";      

        getComments($conn);

        "</div>";

        ob_end_flush();

      ?>

    </div>





    <div class="bottomNavigation"> 
      <h1><i>Automotive Times</i></h1>
      <nav>
        <a href="index.html">Home</a> |
        <a href="reviews.html">Reviews</a> |
        <a href="picks.html">Top Picks</a> |
        <a href="about.html">About Us</a>
      </nav>
    </div>

  </body>

</html>