<?php

  require_once "header.php";
  require_once "navbar.php";
  require_once "rightnavbar.php";
  require_once "sidebar.php";
  

  // Deleting a Record
  if(isset($_POST['del']))
  {
      $id = $_POST['del'];
      // echo $id;
      $sql = "delete from questions where id='$id'";
      if($conn->query($sql))
      {
          $querySuccess = "Question Deleted Successfully!";
      }
      else
      {
          $queryError = "Error Occured while deleting the Question!";
      }
  }

  // Insering a Question
  if(isset($_POST['insert']) && isset($_POST['newquestion']) && !empty(($_POST['newquestion'])) && isset($_POST['optionA']) && !empty($_POST['optionA']) && isset($_POST['optionB']) && !empty($_POST['optionB']) && isset($_POST['optionC']) && !empty($_POST['optionC']) && isset($_POST['optionD']) && !empty($_POST['optionD']) && isset($_POST['option']) && isset($_POST['category']) && !empty($_POST['category']))
  {
    $question = $_POST['newquestion'];
    $opt1 = $_POST['optionA'];
    $opt2 = $_POST['optionB'];
    $opt3 = $_POST['optionC'];
    $opt4 = $_POST['optionD'];
    $ans = $_POST['option'];
    $category = $_POST['category'];

    setcookie("category", $category, time()+3600, "/","", 0);


    $sql = "insert into questions(ques,opt1,opt2,opt3,opt4,correct_opt,category) values('$question','$opt1','$opt2','$opt3','$opt4','$ans','$category')";

    if($conn->query($sql))
    {
      $querySuccess = "Question inserted Successfully!";
     }
    else
    {
      $queryError = "Error Occured while inserting the Question!";
      echo "error : ".$conn->error;
    }


  }
  

  $i=1;

  


  // Displaying All records 

  if(isset($_GET['token']))
  {

     $token = $_GET['token'];
     $sql = "SELECT *  from questions, ques_cat  where ques_cat.id = questions.category and ques_cat.category='$token'";
  }
  else
  {
    $sql = "SELECT *  from questions, ques_cat  where ques_cat.id = questions.category";  
  }
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

    $sql = "SELECT * from web_config where id='1'";

      if($result = $conn->query($sql))
      {
          $row = $result->fetch_assoc(); 
        
          $seconds=$row['quiz_time']; 
              
      }
      else
      {
        echo "error : ".$conn->error;
      }

  $sql = "SELECT category,id from ques_cat";
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

  // $sqll = "SELECT * from questions order by id desc limit 1";
  //   if($result = $conn->query($sqll))
  //   {
  //       while($row = $result->fetch_assoc())
  //       {
  //           $happy[]=$row;
  //       }    
  //   }
    

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
                    Request Successfully Proccessed
                    <span class="close" onclick='removeAlert("alert12")'>x</span>
                  </div>
              <?php
            }
            else if(isset($queryError))
            {
              ?>
                  <div class="alert alert-danger" role="alert" id="alert12">
                    <?=$queryError?>
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
              <li class="breadcrumb-item"><a href="#">Admin Panel</a></li>
              <li class="breadcrumb-item active">Quiz</li>
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

            <!-- Inserting Question -->
            <div class="card collapsed-card" id="add_ques"> 
              <div class="card-header" height="10">
                  <h5 class="card-title">             
                    Add Question!
                  </h5>
                  
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              
              <div class="card-body">
                <form method="post">
                  <div class="d-flex">
                    <div class="container">
                      <div class="row">
                        <div class="col-lg-10">
                          <h6>Question Category &nbsp;:</h6>
                        </div>
                        <div class="col-lg-2">
                          <select class="form-control" aria-label="Default select example" name="category">
                          <?php
                              if(isset($cat))
                              {
                                
                                foreach ($cat as $category)
                                {                               
                                  if(isset($token))
                                  {
                                    $sel = "";                                                                                                             
                                    if($token == $category['category'])
                                    {
                                          $sel = "selected";
                                    }
                                  
                                  ?>
                                  <option value="<?=$category['id']?>" <?=$sel?>><?=$category['category']?></option>
                                  <?php
                                  }
                                }
                              }
                          ?>

                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-lg-12">
                              <br>
                          <input class="form-control form-control-lg newField " type="text" name="newquestion" placeholder="Write New Question here!" required/>  
                        </div>
                        
                      </div>
                      <br>
                      <div class="row">
                        <ul class="todo-list" data-widget="todo-list">
                        <li>
                                                 
                          <!-- checkbox -->
                          <div  class="icheck-primary d-inline ml-12">
                            &nbsp;
                            
                            &nbsp;
                            <label for="todoCheck1">A</label>
                          </div>
                          <!-- todo text -->
                          <span class="text"><input type="text" class="form-control newField" name="optionA"  placeholder="Option A" required></span>
                                               
                        </li>
                        <li>
                          <div  class="icheck-primary d-inline ml-2">
                            &nbsp;
                            <label for="todoCheck2">B</label>
                          </div>
                          <span class="text"><input type="text" class="form-control newField" name="optionB" placeholder="Option B" required></span>
                         
                        </li>
                        <li>
                          <div  class="icheck-primary d-inline ml-2">
                            &nbsp;
                            <label for="todoCheck3">C</label>
                          </div>
                          <span class="text"><input type="text" class="form-control newField" name="optionC" placeholder="Option C" required></span>
                        
                        </li>
                        <li>
                          <div  class="icheck-primary d-inline ml-2">
                            &nbsp;
                            <label for="todoCheck4">D</label>
                          </div>
                          <span class="text"><input type="text" class="form-control newField"  name="optionD" placeholder="Option D" required ></span>                      
                        </li>
                        <li>
                        <label for="correctAnswer">Correct Answer:</label>
                        <input type="radio" value="A"  name="option" id="todoCheck1">
                        <label for="todoCheck1">A</label>
                        &nbsp;
                        <input type="radio" value="B" name="option" id="todoCheck2">
                        <label for="todoCheck2">B</label>
                        &nbsp;
                        <input type="radio" value="C" name="option" id="todoCheck3">
                        <label for="todoCheck3">C</label>
                        &nbsp;
                        <input type="radio" value="D" name="option" id="todoCheck4">
                        <label for="todoCheck4">D</label>
                      </li>
                      </ul>
                      </div> 
                      <div class="d-flex">
                        <p class="p-1 w-100"></p>
                        <p class="p-2 flex-shrink-1">
                          <button type="submit" class="btn btn-outline-primary" name="insert" id="insert">Insert</button>
                        </p>
                      </div>
                    </div>  
                  </div>
                </form>
          
                 </div>
            </div>
          


              <!-- Questions Card -->
              <div class="card"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="bi bi-stopwatch"></i>&nbsp;<b>Timer</b><small>(in seconds)</small></h3>
                    
                  
                    <div class="card-tools">
                    <div class="input-group mb-3">
                    
                      <input type="number" class="form-control" placeholder="Question Timer" id="timerrr" aria-label="Recipient's username" value="<?=$seconds?>" aria-describedby="basic-addon2">
                      
                      <div class="input-group-append">
                        <button class="input-group-text" id="basic-addon2" onclick="addTimer()" style="background-color:dodgerblue">Update</button>
                      </div>
                    
                    </div>
                    </div>
                  </div>
                </div> 
              </div> 
              <div class="card"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="bi bi-grid-3x3-gap"></i>&nbsp;<b>Questions</b></h3>
                  
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
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
                        <Button type="button" class="btn btn-tool" name="upd" id="editques<?=$value['id']?>" value="<?=$value['id']?>" onclick="editquestion(<?=$value['id']?>)"><i class="bi bi-pencil-square"></i></Button>
                        <Button type="submit" class="btn btn-tool" name="del" value="<?=$value['id']?>"><i class="bi bi-trash-fill"></i></Button>
                      </div>
                    </form>  
                  </div>
                </div> 
                <div class="card-body">
                      <div class="row">
                          <div class="col-lg-10">Question Category &emsp;:</div>
                            <div class="col-lg-2">
                              <select class="form-control" aria-label="Default select example" name="category" disabled id="category<?=$value['id']?>">
                              <?php
                                  if(isset($cat))
                                  {
                                    foreach ($cat as $category)
                                    {
                                        $selected=''; 
                                        if($value['category'] == $category['category'])
                                        {
                                          $selected='selected';
                                        }
                                         
                                          ?>
                                          <option value="<?=$category['category']?>" <?=$selected?>><?=$category['category']?></option>
                                          <?php
                                        
                                      
                                    }
                                  }
                              ?>
                              </select>
                            </div>
                          </div>
                <form method="post">
                  <div class="d-flex">
                    <p class="p-1 w-100">
                                  <br>
                        <input type="text" class="form-control disabledElements" value="<?=$value['ques']?>" name="question<?=$value['id']?>" oninput="setElementId('question<?=$value['id']?>')" id="question<?=$value['id']?>" disabled>
                        <!-- <input type="hidden" class="form-control" value="<?=$value['ques']?>"  id="question<?=$value['id']?>" > -->
                    </p>
                    <p class="p-2 flex-shrink-1">
                      <!-- <Button type="button" class="btn btn-tool" name="upd" id="editques<?=$value['id']?>" value="<?=$value['id']?>" onclick="editquestion(<?=$i?>)"><i class="bi bi-pencil-square"></i></Button> -->
                      
                    </p>
                  </div>
                      <div class="d-flex">
                      <ul class="todo-list" data-widget="todo-list">
                      <li>
                        <div  class="icheck-primary d-inline ml-12">
                          &nbsp;
                          &nbsp;
                          <label for="todoCheck1">A</label>
                        </div>
                        <!-- todo text -->
                        <span class="text">
                          <input type="text" class="form-control disabledElements" name="option_a<?=$value['id']?>" oninput="setElementId('option1<?=$value['id']?>')" id="option1<?=$value['id']?>" value="<?=$value['opt1']?>" disabled>
                          <!-- <input type="hidden" class="form-control" name="option_a<?=$value['id']?>" id="option1<?=$value['id']?>" value="<?=$value['opt1']?>"> -->
                        </span>
                        
                          &nbsp;
                          <!-- <Button type="button" class="btn btn-tool"  name="edit" id="edit1<?=$value['id']?>" onclick="makeEditable(1<?=$i?>)"><i class="bi bi-pencil-square"></i></Button> -->
                          
                        
                      </li>
                      <li>
                        
                        <div  class="icheck-primary d-inline ml-2">
                          &nbsp;
                          <label for="todoCheck2">B</label>
                        </div>
                        <span class="text">
                          <input type="text" class="form-control disabledElements" name="option_b<?=$value['id']?>" oninput="setElementId('option2<?=$value['id']?>')" id="option2<?=$value['id']?>" value="<?=$value['opt2']?>" disabled>
                          <!-- <input type="hidden" class="form-control" name="option_b<?=$value['id']?>" id="option2<?=$value['id']?>" value="<?=$value['opt2']?>"> -->
                        </span>
                        
                        &nbsp;
                        <!-- <Button type="button" class="btn btn-tool"  name="edit" id="edit2<?=$value['id']?>" onclick="makeEditable(2<?=$i?>)"><i class="bi bi-pencil-square"></i></Button> -->
                         
                      </li>
                      <li>
                        
                        <div  class="icheck-primary d-inline ml-2">
                          &nbsp;
                          <label for="todoCheck3">C</label>
                        </div>
                        <span class="text">
                          <input type="text" class="form-control disabledElements" name="option_c<?=$value['id']?>" oninput="setElementId('option3<?=$value['id']?>')" id="option3<?=$value['id']?>" value="<?=$value['opt3']?>" disabled>
                          <!-- <input type="hidden" class="form-control" name="option_c<?=$value['id']?>" id="option3<?=$value['id']?>" value="<?=$value['opt3']?>"> -->
                        </span>
                        
                        &nbsp;
                        <!-- <Button type="button" class="btn btn-tool"  name="edit" id="edit3<?=$value['id']?>" onclick="makeEditable(3<?=$i?>)"><i class="bi bi-pencil-square"></i></Button> -->
                        
                      </li>
                      <li>
                        
                        <div  class="icheck-primary d-inline ml-2">
                           &nbsp;
                          <label for="todoCheck4">D</label>
                        </div>
                        <span class="text">
                          <input type="text" class="form-control disabledElements" name="option_d<?=$value['id']?>" oninput="setElementId('option4<?=$value['id']?>')"  id="option4<?=$value['id']?>" value="<?=$value['opt4']?>" disabled >
                        </span>
                        
                        &nbsp;
                        
                      </li>
                      <li>
                        <label for="correctAnswer">Correct Answer:</label>
                        <select class="form-control" aria-label="Default select example" name="answer<?=$value['id']?>" disabled id="answer<?=$value['id']?>">
                                        <?php
                                        $select1='';
                                        $select2='';
                                        $select3='';
                                        $select4=''; 
                                        if($value['correct_opt'] == "A")
                                        {
                                          $select1='selected';
                                        }
                                        else if($value['correct_opt'] == "B")
                                        {
                                          $select2='selected';
                                        }
                                        else if($value['correct_opt'] == "C")
                                        {
                                          $select3='selected';
                                        }
                                        else if($value['correct_opt'] == "D")
                                        {
                                          $select4='selected';
                                        }
                                         
                                          ?>
                                          <option value="A" <?=$select1?>><?=$value['opt1']?></option>
                                          <option value="B" <?=$select2?>><?=$value['opt2']?></option>
                                          <option value="C" <?=$select3?>><?=$value['opt3']?></option>
                                          <option value="D" <?=$select4?>><?=$value['opt4']?></option>
                                          <?php?>
                                        
                        </select>

                        <!-- <input type="radio" value="A" <?=$opt1?> name="option<?=$value['id']?>" id="todoCheck1<?=$value['id']?>" onclick="updatebutton(<?=$value['id']?>)" >
                        <label for="todoCheck1">A</label>
                        &nbsp;
                        <input type="radio" value="B" <?=$opt2?> name="option<?=$value['id']?>" id="todoCheck2<?=$value['id']?>" onclick="updatebutton(<?=$value['id']?>)" >
                        <label for="todoCheck2">B</label>
                        &nbsp;
                        <input type="radio" value="C" <?=$opt3?> name="option<?=$value['id']?>" id="todoCheck3<?=$value['id']?>" onclick="updatebutton(<?=$value['id']?>)" >
                        <label for="todoCheck3">C</label>
                        &nbsp;
                        <input type="radio" value="D" <?=$opt4?> name="option<?=$value['id']?>" id="todoCheck4<?=$value['id']?>" onclick="updatebutton(<?=$value['id']?>)" >
                        <label for="todoCheck4">D</label> -->
                      </li>
                      <div class="d-flex">
                        
                        <p class="p-2 flex-shrink-1">
                          <button type="button" style="display:none" class="btn btn-outline-primary" name="change"  id="up<?=$value['id']?>" value="<?=$value['id']?>" onclick="updateAjax(<?=$value['id']?>)" >Update</button>
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
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script> -->
<script>

  var  editElementId='';

  // function makeEditable(counter)
  // {
  //   $(".form-control").attr("disabled",true);
  //   $(".newField").attr("disabled",false);

  //   $(".btn-tool").show();
  //   var a = counter%10;
  //   // $("#update"+counter).show();
  //   // $("#edit"+counter).hide();
  //   $("#up"+a).show();
  //   $("#update"+counter).attr('name',"change")
  //   $("#option"+counter).attr("disabled",false)
  // } 

  function editquestion(counter)
  { 
    $(".form-control").attr("disabled",true);
    $("#question"+counter).attr("disabled",false);
    $(".newField").attr("disabled",false);
    $(".btn-tool").show();
    // $("#editques"+counter).hide();
    $("#up"+counter).show(); 
    // $("#up"+counter).attr('name',"change");
    $("#option1"+counter).attr("disabled",false);
    $("#option2"+counter).attr("disabled",false);
    $("#option3"+counter).attr("disabled",false);
    $("#option4"+counter).attr("disabled",false);
    $("#category"+counter).attr("disabled",false);
    $("#answer"+counter).attr("disabled",false);


    
  }

  function updatebutton(counter)
  {
    $("#up"+counter).show(); 
    $(".form-control").attr("disabled",true);
    $("#question"+counter).attr("disabled",false);
    $(".newField").attr("disabled",false);
    $(".btn-tool").show();
    // $("#editques"+counter).hide();
    $("#up"+counter).show(); 
    // $("#up"+counter).attr('name',"change");
    $("#option1"+counter).attr("disabled",false);
    $("#option2"+counter).attr("disabled",false);
    $("#option3"+counter).attr("disabled",false);
    $("#option4"+counter).attr("disabled",false);
  }

  function removeAlert(id)
  {
    $('#'+id).remove();
  }

  function setElementId(id)
  {
    editElementId = id;
  }

  $(function()
  {
    $(".disabledElements").on("input",function(e)
    {
      $("#"+editElementId).val($(this).val())
    })
  });


  function updateAjax(id)
  {
    var ques = $("#question"+id).val();
    var opt1 = $("#option1"+id).val();
    var opt2 = $("#option2"+id).val();
    var opt3 = $("#option3"+id).val();
    var opt4 = $("#option4"+id).val();
    var ele =  document.getElementsByName('option'+id);
    var ans = $("#answer"+id).val();
    var category =$("#category"+id).val()
    console.log(category);
   
    //  for(i = 0; i < ele.length; i++) 
    //   { 
    //     if(ele[i].checked) 
    //     {
    //       ans = ele[i].value;
    //     }
    //   }

      // console.log(ques);
      // console.log(opt1);
      // console.log(opt2);
      // console.log(opt3);
      // console.log(opt4);
      // console.log(ans);
      $.ajax(
        {
          url:'quiz_ajax.php',
          type:"POST",
          data:{change:id,
                question:ques,
                opt1:opt1,
                opt2:opt2,
                opt3:opt3,
                opt4:opt4,
                ans:ans ,
                category:category        
              },
              success : function(data)
                {
                  if(data.trim()=="updated")
                  {
                    $("#up"+id).hide(); 
                    $(".form-control").attr("disabled",true);
                    $("#question"+id).attr("disabled",true);
                    $(".newField").attr("disabled",false);
                    $(".btn-tool").show();
                    // $("#editques"+id).hide();
                    // $("#up"+id).attr('name',"change");
                    $("#option1"+id).attr("disabled",true);
                    $("#option2"+id).attr("disabled",true);
                    $("#option3"+id).attr("disabled",true);
                    $("#option4"+id).attr("disabled",true);
                  }              

                },
                error:
                function(err){} 

      });
  }

  function addTimer()
  {
    var timer = $("#timerrr").val();
    $.ajax(
        {
          url:'quiz_ajax.php',
          type:"POST",
          data:{      
                  timer : timer
              },
              success : function(data)
                {
                  if(data.trim()=="ok")
                  {

                  }
                },
                error:
                function(err){} 

      });
  }
</script>
</html>
