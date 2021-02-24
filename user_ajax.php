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
    

?>