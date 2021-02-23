      $('.subtotal').show();
      
        function load_product(token,page,sort_by)
        {
            $("#loader-wrapper").show();
            $.post("ajax_product.php",
            {
                title: token,
                page: page,
                sort_by: sort_by,
            },
            function(data,status)
            {
                //console.log(data);
                document.getElementById("result").innerHTML=data;
                $("#loader-wrapper").fadeOut("slow");
                $("#"+page).addClass("active");
                $("#sorting").val(sort_by);
            });
        }
        
        
        function search_products(token,page,sort_by)
        {
            $("#loader-wrapper").show();
            $.post("ajax_search.php",
             {
                title: token,
                page: page,
                 sort_by: sort_by,
            },
            function(data,status)
            {
                document.getElementById("result").innerHTML=data;
                $("#loader-wrapper").fadeOut("slow");
                $("#"+page).addClass("active");
                 $("#sorting").val(sort_by);
            });
        }
        
        function cart(str)
         {
             $("#loader-wrapper").show();
             var ab="quantity"+str;
            $.post("ajax_cart.php",{
            product_code:str,
            quantity:document.getElementById(ab).value,
            uid:uid,
            },
            function(data,status){
                 // console.log(data);
                 var obj=JSON.parse(data);
                document.getElementById('count').innerHTML=obj['items'];
                document.getElementById('subtotalc').innerHTML=obj['price'];
                document.getElementById('subtotall').innerHTML=obj['price'];
                document.getElementById('cart_result').innerHTML=obj['cart'];
                $("#cart-btn").show();
                  $("#loader-wrapper").fadeOut("slow");
                
            });
         }
         
       


        function auto_cart()
         {
             
            $.post("ajax_cart.php",{
            cart_check:"abc",
            },
            function(data,status){
              console.log(data);
               var obj=JSON.parse(data);
                document.getElementById('count').innerHTML=obj['items'];
              	document.getElementById('subtotalc').innerHTML=obj['price'];
              	document.getElementById('subtotall').innerHTML=obj['price'];
                document.getElementById('cart_result').innerHTML=obj['cart'];
                if(obj['items']==0)
                {
                   $("#cart-btn").hide();
                }
                
                
            });
         }
         
        auto_cart();
 

        function remove(str)
        {
            $("#loader-wrapper").show();
            $.get("ajax_cart.php",{
            remove_code:str,
                uid:uid,
            },
           function(data,status){
			//	console.log(data);
                var obj=JSON.parse(data);
                document.getElementById('count').innerHTML=obj['items'];
                document.getElementById('subtotalc').innerHTML=obj['price'];
                document.getElementById('subtotall').innerHTML=obj['price'];
                document.getElementById('cart_result').innerHTML=obj['cart'];
                if(obj['items']==0)
                {
                   $("#cart-btn").hide();
                }
                  $("#loader-wrapper").fadeOut("slow");
            });
        }

        function ab()
        {
           
            var x=document.getElementById("aa").value;
             var atpos = x.indexOf("@");
            var dotpos = x.lastIndexOf(".");
            if(x=="")
                {
                     document.getElementById('email_result').innerHTML="Field is Required.";
                }
            else if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) 
            {
                 document.getElementById('email_result').innerHTML="Not a valid e-mail address";
            }
            else
            {
                 $("#loader-wrapper").show();
                $.post("email_subscribe.php",{
                email:x,
                },
                function(data,status){
                 
                  //  console.log(data);
                    if(data.localeCompare('success'))
                        {
                            document.getElementById('email_result').innerHTML="Successfully Subscribe Your Email.";
                        }
                    else
                        {
                             document.getElementById('email_result').innerHTML="Already Subscribe.";
                        }
                    
                        document.getElementById('aa').value=" ";
                          $("#loader-wrapper").fadeOut("slow");
            });
        }
        }

function clear_cart()
{
    $("#loader-wrapper").show();
    $.post("ajax_cart.php",{
            clear_cart:"abc",
            uid:uid,
            },
            function(data,status){
       // console.log(data);
             if(data=='ok')
                {
                     location.reload();
                 }
                else
                    {
                        
                    }
                      $("#loader-wrapper").fadeOut("slow");
            });   
}

function viewcart_remove(str)
{
    $("#loader-wrapper").show();
    $.get("ajax_cart.php",{
            remove_code:str,
                uid:uid,
            },
           function(data,status){
              location.reload();
                $("#loader-wrapper").fadeOut("slow");

            });
}

   function viewcart(str,id)
         {
             $("#loader-wrapper").show();
            $.post("ajax_cart.php",{
             key:id,
            quantity:str,
                uid:uid,
            },
            function(data,status){
              location.reload();
                $("#loader-wrapper").fadeOut("slow");
                
            });
         }


  		function shipaddress()
        {
            if(next)
            {
            $("#loader-wrapper").show();
            var x = $("input[name='shipaddress']:checked").val();
         
            $.post("ajax_profile.php",{
            address_id:x,
                u_id:uid,
            },
            function(data,status){
              //  console.log(data);
                if(data=='ok')
                    {
                         window.location="order-summery";
                    }
                      $("#loader-wrapper").fadeOut("slow");
            });
            }
        }
       

     //count down function
         function countdown(str)
       {
            var timer2 = str;
            var interval = setInterval(function() {
            var timer = timer2.split(':');
             //by parsing integer, I avoid all extra string processing
            var minutes = parseInt(timer[0], 10);
             var seconds = parseInt(timer[1], 10);
                 --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            //minutes = (minutes < 10) ?  minutes : minutes;
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
            }, 1000);
       }
       
       //function for search products
        function search_product()
        {
            alert("sgs");
              
        }

        // apply coupon code
    
        function coupon_apply()
        {
            $("#loader-wrapper").show();
            var coupon_code=document.getElementById("coupon_code").value;
             $.post("ajax_coupon.php",{
                coupon_code:coupon_code,
            },
            function(data,status){
               //  console.log(data);
             var obj=JSON.parse(data);
                 if(obj.msg=='ok')
                     {
                          var total=parseInt(document.getElementById("total").innerHTML);
                          var discount=obj.discount;
                         total=total-discount;
                         document.getElementById("total").innerHTML=total;
                         $('#discount').show();
                         document.getElementById("discount_price").innerHTML=discount;
                     }
                 else
                 {
                     document.getElementById("code_error").innerHTML=obj.msg;
                 }
                   $("#loader-wrapper").fadeOut("slow");
                 
            });
            
        }


/// live  city

function aacity(str)
{
             $("#loader-wrapper").show();
            $.post("find_city.php",{
            state:str,
            },
            function(data,status){
                  //console.log(data);
                 document.getElementById('account-city').innerHTML=data;
                   $("#loader-wrapper").fadeOut("slow");
                
            });
         
}