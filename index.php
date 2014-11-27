<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
        <link rel="stylesheet" type="text/css" href="CSS/carouselLayout.css">
     
    </head>
    <?php include('PreCode/header.php'); 
    if(count($bannedUser) == 1){
        $days = $loginObj->dateDiff($bannedUser[0]['to_'], $bannedUser[0]['from_']);
        echo "<p>You are not allowed to be here anymore. You may login after " . $bannedUser[0]['to_'] . ". Your account has been banned for $days days because of the following description: </p>";
        echo $bannedUser[0]['description'];
    ?>
            </section>
    </body>
</html>
<?php
    }else{
    ?>

    <form name="filters" method="GET" action="">
    <label>Sort by : </label>
    <button type="button" onClick="window.location.href='index.php?sortBy=low'">Price: Ascendant</button>
    <button type="button" onClick="window.location.href='index.php?sortBy=high'">Price: Descendant</button>
    <button type="button" onClick="window.location.href='index.php?sortBy=Sale'">For sale only</button>
    <button type="button" onClick="window.location.href='index.php?sortBy=Rent'">For rent only</button>
    </form>
 <!--   //SLIDER HERE -->
<div id='carousel_container'>  
  <div id='left_scroll'><a href='javascript:slide("left");'><img id="arrowLeft"src='apartment_images/left.png' /></a></div>  
    <div id='carousel_inner'>  
        <ul id='carousel_ul'>  
            <li><img src='apartment_images/1.jpg' /></li>  
            <li><img src='apartment_images/2.jpg' /></li>  
            <li><img src='apartment_images/3.jpg' /></li>  
            <li><img src='apartment_images/4.jpg' /></li>  
            <li><img src='apartment_images/5.jpg' /></li>  
  
        </ul>  
    </div>  
  <div id='right_scroll'><a href='javascript:slide("right");'><img id="arrowRight"src='apartment_images/right.png' /></a></div>  
  <input type='hidden' id='hidden_auto_slide_seconds' value=0 />  
</div> 


<script>
 $(document).ready(function() {  
  
        //options( 1 - ON , 0 - OFF)  
        var auto_slide = 1;  
        var hover_pause = 1;  
        var key_slide = 1;  
  
        //speed of auto slide(  
        var auto_slide_seconds = 5000;  
        /* IMPORTANT: i know the variable is called ...seconds but it's 
        in milliseconds ( multiplied with 1000) '*/  
  
        /*move the last list item before the first item. The purpose of this is 
        if the user clicks to slide left he will be able to see the last item.*/  
        $('#carousel_ul li:first').before($('#carousel_ul li:last'));  
  
        //check if auto sliding is enabled  
        if(auto_slide == 1){  
            /*set the interval (loop) to call function slide with option 'right' 
            and set the interval time to the variable we declared previously */  
            var timer = setInterval('slide("right")', auto_slide_seconds);  
  
            /*and change the value of our hidden field that hold info about 
            the interval, setting it to the number of milliseconds we declared previously*/  
            $('#hidden_auto_slide_seconds').val(auto_slide_seconds);  
        }  
  
        //check if hover pause is enabled  
        if(hover_pause == 1){  
            //when hovered over the list  
            $('#carousel_ul').hover(function(){  
                //stop the interval  
                clearInterval(timer)  
            },function(){  
                //and when mouseout start it again  
                timer = setInterval('slide("right")', auto_slide_seconds);  
            });  
  
        }  
  
        //check if key sliding is enabled  
        if(key_slide == 1){  
  
            //binding keypress function  
            $(document).bind('keypress', function(e) {  
                //keyCode for left arrow is 37 and for right it's 39 '  
                if(e.keyCode==37){  
                        //initialize the slide to left function  
                        slide('left');  
                }else if(e.keyCode==39){  
                        //initialize the slide to right function  
                        slide('right');  
                }  
            });  
  
        }  
  
  });  
  
//FUNCTIONS BELLOW  
  
//slide function  
function slide(where){  
  
            //get the item width  
            var item_width = $('#carousel_ul li').outerWidth() + 10;  
  
            /* using a if statement and the where variable check 
            we will check where the user wants to slide (left or right)*/  
            if(where == 'left'){  
                //...calculating the new left indent of the unordered list (ul) for left sliding  
                var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;  
            }else{  
                //...calculating the new left indent of the unordered list (ul) for right sliding  
                var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;  
  
            }  
  
            //make the sliding effect using jQuery's animate function... '  
            $('#carousel_ul:not(:animated)').animate({'left' : left_indent},500,function(){  
  
                /* when the animation finishes use the if statement again, and make an ilussion 
                of infinity by changing place of last or first item*/  
                if(where == 'left'){  
                    //...and if it slided to left we put the last item before the first item  
                    $('#carousel_ul li:first').before($('#carousel_ul li:last'));  
                }else{  
                    //...and if it slided to right we put the first item after the last item  
                    $('#carousel_ul li:last').after($('#carousel_ul li:first'));  
                }  
  
                //...and then just get back the default left indent  
                $('#carousel_ul').css({'left' : '-210px'});  
            });  
  
}   </script>

<!-- 
ul/li structure can be replaced by any other html structure as div/div, div/span... 
-->

<!--   //SLIDER FINISHES HERE -->
    <section id="apartments">
    <?php
        $rsForIndex = null;
        if (isset($_GET['sortBy'])) {
            $value = $_GET['sortBy'];
            $rsForIndex = $productObj->checkSortBy($value);
        }else{
            $rsForIndex = $productObj->displayAllProducts();
        }

        if (isset($_POST['apartment_id'])) {
            echo $_POST['apartment_id'];
        }
        
        if (count($rsForIndex) > 0) {
            for($row = 0; $row < count($rsForIndex); $row++){
    ?>
                <table id="apt" align="center" onclick="window.location.href='showDetails.php?hiddenID= <?php echo $rsForIndex[$row]['dwelling_Id']; ?> '">
                    <tbody>
                        <tr id="col1">
                            <td rowspan="3"><img id="placeImg" src="apartment_images/<?php echo $rsForIndex[$row]['file_name']; ?> "/></td>
                            <input name="hiddenID" type="hidden" value=" <?php echo $rsForIndex[$row]['dwelling_Id']; ?> ">
                            <td rowspan="3" id="col2"> 
                                <?php 
                                    if (strlen($rsForIndex[$row]['description']) > 500) {
                                        $str = substr($rsForIndex[$row]['description'], 0, 500) . "...";
                                        echo $str;
                                    }else{
                                        echo $rsForIndex[$row]['description'];
                                    }
                                ?> 
                            </th>
                            <th></th>
                          </tr>
                          <tr>
                            <td></td>
                          </tr>
                          <tr id="price">
                            <td><p id="number"> <?php echo $rsForIndex[$row]['price']; ?> </p></td>
                          </tr>
                    </tbody>
                </table>
    <?php
            }
        }
    ?>
    </section>
   
    </section>
    </body>
</html>
<?php   } ?>