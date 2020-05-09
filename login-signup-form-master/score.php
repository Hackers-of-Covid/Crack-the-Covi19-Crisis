<?php

require('db.php');
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {height: 1500px}

    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
    }
    pre{
      border-radius: 20px;
      font-family:monospace;
      font-weight:bold;
      font-size: 17px;
      line-height: 25px;
    }

    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }

    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;}
    }
    .button {
  display: inline-block;
  border-radius: 4px;
  background-color: #f4511e;
  border: none;
  color: #FFFFFF;
  text-align: center;
  font-size: 28px;
  padding: 20px;
  width: 500px;
  transition: all 0.5s;
  cursor: pointer;
  margin: 5px;
}

.button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}
.title{
	background-color: #ccc11e;
	font-size: 28px;
  padding: 20px;

}
.button3 {
    border: none;
    color: white;
    padding: 10px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    cursor: pointer;
}
.button3 {
    background-color: white;
    color: black;
    border: 2px solid #f4e542;
}
table,tr,td,th
{
  padding: 6px;
  border:1px solid black;
}
table{
  width: 800px;
}

.button3:hover {
    background-color: #f4e542;
    color: Black;
}
  </style>
</head>
<body>

<div class="container-fluid">
  <div class="row content">
    <div class="col-sm-3 sidenav">
      <h3>Dashboard</h3>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="#section1">Home</a></li>
        <li><a href="apti.php" target="_self">Aptitude</a></li>
        <li><a href="tech.php" target="_self">Techincal</a></li>
        <li class="active"><a href="score.php" target="_self">Your Scores</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul><br>

    </div>

    <div class="col-sm-9">
      <hr>
      <h2>Welcome <?php echo ucfirst($_SESSION["username"]) ?></h2>
      <hr>
      <h4>Your Progess </h4>
      <?php
        $ex=$_SESSION["username"];
        $sql = "SELECT username, score, description,quizdate FROM result where username='$ex'";
        $result = $con->query($sql);

        if ($result->num_rows > 0) {
          echo "<table><tr><th>Username</th><th>Score</th><th>Description</th><th>Date of the test</th></tr>";
      while($row = $result->fetch_assoc()) {
      echo "<tr><td>".ucfirst($row["username"])."</td><td>".$row["score"]."</td><td>".$row["description"]."</td><td>".$row["quizdate"]."</td></tr>";
  }
      echo "</table>";
  } else {
        echo "0 results";
}
  $con->close();
  ?>



      <br><br>



    </div>
  </div>
</div>


</body>
</html>
