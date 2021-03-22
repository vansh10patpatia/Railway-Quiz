<?php

require_once "../lib/core.php";

    if(isset($_POST['change']))
    {
        $category = $_POST['category'];
        $id = $_POST['change'];
        $sql = "update ques_cat set category='$category' where id='$id'";
        if($conn->query($sql))
        {
            echo "updated";
        }
        else
        {
            echo "error : ".$conn->error;
        }
    }
?>