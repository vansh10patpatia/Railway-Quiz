<?php

  require_once "header.php";
  require_once "nav_front.php";
  require_once "rightnavbar.php";
  require_once "instruction_sidebar.php";
  
    if(isset($_POST['username']) && isset($_POST['start']))
    {
      $naam = $_POST['username'];
      $category = $_POST['category'];
      
        $sql = "insert into response(username,category) values('$naam','$category')";
        if($conn->query($sql))
        {
          setcookie("category",$category, time() + 3600, "/");   
          $querySuccess = "Question inserted Successfully!";
        ?>
        <script>
          window.location.href="./quiz_front";
        </script>
        <?php
        }
        else
        {
          $queryError = "Error Occured while inserting the Question!";
          echo "error : ".$conn->error;
        }
     
      
    }
    $sql = "SELECT category from ques_cat";
      if($result = $conn->query($sql))
      {
        while($row = $result->fetch_assoc())
        {
            $cat[]=$row; 
        }       
      }
      else
      {
        echo "error : ".$conn->error;
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
                      <div class="row">
                          <div class="col-lg-6">
                            <label for="exampleFormControlInput1">Enter your Name:</label>
                          </div>
                          <div class="col-lg-6">
                            <input type="text" class="form-control" name="username" id="exampleFormControlInput1" placeholder="Your name" required>
                        </div>
                          
                      </div>
                      <br>
                      <div class="row">
                      <div class="col-lg-6">
                              <label for="exampleFormControlInput1">Select Category:</label>
                          </div>
                        <div class="col-lg-6">
                        
                        <select class="form-control" aria-label="Default select example" name="category"  id="category">
                              <?php
                                  if(isset($cat))
                                  {
                                    foreach ($cat as $category)
                                    {
                                                                                
                                          ?>
                                            <option value="<?=$category['category']?>" ><?=$category['category']?></option>
                                          <?php
                                        
                                      
                                    }
                                  }
                              ?>
                              </select>
                        </div>
                      </div>
                    </div>
                    <p>1) Read the question carefully.</p> 
                    <p>2) Each question Should be attempted in the given time. </p>
                    <p>3) Ensure that you use the washroom before arriving for your exam as you will not be permitted to leave during the first hour.</p>
                    <p>4) Once you click on the option your response for that particular question gets submitted.</p>
                    <p>5) At last you will get your scorecard for your answers.</p>
                    <p>6) After attempting the question you cannot go back and reattempt any of the question.</p>
                    <center>
                    <div class="typewriter">
                        <h1 class="typewriter-text " style=" background: -webkit-linear-gradient(red 0%, orange 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;font-size:50px;font-style: italic;">All The Best!</h1>
                    </div>
                      <!-- <a href="quiz_front.php"> -->
                      <button type="submit" class="btn btn-outline-success" name="start" onclick="setCookie()" id="start">Start Attempt</button>
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

  function setCookie()
  {
      var cname = "category";
      var cvalue = $("#category").val();
      var d = new Date();
      d.setTime(d.getTime() + (1*1*60*60*1000));
      var expires = "expires="+ d.toUTCString();
      document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
  }

  function removeAlert(id)
  {
    $("#"+id).remove();
  }
</script>
  
