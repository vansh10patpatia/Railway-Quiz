<?php

  require_once "header.php";
  require_once "nav_front.php";
  require_once "rightnavbar.php";
  require_once "instruction_sidebar.php";
  
    if(isset($_POST['username']) && isset($_POST['start']))
    {
      $naam = $_POST['username'];
      
        $sql = "insert into response(username) values('$naam')";
        if($conn->query($sql))
        {
          $querySuccess = "Question inserted Successfully!";
        ?>
        <script>
          window.location.href="http://localhost/Railway-Quiz/quiz_front.php";
        </script>
        <?php
        }
        else
        {
          $queryError = "Error Occured while inserting the Question!";
          echo "error : ".$conn->error;
        }
     
      
    }
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- Alert -->
        <div class="row mb-2">
          <div class="col-sm-12">
          
          </div>
        </div>
      </div>
      
    </div>
    

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

          <?php
            if(isset($result))
            {
              ?>
                  <div class="alert alert-danger" role="alert" id="alert12">
                    <?=$result?>
                    <span class="close" onclick='removeAlert("alert12")'>x</span>
                  </div>
              <?php
            }
          ?>
             
              <!-- Question  -->
              <div class="card"> 
                <div class="card-header" STYLE="background: linear-gradient(to left, #808080 0%, #ffccff 100%);">
                  <div class="d-flex justify-content-between">
                    <span class="text text-lg"  id="quesNo"><i class="bi bi-book"></i>&nbsp;Instructions </span>
                    <!-- <div id="timer">
                      
                        <span><i class="bi bi-clock-fill"></i>00:00:10</span>
                    </div> -->
                    
                  </div>
                </div> 
                <div class="card-body">
                  <form method="post">
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Enter your Name:</label>
                      <input type="text" class="form-control" name="username" id="exampleFormControlInput1" placeholder="Your name" required>
                    </div>
                    <p>1) Read the question carefully.</p> 
                    <p>2) Each question Should be attempted in the given time. </p>
                    <p>3) You cannot reattempt the question.</p>
                    <p>4) Ensure that you use the washroom before arriving for your exam as you will not be permitted to leave during the first hour.</p>
                    <p>5) Once you click on the option your response for that particular question gets submitted.</p>
                    <p>6) At last you will get your scorecard for your answers.</p>
                    <p>7) After attempting the question you cannot go back and reattempt any of the question.</p>
                    <center>
                    <div class="typewriter">
                        <h1 class="typewriter-text " style=" background: -webkit-linear-gradient(red 0%, orange 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;font-size:50px;font-style: italic;">All The Best!</h1>
                    </div>
                      <!-- <a href="quiz_front.php"> -->
                      <button type="submit" class="btn btn-outline-success" name="start" id="start">Start Attempt</button>
                      <!-- </a> -->
                    </center>
                  </form>
                </div>              
              </div> 
            </div>  
        </div>
                  

      </div>
    </div>
            
  </div>
         

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

 <?php
    require_once "footer.php";
    
 ?>


</body>
<?php
   require_once 'js-links.php';
   
?>

<script>
  // $(function()
  // {
  //   var namr = $("#exampleFormControlInput").val();
  //   console.log(name);
  //   if(name != '')
  //   {
  //     $("#start").attr('disabled',false);
  //   }
  // });

  $(function()
  {
    $("#exampleFormControlInput").on("input",function(e)
    {
      $("#start").attr('disabled',false);
    })
  });

  function removeAlert(id)
  {
    $("#"+id).remove();
  }
</script>
  
