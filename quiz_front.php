<?php

  require_once "header.php";
  require_once "nav_front.php";
  require_once "rightnavbar.php";
  require_once "sidebar_front.php";
  
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
      $timer =  $sec['type'];
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
          <div class="col-lg-12" id="quizMainSection">

            

              <!-- Questions Card -->
              <div class="card" id="time"> 
                <div class="card-header" style="background: linear-gradient(to right, #33ccff 0%, #ff99cc 100%);">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="bi bi-stopwatch"></i>&nbsp;<b>Time Left:</b></h3>
                    <div id="timer">
                      
                        <input type="hidden" id="samay" value="<?=$timer?>">
                    </div>
                </div>
                </div> 
              </div> 
              
              <!-- Question  -->
              <div class="card" id="questions"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                    <span class="text text-lg"  id="quesNo">Question </span>
                    <!-- <div id="timer">
                      
                        <span><i class="bi bi-clock-fill"></i>00:00:10</span>
                    </div> -->
                    
                  </div>
                </div> 
                <div class="card-body">
                  <!-- <div class="d-flex">
                    
                  </div>-->
                  <div id="quiz_section" style="margin: 30px;">
    
                      <p id="question"></p> 
                      <label for="A">a)</label>
                      <button type="button" id="op1" class="btn btn-outline-primary optbtn" style="border:none"  name="op" value="A">
                      </button>
                      <br><br>
                      <label for="A">b)</label>
                      <button type="button" id="op2" class="btn btn-outline-primary optbtn" style="border:none"  name="op" value="B">
                      </button>
                      <br><br>
                      <label for="A">c)</label>
                      <button type="button" id="op3" class="btn btn-outline-primary optbtn" style="border:none" name="op" value="C">
                      </button>
                      <br><br>
                      <label for="A">d)</label>
                      <button type="button" id="op4"  class="btn btn-outline-primary optbtn" style="border:none" name="op" value="D">
                      </button>
                      <br><br>

                      <div class="d-flex">
                        <p class="p-1 w-100">
                          <button type="button" id="nextBtn"  class="btn btn-primary" style="border-bottom-right-radius:15vh;border-top-right-radius:15vh;" >NEXT</button>
                        </p>
                        <p class="p-2 flex-shrink-1">
                          
                        </p>
                      </div>
                      <div class="d-flex justify-content-end">
                      <button type="button"  onclick="finishQuiz('confirmMode')" class="btn btn-outline-success" style="border-radius:8vh">Finish Attempt</button>
                      </div>
                  </div>
                
                </div> 
              </div>  
          </div>
           <div class="col-lg-12" id = "Result" style="display:none">

           <div class="card" id="questions"> 
                <div class="card-header">
                  <div class="d-flex justify-content-between">
                        <h1>Results</h1>
                        <h1 id="score">Results</h1>
                    <!-- <div id="timer">
                      
                        <span><i class="bi bi-clock-fill"></i>00:00:10</span>
                    </div> -->
                    
                  </div>
                  
                </div> 
                <div class="card-body" id="resultBody"> 
                 
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
    
<script>
var questionCounter=0;
var questions = [];
var QUESTION_TIME = $("#samay").val();
var questionTimer = QUESTION_TIME;
var timeCounterRef;
var correct_answer = 0;
var wrong_answer = 0;
    $(function()
    {
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
                        show(questions[questionCounter]);
                        start_timer();
                    }
                    if(obj.msg.trim()=="error")
                    {
                        
                    }
            }
        });

      

        $("#nextBtn").click(function(e)
        {
                        if(questionCounter+2==questions.length)
                        {
                            $(this).hide();
                             //console.log(questions.length,questionCounter)
                        }
                        
                    if(questionCounter >= questions.length-1)
                    {
                        ///console.log(questions.length,questionCounter)

                        
                        questionCounter=questions.length-1; 
                        finishQuiz();
                    }
                    else
                    {
                        resetTimer();
                        show(questions[++questionCounter]);
                    }
                    // console.log(questionCounter);

                    // if($("#quesNO"+questionCounter).css('backgroundColor') == '#0066FF')
                    // {     
                    //       console.log(questionCounter);
                    //       $("#quesNO"+questionCounter).css('backgroundColor','#0066FF');

                    // } 

        });
        
        $(".optbtn").click(function (e)
        {
            var user_ans=$(this).val();
            var check=check_ans(questions[questionCounter]); 
            $("button[class*=  optbtn]").attr('class','btn btn-outline-primary optbtn')
            $("button[class*=  optbtn]").attr('class','btn btn-outline-primary optbtn')
            var quesNo = questionCounter;
            questions[questionCounter]['userOpt'] = user_ans; 
            if(check==user_ans)
            { 
                 correct_answer++;
                 quesNo++;
                 $("#quesNO"+quesNo).css('backgroundColor','green').attr("disabled",true);
                 
                 
                $(this).attr('class', 'btn btn-success optbtn');
            }
            else if(check!=user_ans)
            {
                wrong_answer++;
                quesNo++;
                $("#quesNO"+quesNo).css('backgroundColor','red').attr("disabled",true);
                

                $(this).attr('class','btn btn-danger optbtn');
            }
            $(".optbtn").prop('disabled',true); 
        })

    });

