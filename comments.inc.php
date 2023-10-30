<?php

function setComments($conn){
  if (isset($_POST['commentSubmit'])){
    $uid = $_POST['uid'];
    if(isset($_POST['anonButton'])){ //allows users to remain anonymous with a click of a button
      $uid='Anonymous';
    }
    $date = $_POST['date'];
    $message = $_POST['message'];

     // Check if the user is banned
     if (isUserBanned($conn, $uid)) {
      header("Location: banned.php"); // Redirect to a page for banned users
      exit; // Make sure to exit to stop further execution
    }
  

    $sql = "INSERT INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message')";

    $result = $conn->query($sql);
    
  }

}

function getComments($conn){
  $sql = "SELECT * FROM comments";
  $result = $conn->query($sql);
  while($row = $result->fetch_assoc()){
    echo "<div class='commentbox'><p>";
      echo "<b>".$row['uid']."</b><br>";
      $date = new DateTime($row['date']);

      if ($date->format('Y-m-d') == date('Y-m-d')) {
        // Posted today
        echo "<i>Today, ".$date->format('h:i A')."</i><br><br><br>";
      } elseif ($date->format('Y-m-d') == date('Y-m-d', strtotime('-1 day'))) {
        // Posted yesterday
        echo "<i>Yesterday, ".$date->format('h:i A')."</i><br><br><br>";
      } else {
        // Posted on any other day
        echo "<i>".$date->format('F j, Y')."</i><br><br><br>";
      }
      echo nl2br($row['message']);
    echo "</p>
      <form class='delete-form' method='POST' action='".deleteComments($conn)."'>
        <input type='hidden' name='cid' value='".$row['cid']."'>
        <button name='commentDelete' type='submit'>Delete</button>
      </form>
      <form class='edit-form' method='POST' action='editcomment.php'>
        <input type='hidden' name='cid' value='".$row['cid']."'>
        <input type='hidden' name='uid' value='".$row['uid']."'>
        <input type='hidden' name='date' value='".$row['date']."'>
        <input type='hidden' name='message' value='".$row['message']."'>
        <button>Edit</button>
      </form>

      <form class='upvote-form' method='POST' action='".upvote($conn)."'>
        <input type='hidden' name='cid' value='".$row['cid']."'>
        <button name='upvoteButton' type='submit'><img src='assets/thumbsup.png' width='20px' height='20px'></button>
        <label id='upvoteLabel" . $row['cid'] . "'>" . $row['upVotes'] . "</label>
        </form>

        <form class='downvote-form' method='POST' action='".downvote($conn)."'>
        <input type='hidden' name='cid' value='".$row['cid']."'>
        <button type ='submit' name='downvoteButton'>
          <img src='assets/thumbsdown.png' width='20px' height='20px'></button>
        <label id='downvoteLabel" . $row['cid'] . "'>" . $row['downVotes'] . "</label>
        </form>


    </div>";
  }
}


function upvote($conn) {
  if (isset($_POST['upvoteButton'])) {
    $cid = $_POST['cid'];

    // Fetch the current 'upVotes' count for the comment with $cid
    $sql = "SELECT upVotes FROM comments WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $stmt->bind_result($currentUpvotes);
    $stmt->fetch();
    $stmt->close();


    // Increment the upVotes count
    $newUpvotes = $currentUpvotes + 1;

    // Update the 'upVotes' value in the database
    $updateSql = "UPDATE comments SET upVotes = ? WHERE cid = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ii", $newUpvotes, $cid);
    $updateStmt->execute();
    $updateStmt->close();

    // Redirect back to the comments page or another appropriate location
    header("Location: camry.php");
    exit;
  }
}

function downvote($conn) {
  if (isset($_POST['downvoteButton'])) {
    $cid = $_POST['cid'];

    // Fetch the current 'upVotes' count for the comment with $cid
    $sql = "SELECT downVotes FROM comments WHERE cid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $cid);
    $stmt->execute();
    $stmt->bind_result($currentDownvotes);
    $stmt->fetch();
    $stmt->close();


    // Increment the upVotes count
    $newDownvotes = $currentDownvotes + 1;

    // Update the 'upVotes' value in the database
    $updateSql = "UPDATE comments SET DownVotes = ? WHERE cid = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("ii", $newDownvotes, $cid);
    $updateStmt->execute();
    $updateStmt->close();

    // Redirect back to the comments page or another appropriate location
    header("Location: camry.php");
    exit;
  }
}







function editComments($conn){
  if (isset($_POST['commentSubmitEdit'])){
    $cid = $_POST['cid'];
    $uid = $_POST['uid'];
    $date = $_POST['date'];
    $message = $_POST['message'];

    $newDate = date('Y-m-d H:i:s');
    $sql = "UPDATE comments SET message='$message', date='$newDate' WHERE cid='$cid'";


    $result = $conn->query($sql);
    header("Location: camry.php");    
  }

}

function deleteComments($conn){
  if (isset($_POST['commentDelete'])){
    $cid = $_POST['cid'];

    $sql = "DELETE FROM comments WHERE cid = '$cid'";
    $result = $conn->query($sql);

    header("Location: camry.php");
  }
}


function isUserBanned($conn, $uid) {
  // Query the database to check if $uid is banned
  $query = "SELECT COUNT(*) FROM banned_users WHERE uid = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $uid);
  $stmt->execute();
  $stmt->bind_result($count);
  $stmt->fetch();
  $stmt->close();

  // If $count is greater than 0, the user is banned
  return $count > 0;
}

?>