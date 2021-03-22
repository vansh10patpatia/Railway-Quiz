<!-- Main Sidebar Container -->

<?php

$sql = "SELECT * from response order by id desc limit 1";
    if($result = $conn->query($sql))
    {
        while($row = $result->fetch_assoc())
        {
            $category[]=$row;
        }    
    }
    foreach($category as $cat)
    {
        $type = $cat['category'];
    }

  $cate = $type;
  $sql = "SELECT *  from questions where category='$cate'";
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
      <center>
        <img src="./admin/dist/img/logo.png"  style="opacity: .8" height="100" width="100">
      </center>
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

                        <div class="card border-success mb-3" style="max-width: 18rem;">
                          <div class="card-header">
                            <div class="d-flex justify-content-between">
                              <span class="text text-lg">
                                <h5 style="color:Black">&nbsp;<i class="bi bi-file-earmark-text" ></i>&nbsp;&nbsp;Questions</h5>
                              </span>
                            </div>
                          </div>
                          <div class="card-body">
                            Category                                    :&nbsp;<?=$type?>
                            <br>
                            Number of Questions                         : &nbsp;<?=$rows?>
                          </div>
                        </div>
                     
                   
                    
                        <div class="card ">
                          
                            <div class="card-header">
                              <div class="d-flex justify-content-between">
                                <span class="text text-lg">
                                  <button type="button" class="btn btn-outline-light" onclick = "mainmenu()"><h5 style="color:Black"><i class="bi bi-person-badge"></i>&nbsp;&nbsp;&nbsp;Main Menu</h5></button>
                                    
                                </span>
                                
                              </div>
                            </div>
                            
                            
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
    function mainmenu()
    {
      if(confirm("Are you sure to go back to main menu?"))
      {
        window.location.href="./index";
      }
 
    }


  </script>