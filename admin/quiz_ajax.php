<?php
  require_once "../lib/core.php";


if(isset($_POST['change']))
  {
    $id= $_POST['change'];
    $question = $_POST['question'];
    $opt1 = $_POST['opt1'];
    $opt2 = $_POST['opt2'];
    $opt3 = $_POST['opt3'];
    $opt4 = $_POST['opt4'];
    $ans = $_POST['ans'];
    $category =$_POST['category'];
    
    $sql="update questions set ques='$question' , opt1='$opt1' , opt2='$opt2' , opt3='$opt3' , opt4='$opt4' , correct_opt='$ans',category='$category' where id='$id'";

    if($conn->query($sql))
    {   
        echo "updated";
      $querySuccess = true;
    }
    else
    {
        echo "error";
      $queryError = true;
    }
  }

  if(isset($_POST['timer']))
  {
    $timer = $_POST['timer'];

    $sql = "update web_config set quiz_time='$timer' where id='1'";
    if($conn->query($sql))
    {   
        echo "ok";
      $querySuccess = true;
    }
    else
    {
        echo "error";
      $queryError = true;
    }
  }

?>