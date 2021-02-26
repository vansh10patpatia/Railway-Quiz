<?php

  require_once "header.php";
  require_once "nav_front.php";
  require_once "rightnavbar.php";
  require_once "sidebar_front.php";
  
  
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
          <div class="col-lg-12">

            

              <!-- Questions Card -->
              <div class="card" id="time"> 
                <div class="card-header" style="background: linear-gradient(to right, #33ccff 0%, #ff99cc 100%);">
                  <div class="d-flex justify-content-between">
                    <h3 class="card-title"><i class="bi bi-clock"></i>&nbsp;<b>Time Left:</b></h3>
                    <div id="timer">
                      
                        <span>00:00:10</span>
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
                      <button type="submit" class="btn btn-outline-success" style="border-radius:8vh">Finish Attempt</button>
                      </div>
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
    
<script>
var questionCounter=0;
var questions = [];
var QUESTION_TIME = 10000;
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
        })

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
                        $('#quiz_section').hide();
                        $('.result').show(); 
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
           
        //     $.ajax({
        //     url:'user_ajax.php',
        //     type:'POST',
        //     data:{
        //         response:user_ans

        //     },
        //     success:function(data)
        //     {
        //             var obj = JSON.parse(data);
        //             if(obj.msg.trim()=="ok")
        //             {
        //                 questions = obj.questions;
        //                 show(questions[questionCounter]);
        //                 start_timer();
        //             }
        //             if(obj.msg.trim()=="error")
        //             {
                        
        //             }
        //     }
        // });
            
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
                $('#quiz_section').hide();
                $('.result').show(); 
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




 
</script>
</html>
