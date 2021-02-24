<!-- Main Sidebar Container -->

<?php

$sql = "SELECT *  from questions";
    if($result = $conn->query($sql))
    {
      $rows = mysqli_num_rows($result);    
    }
    else
    {
      echo "error : ".$conn->error;
    }
?>
<aside class="main-sidebar sidebar-white-primary elevation-4" style="background: linear-gradient(to bottom, #cc99ff 0%, #66ccff 100%);">
    <!-- Brand Logo -->
    <a href="quiz_front.php" class="brand-link" >
      <img src="./admin/dist/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <h2 style=" background: -webkit-linear-gradient(#993333 0%, #000066 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;font-style: italic;" ><b>Railway</b>
      </h2>
    </a>

    

       <!-- Sidebar Menu -->
       <br>
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <li class="nav-item has-treeview menu-open">
            
            <ul class="nav nav-treeview">
              <div class="container">

                  
                    <div class="card">
                        <div class="card-header">
                          <div class="d-flex justify-content-between">
                            <span class="text text-lg">
                              <h5 style="color:Black">&nbsp;<i class="bi bi-file-earmark-text" ></i>&nbsp;&nbsp;Questions</h5>
                            </span>
                          </div>
                        </div>
                        <div class="card-body">
                        <?php
                                $x=0;
                                $button = $rows/4 ;
                                $reminder = $rows% 4;
                                if($rows%4==0)
                                {
                                  $a=$button;
                                  $b=4;
                                }
                                else
                                {
                                  $a=$button+1;
                                }
                                  for($i=1 ; $i <= $a ; $i++)
                                  {
                                    
                                      ?>
                                <div class="d-flex">
                                <input type="hidden" value="<?=$rows?>">
                                <?php
                                  if($i*4>=$rows)
                                  {
                                    $b=$rows%4;
                                  }
                                  else
                                  {
                                    $b=4;
                                  }
                                for($j=1 ; $j <= $b ; $j++)
                                { $x++;
                                ?>
                                 
                                <p class="p-1 w-100">
                                <!-- onclick="showQuestion('<?=$x?>')" -->
                                  <button class="btn btn-light" type="button" id="quesNO<?=$x?>" style="border-top-left-radius:2.5vh;border-bottom-right-radius:2.5vh;background-color:#E8E8E8" ><?=$x?></button>
                                </p>
                                   <?php
                                  }      
                                ?>

                                 </div>
                                 <?php
                                  }
                                 ?>
                          
                          
                        </div>
                    </div>
                    
                        <div class="card ">
                          
                            <div class="card-header">
                              <div class="d-flex justify-content-between">
                                <span class="text text-lg">
                                  <a href="instructions.php">
                                    <h5 style="color:Black">&nbsp;<i class="bi bi-book"></i>&nbsp;&nbsp;Instructions</h5>
                                  </a>
                                </span>
                                
                              </div>
                            </div>
                            
                            <!-- <div class="card-body">
                              <div class="d-flex">
                                <p class="p-1 w-100">
                                  <small>1) Read the question carefully. </small>
                                </p>
                              </div>
                              <div class="d-flex">
                                <p class="p-1 w-50">
                                <small>2) Each question Should be attempted in the given time.</small>
                                </p>
                              </div>

                            </div> -->

                        </div>
                  
                </div>  
            </ul>
          </li>
        </ul>
      </nav> 
      <!-- /.sidebar-menu -->
    <!-- </div> -->
    <!-- /.sidebar -->

  </aside>
  <script>
    function showQuestion(quesNo)
    {
      var counter=quesNo-1;
      var questions = [];
      var QUESTION_TIME = 10000000000000;
      var questionTimer = QUESTION_TIME;
      var timeCounterRef;
      $.ajax({
            url:'user_ajax.php',
            type:'POST',
            data:{
                questions:true
            },
            success:function(data)
            {
                    var obj = JSON.parse(data);
                    if(obj.msg.trim()=="ok")
                    {
                        questions = obj.questions;
                        show(questions[counter]);
                        console.log("hello");
                        // start_timer();
                    }
                    if(obj.msg.trim()=="error")
                    {
                        
                    }
            }
        });

        function show(question)
      {
        $("button[class*= btn-success]").attr('class','btn btn-outline-primary')
        $("button[class*= btn-danger]").attr('class','btn btn-outline-primary')
        $(".optbtn").prop('disabled',false);
        $("#question").html(question['ques']);
        $("#op1").html(question['opt1']);
        $("#op2").html(question['opt2']);
        $("#op3").html(question['opt3']);
        $("#op4").html(question['opt4']); 
        var quesNo = questionCounter+1;
        $("#timer").html(QUESTION_TIME+"&nbsp;Seconds")

        $("#quesNo").html("Question "+quesNo);
        // console.log(questions.length,questionCounter)   
        if(questionCounter+1==questions.length)
        {
            $("#nextBtn").html("Finish");
            // console.log(questions.length,questionCounter)
        }
      }
      function start_timer()
      {
          timeCounterRef = setInterval(function()
          {
              if(questionTimer==0)
              {
                  questionCounter++;
                  questionTimer = QUESTION_TIME;
                  if(questionCounter >= questions.length)
                  {
                      questionCounter=questions.length-1;
                      clearInterval(window.timeCounterRef);
                      $('#quiz_section').hide();
                      $('.result').show(); 
                  }
                  show(questions[questionCounter]);
              }
              questionTimer--;
              $("#timer").html(`<span><b>0${questionTimer}&nbsp;Seconds</b></span>`)
          }, 1000);    
      }
    function resetTimer()
    {
        questionTimer = QUESTION_TIME;
    }
  }
    


  </script>