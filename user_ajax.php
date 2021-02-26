<?php
    require_once "lib/core.php";

    if(isset($_POST['questions']))
    {
        $question=[];
        $sql = "SELECT *  from questions";
        if($result = $conn->query($sql))
        {
          while($row = $result->fetch_assoc())
          {
              $questions['questions'][] = $row;
              
          }       
            $questions['msg'] ='ok';
            echo  json_encode($questions);
        }
        else
        {
            $questions['msg'] ='error';
            echo  json_encode($questions);
        }
    }
    
    if(isset($_POST['response']))
    {
        $response = $_POST['response'];
        $sql = "insert into response(username) values('$response')";
        if($conn->query($sql))
        {
            echo "responsed";
        }
        else
        {
          $queryError = "Error Occured while inserting the Question!";
          echo "error : ".$conn->error;
        }

    }

?>