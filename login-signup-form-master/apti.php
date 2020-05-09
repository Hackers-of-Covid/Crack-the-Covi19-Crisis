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
      <h4>Dashboard</h4>
      <ul class="nav nav-pills nav-stacked">
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="apti.php" target="_self">Aptitude</a></li>
        <li><a href="tech.php" target="_self">Techincal</a></li>
        <li><a href="#section3" target="_self">Your Scores</a></li>
        <li><a href="logout.php">Log out</a></li>
      </ul><br>


    </div>

    <div class="col-sm-9">
      <hr>
      <center>
<div class="title">Today's Quiz</div>
<?php
                              if (isset($_POST['click']) || isset($_GET['start'])) {
                              @$_SESSION['clicks'] += 1 ;
                              $c = $_SESSION['clicks'];
                              if(isset($_POST['userans'])) { $userselected = $_POST['userans'];

                              $fetchqry2 = "UPDATE `quiz` SET `userans`='$userselected' WHERE `id`=$c-1";
                              $result2 = mysqli_query($con,$fetchqry2);
                              }


                              } else {
                                $_SESSION['clicks'] = 0;
                              }

                              //echo($_SESSION['clicks']);
                              ?>
<div class="bump"><br><form><?php if($_SESSION['clicks']==0){ ?> <button class="button" name="start" float="left"><span>START QUIZ</span></button> <?php } ?></form></div>
<form action="" method="post">
<table><?php if(isset($c)) {   $fetchqry = "SELECT * FROM `quiz` where id='$c'";
      $result=mysqli_query($con,$fetchqry);
      $num=mysqli_num_rows($result);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC); }
    ?>
<tr><td><h3><br><?php echo @$row['que'];?></h3></td></tr> <?php if($_SESSION['clicks'] > 0 && $_SESSION['clicks'] < 6){ ?>
<tr><td><input required type="radio" name="userans" value="<?php echo $row['option 1'];?>">&nbsp;<?php echo $row['option 1']; ?><br>
<tr><td><input required type="radio" name="userans" value="<?php echo $row['option 2'];?>">&nbsp;<?php echo $row['option 2'];?></td></tr>
<tr><td><input required type="radio" name="userans" value="<?php echo $row['option 3'];?>">&nbsp;<?php echo $row['option 3']; ?></td></tr>
<tr><td><input required type="radio" name="userans" value="<?php echo $row['option 4'];?>">&nbsp;<?php echo $row['option 4']; ?><br><br><br></td></tr>
<tr><td><button class="button3" name="click" >Next</button></td></tr> <?php }
                                ?>
<form>
<?php if($_SESSION['clicks']>5){
$qry3 = "SELECT `ans`, `userans` FROM `quiz`;";
$result3 = mysqli_query($con,$qry3);
$storeArray = Array();
while ($row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
   if($row3['ans']==$row3['userans']){
   @$_SESSION['score'] += 1 ;
 }
}

?>


<h2>Result</h2>
<span>No. of Correct Answer:&nbsp;<?php echo $no = @$_SESSION['score'];
session_unset(); ?></span><br>
<span>Your Score:&nbsp<?php echo $no*2; ?></span>
<?php } ?>
<!-- <script type="text/javascript">
  function radioValidation(){
  /* var useransj = document.getElementById('rd').value;
      //document.cookie = "username = " + userans;
  alert(useransj); */
  var uans = document.getElementsByName('userans');
  var tok;
  for(var i = 0; i < uans.length; i++){
    if(uans[i].checked){
      tok = uans[i].value;
      alert(tok);
    }
  }
  }
</script> -->
</center>

      <hr>


      <br><br>



    </div>
  </div>
</div>


</body>
</html>