function check_ans(question)
{
    
    return question['correct_opt'];
}
function show(question)
{
    $("button[class*= optbtn]").attr('class','btn btn-outline-primary optbtn')
    $("button[class*= optbtn]").attr('class','btn btn-outline-primary optbtn' )
    $(".optbtn").prop('disabled',false);
    $("#question").html(question['ques']);
    $("#op1").html(question['opt1']);
    $("#op2").html(question['opt2']);
    $("#op3").html(question['opt3']);
    $("#op4").html(question['opt4']); 
    var quesNo = questionCounter+1;
    $("#timer").html(QUESTION_TIME+"&nbsp;Seconds");

    $("#quesNO"+quesNo).css('backgroundColor','#0066FF');
    if($("#quesNO"+questionCounter).css('backgroundColor') =='#0066FF')
    {
      $("#quesNO"+questionCounter).css('backgroundColor','#FFCC33');
    }
    

    $("#quesNo").html("Question "+quesNo);
     //console.log(questions.length,questionCounter)   
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
                finishQuiz(); 
            }
            if(questionCounter+1==questions.length)
            {
              $("#time").hide();
              $("#questions").hide();
            }
            show(questions[questionCounter]);
        }
        questionTimer--;
        $("#timer").html(`<span><b>${questionTimer}&nbsp;Seconds</b></span>`)
    }, 1000);    
}

function resetTimer()
{
    questionTimer = QUESTION_TIME;
}


function finishQuiz(mode)
{
  if(mode)
  {
    if(confirm("Are You Sure You want to Submit Quiz?"))
    {
      $('#quizMainSection').hide();
      $('#Result').show();
      displayResults();
    }
  }else
  {
    $('#quizMainSection').hide();
    $('#Result').show();
    displayResults(); 
  }
 
 
}

function displayResults()
{
   
  var inhtml;
  var i=1;
  var correct_a,correct_b,correct_c,correct_d;
  $("#score").html("Score : "+correct_answer)
  $.each(questions, function(key,value){
    correct_a = "btn btn-outline-primary ";
    correct_b = "btn btn-outline-primary ";
    correct_c = "btn btn-outline-primary ";
    correct_d = "btn btn-outline-primary ";  
    
    if(value.correct_opt=="A")
    {
      correct_a = "btn btn-success  ";
    }
    if(value.correct_opt=="B")
    {
        correct_b = "btn btn-success  ";
    }
    if(value.correct_opt=="C")
    {
        correct_c = "btn btn-success  ";
    }
    if(value.correct_opt=="D")
    {
        correct_d = "btn btn-success ";
    }
    if(value.userOpt && value.userOpt!=value.correct_opt)
    {
      if(value.userOpt=="A")
      {
        correct_a = "btn btn-danger ";
      }
      if(value.userOpt=="B")
      {
          correct_b = "btn btn-danger ";
      }
      if(value.userOpt=="C")
      {
          correct_c = "btn btn-danger ";
      }
      if(value.userOpt=="D")
      {
          correct_d = "btn btn-danger ";
      }
    }
    inhtml = `<div style="margin: 30px;">     
                    <p>${i} ${value.ques}</p> 
                    <label for="A">a) </label>
                    <button type="button"  class="${correct_a}" style="border:none"  name="op" value="A" >
                    ${value.opt1}
                    </button>
                    <br><br>
                    <label for="A">b)</label>
                    <button type="button"  class="${correct_b}" style="border:none"  name="op" value="B">
                    ${value.opt2}
                    </button>
                    <br><br>
                    <label for="A">c)</label>
                    <button type="button"  class="${correct_c}" style="border:none" name="op" value="C">
                    ${value.opt3}
                    </button>
                    <br><br>
                    <label for="A">d)</label>
                    <button type="button"   class="${correct_d}" style="border:none" name="op" value="D">
                    ${value.opt4}
                    </button>
                    <br><br> 
                  </div>`;

                  $('#resultBody').append(inhtml);
                  i++;


                
  })
}
 
</script>
</html>
