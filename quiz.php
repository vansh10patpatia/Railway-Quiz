<?php
   require_once 'header.php';
?>

 

<div id="quiz_section" style="margin: 30px;">
    <div id="timer">
        <span>00:00:10</span>
    </div>
    <p id="question"></p> 
    <button type="button" id="op1" class="btn btn-info optbtn"  name="op" value="A">
    </button>
    <br><br>
    <button type="button" id="op2" class="btn btn-info optbtn"  name="op" value="B">
    </button>
    <br><br>
    <button type="button" id="op3" class="btn btn-info optbtn"  name="op" value="C">
    </button>
    <br><br>
    <button type="button" id="op4"  class="btn btn-info optbtn" name="op" value="D">
    </button>
    <br><br>
    <button type="button" id="nextBtn"  class="btn btn-warning" >NEXT</button>
</div>



















<?php
   require_once 'js-links.php';
   
?>
    
<script>
var questionCounter=0;
var questions = [];
var QUESTION_TIME = 10;
var questionTimer = QUESTION_TIME;
var timeCounterRef;
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
                            $(this).html("Finish");
                            console.log(questions.length,questionCounter)
                        }
                    if(questionCounter >= questions.length-1)
                    {
                        console.log(questions.length,questionCounter)

                        
                        questionCounter=questions.length-1; 
                        $('#quiz_section').hide();
                        $('.result').show(); 
                    }
                    else
                    {
                        resetTimer();
                        show(questions[++questionCounter]);
                    }
                    

        });
        
        $(".optbtn").click(function (e)
        {
            var user_ans=$(this).val();
           var  check=check_ans(questions[questionCounter]); 
            $("button[class*= btn-success]").attr('class','btn btn-info optbtn')
            $("button[class*= btn-danger]").attr('class','btn btn-info optbtn')
            if(check==user_ans)
            {
                 
                $(this).attr('class', 'btn btn-success optbtn');
            }
            else if(check!=user_ans)
            {
                
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
    $("button[class*= btn-success]").attr('class','btn btn-info optbtn')
    $("button[class*= btn-danger]").attr('class','btn btn-info optbtn')
    $(".optbtn").prop('disabled',false);
    $("#question").html(question['ques']);
    $("#op1").html(question['opt1']);
    $("#op2").html(question['opt2']);
    $("#op3").html(question['opt3']);
    $("#op4").html(question['opt4']); 
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
        $("#timer").html(`<span>00:00:0${questionTimer}</span>`)
    }, 1000);    
}

function resetTimer()
{
    questionTimer = QUESTION_TIME;
}




 
</script>