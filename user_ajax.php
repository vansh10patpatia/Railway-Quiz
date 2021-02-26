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
    
    
if(isset($_POST['time']))
{
    $timershow = "SELECT * from admin where id='2'";

    if($result = $conn->query($timershow))
    {
        while($row = $result->fetch_assoc())
        {
            $seconds[]=$row;
        }    

        
    }
    foreach($seconds as $sec)
    {
        echo $sec['type'];
    }
    // else
    // {
    //     echo "error : ".$conn->error;
    // }
}
?>