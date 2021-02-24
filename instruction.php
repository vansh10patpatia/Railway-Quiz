<?php

  require_once "header.php";
  require_once "nav_front.php";
  require_once "rightnavbar.php";
  require_once "instruction_sidebar.php";
  
  
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

        
        
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-12">

            

             
              <!-- Question  -->
              <div class="card"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <span class="text text-lg"  id="quesNo"><i class="bi bi-book"></i>&nbsp;Instructions </span>
                    <!-- <div id="timer">
                      
                        <span><i class="bi bi-clock-fill"></i>00:00:10</span>
                    </div> -->
                    
                  </div>
                </div> 
                <div class="card-body">
                  <!-- <div class="d-flex">
                    
                  </div>-->
    
                      <p>1) Read the question carefully.</p> 
                      <p>2) Each question Should be attempted in the given time. </p>
                      <p>3) You cannot reattempt the question.</p>
                      <p>4) Ensure that you use the washroom before arriving for your exam as you will not be permitted to leave during the first hour.</p>
                      <center>
                        <h1 class="display-4">All The Best!</h1>
                        <a href="quiz_front.php">
                        <button type="submit" class="btn btn-success">Start Quiz</button>
                        </a>

                      </center>

                     
                  </div>
                
                </div> 
              </div>  
          </div>
                  
                   
        </div>
      </div>
            
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
  
