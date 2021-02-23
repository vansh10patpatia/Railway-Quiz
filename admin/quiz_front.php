<?php

  require_once "header_front.php";
  require_once "nav_front.php";
  require_once "rightnavbar.php";
  require_once "sidebar_front.php";
  
  $i=1;
  $score=0;

  if(isset($_POST['answer']))
  {
    $id= $_POST['id'];
    $response = $_POST['answer'];
    $answer = $_POST['ans'.$id];
    if($response==$answer)
    {
      $querySuccess = $i;
      $score++;
    }
    else
    {
      $queryError = $i;
    }
  }

  // Displaying All records 
  $sql = "SELECT *  from questions";
    if($result = $conn->query($sql))
    {
      while($row = $result->fetch_assoc())
      {
          $data[]=$row; 
      }       
    }
    else
    {
      echo "error : ".$conn->error;
    }

?>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <!-- Alert -->
        <div class="row mb-2">
          <div class="col-sm-12">
          <?php
            if(isset($querySuccess))
            {
              ?>
                  <div class="alert alert-success" role="alert" id="alert12">
                    Answer is correct!
                    <br>
                    Score:<?=$score?>
                    <span class="close" onclick='removeAlert("alert12")'>x</span>
                  </div>
              <?php
            }
            else if(isset($queryError))
            {
              ?>
                  <div class="alert alert-danger" role="alert" id="alert12">
                    Answer is Wrong!
                    <br>
                    Score:<?=$score?>
                    <span class="close" onclick='removeAlert("alert12")'>x</span>  
                  </div>
              
              <?php
            }
             ?>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark"> <i class="bi bi-file-earmark-text"></i> Quiz</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">User</a></li>
              <li class="breadcrumb-item active">quiz</li>
            </ol>
          </div>
          <!-- /.col -->
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

            

              <!-- Questions Card -->
              <div class="card"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="bi bi-grid-3x3-gap"></i>&nbsp;<b>Questions</b></h3>
                </div>
                </div> 
              </div> 
              <?php
                if(isset($data))
                { 
                                    
                  foreach($data as $value)
                  {
              ?>
              <!-- Question  -->
              <div class="card"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <span class="text text-lg">Question <?=$i?></span>
                    <form method="post">
                      <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus "></i>
                        </button>
                        
                      </div>
                    </form>  
                  </div>
                </div> 
                <div class="card-body">
                  <div class="d-flex">
                    
                  </div>
                <form method="post">
                  <div class="d-flex">
                    <p class="p-1 w-100">
                      <?=$value['ques']?>
                      <input type="hidden" id="id" name="id" value="<?=$value['id']?>">
                      <input type="hidden" id="ans<?=$i?>" name="ans<?=$value['id']?>" value="<?=$value['correct_opt']?>">
                    </p>
                
                  </div>
                    <div class="d-flex">
                      <ul class="todo-list" data-widget="todo-list">
                      <li>
                        <!-- drag handle -->
                        
                        <!-- checkbox -->
                        <div  class="icheck-primary d-inline ml-12">
                          &nbsp;
                          &nbsp;
                          <label for="todoCheck1">a)</label>
                        </div>
                        <!-- todo text -->
                        <span class="text">
                          <button type="submit"  class="btn btn-outline-primary" style="border: none;" name="answer"  id="ans<?=$i?>" value="A" > <?=$value['opt1']?></button>
                        </span>
                        
                          &nbsp;
                          
                      </li>
                      <li>
                        
                        <div  class="icheck-primary d-inline ml-2">
                          &nbsp;
                          <label for="todoCheck2">b)</label>
                        </div>
                        <span class="text">
                         <button type="submit"  class="btn btn-outline-primary" style="border: none;" name="answer"  id="ans<?=$i?>" value="B" > <?=$value['opt2']?></button>
                        </span>
                        
                        &nbsp;
                       
                      </li>
                      <li>
                        
                        <div  class="icheck-primary d-inline ml-2">
                          &nbsp;
                          <label for="todoCheck3">c)</label>
                        </div>
                        <span class="text">
                          <button type="submit"  class="btn btn-outline-primary" style="border: none;" name="answer"  id="ans<?=$i?>" value="C" > <?=$value['opt3']?></button>
                        </span>
                        
                        &nbsp;
                       
                      </li>
                      <li>
                        
                        <div  class="icheck-primary d-inline ml-2">
                           &nbsp;
                           <label for="todoCheck4">d)</label>
                        </div>
                        <span class="text">
                          <button type="submit"  class="btn btn-outline-primary" style="border: none;" name="answer"  id="ans<?=$i?>" value="D" > <?=$value['opt4']?></button>
                        </span>
                        
                        &nbsp;
                        
                      </li>
                      
                      <div class="d-flex">
                        
                        <p class="p-2 flex-shrink-1">
                          
                            <button type="submit" style="display:none" class="btn btn-outline-primary" name="change"  id="up<?=$value['id']?>" value="<?=$value['id']?>" >Update</button>
                        </p>
                      </div>
                      </div> 
                    </div>  
                  </div>
                  <?php
                      $i++;
                      }
                    }
                  ?>
                </form>  
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
    require_once "script_link.php"
 ?>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script>
   function removeAlert(id)
  {
    $('#'+id).remove();
  }
</script>
</html>
