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
    
    $sql="update questions set ques='$question' , opt1='$opt1' , opt2='$opt2' , opt3='$opt3' , opt4='$opt4' , correct_opt='$ans' where id='$id'";

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

?>