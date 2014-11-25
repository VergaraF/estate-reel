<html>
    <head>
        <title>Estate R&eacuteel</title>
        <link rel="stylesheet" type="text/css" href="CSS/mainLayout.css">
     
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
    <button type="button" onClick="window.location.href='index.php?sortBy=low'">Lowest To Highest</button>
    <button type="button" onClick="window.location.href='index.php?sortBy=high'">Highest To Lowest</button>
    <button type="button" onClick="window.location.href='index.php?sortBy=Sale'">For sales only</button>
    <button type="button" onClick="window.location.href='index.php?sortBy=Rent'">For rent only</button>
    </form>
       <script type="text/javascript" src="JS/jquery-1.9.1.min.js"></script>
    <!-- use jssor.slider.mini.js (40KB) or jssor.sliderc.mini.js (32KB, with caption, no slideshow) or jssor.sliders.mini.js (28KB, no caption, no slideshow) instead for release -->
    <!-- jssor.slider.mini.js = jssor.sliderc.mini.js = jssor.sliders.mini.js = (jssor.js + jssor.slider.js) -->
    <script type="text/javascript" src="JS/jssor.js"></script>
    <script type="text/javascript" src="JS/jssor.slider.js"></script>
    <script>
    
        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
                $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
                $AutoPlayInterval: 2400,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
                $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, 4 freeze for desktop, 8 freeze for touch device, 12 freeze for desktop and touch device, default value is 1

                $ArrowKeyNavigation: true,                          //[Optional] Allows keyboard (arrow key) navigation or not, default value is false
                $SlideDuration: 500,                                //[Optional] Specifies default duration (swipe) for slide in milliseconds, default value is 500
                $MinDragOffsetToSlide: 20,                          //[Optional] Minimum drag offset to trigger slide , default value is 20
                $SlideWidth: 700,                                 //[Optional] Width of every slide in pixels, default value is width of 'slides' container
                $SlideHeight: 300,                                //[Optional] Height of every slide in pixels, default value is height of 'slides' container
                $SlideSpacing: 0,                                   //[Optional] Space between each slide in pixels, default value is 0
                $DisplayPieces: 1,                                  //[Optional] Number of pieces to display (the slideshow would be disabled if the value is set to greater than 1), the default value is 1
                $ParkingPosition: 0,                                //[Optional] The offset position to park slide (this options applys only when slideshow disabled), default value is 0.
                $UISearchMode: 1,                                   //[Optional] The way (0 parellel, 1 recursive, default value is 1) to search UI components (slides container, loading screen, navigator container, arrow navigator container, thumbnail navigator container etc).
                $PlayOrientation: 1,                                //[Optional] Orientation to play slide (for auto play, navigation), 1 horizental, 2 vertical, 5 horizental reverse, 6 vertical reverse, default value is 1
                $DragOrientation: 3,                                //[Optional] Orientation to drag slide, 0 no drag, 1 horizental, 2 vertical, 3 either, default value is 1 (Note that the $DragOrientation should be the same as $PlayOrientation when $DisplayPieces is greater than 1, or parking position is not 0)

                $BulletNavigatorOptions: {                                //[Optional] Options to specify and enable navigator or not
                    $Class: $JssorBulletNavigator$,                       //[Required] Class to create navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 1,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $AutoCenter: 2,                                 //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                    $Lanes: 1,                                      //[Optional] Specify lanes to arrange items, default value is 1
                    $SpacingX: 10,                                  //[Optional] Horizontal space between each item in pixel, default value is 0
                    $SpacingY: 10,                                  //[Optional] Vertical space between each item in pixel, default value is 0
                    $Orientation: 2                                 //[Optional] The orientation of the navigator, 1 horizontal, 2 vertical, default value is 1
                },

                $ArrowNavigatorOptions: {
                    $Class: $JssorArrowNavigator$,              //[Requried] Class to create arrow navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $AutoCenter: 0                                  //[Optional] Auto center navigator in parent container, 0 None, 1 Horizontal, 2 Vertical, 3 Both, default value is 0
                },

                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,              //[Required] Class to create thumbnail navigator instance
                    $ChanceToShow: 2,                               //[Required] 0 Never, 1 Mouse Over, 2 Always
                    $ActionMode: 0,                                 //[Optional] 0 None, 1 act by click, 2 act by mouse hover, 3 both, default value is 1
                    $DisableDrag: true,                             //[Optional] Disable drag or not, default value is false
                    $Orientation: 2                                 //[Optional] Orientation to arrange thumbnails, 1 horizental, 2 vertical, default value is 1
                }
            };

            // var jssor_slider2 = new $JssorSlider$("slider2_container", options);
            // //responsive code begin
            // //you can remove responsive code if you don't want the slider scales while window resizes
            // function ScaleSlider() {
            //     var parentWidth = jssor_slider2.$Elmt.parentNode.clientWidth;
            //     if (parentWidth)
            //         jssor_slider2.$ScaleWidth(Math.min(parentWidth, 800));
            //     else
            //         window.setTimeout(ScaleSlider, 30);
            // }

            // ScaleSlider();
            var jssor_slider2 = new $JssorSlider$("slider2_container", options);

//responsive code begin
//you can remove responsive code if you don't want the slider scales while window resizes
function ScaleSlider() {
    var width = document.getElementById('content').offsetWidth;
    console.log("TEST : " + width);
    if (width)
        jssor_slider2.$SetScaleWidth(width);
    else
        $JssorUtils$.$Delay(ScaleSlider, 30);
}

ScaleSlider();
$JssorUtils$.$AddEvent(window, "load", ScaleSlider);

            if (!navigator.userAgent.match(/(iPhone|iPod|iPad|BlackBerry|IEMobile)/)) {
                $(window).bind('resize', ScaleSlider);
            }


            //if (navigator.userAgent.match(/(iPhone|iPod|iPad)/)) {
            //    $(window).bind("orientationchange", ScaleSlider);
            //}
            //responsive code end
        });
    </script>
    <!-- Jssor Slider Begin -->
    <!-- You can move inline styles to css file or css block. -->
    <div id="slider2_container" style="position: relative; width: 100%;
        height: 300px; overflow: hidden;">

        <!-- Loading Screen -->
         <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                background-color: #000; top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
            <div style="position: absolute; display: block; background: url(img/loading.gif) no-repeat center center;
                top: 0px; left: 0px;width: 100%;height:100%;">
            </div>
        </div> 
       <!-- Slides Container -->
        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 1px; right: 0px; width: 100%; height: 300px;
            overflow: hidden;">
            <div>
                <img u=image src="img/landscape/01.jpg" />
                       </div>
            <div>
                <img u=image src="img/landscape/02.jpg" />
               </div>
            <div>
                <img u=image src="img/landscape/03.jpg" />
                </div>
            <div>
                <img u=image src="img/landscape/04.jpg" />
                </div>
            <div>
                <img u=image src="img/landscape/01.jpg" />
                </div>
            <div>
                <img u=image src="img/landscape/02.jpg" />
                </div>
            <div>
                <img u=image src="img/landscape/03.jpg" />
                </div>
            <div>
                <img u=image src="img/landscape/04.jpg" />
                </div>
               
           
        </div>

        <!-- Bullet Navigator Skin Begin -->
        <!-- jssor slider bullet navigator skin 01 -->
        <style>
            /*
            .jssorb01 div           (normal)
            .jssorb01 div:hover     (normal mouseover)
            .jssorb01 .av           (active)
            .jssorb01 .av:hover     (active mouseover)
            .jssorb01 .dn           (mousedown)
            */
            .jssorb01 div, .jssorb01 div:hover, .jssorb01 .av
            {
                filter: alpha(opacity=70);
                opacity: .7;
                overflow:hidden;
                cursor: pointer;
                border: #000 1px solid;
            }
            .jssorb01 div { background-color: gray; }
            .jssorb01 div:hover, .jssorb01 .av:hover { background-color: #d3d3d3; }
            .jssorb01 .av { background-color: #fff; }
            .jssorb01 .dn, .jssorb01 .dn:hover { background-color: #555555; }
        </style>
        <!-- bullet navigator container -->
        <div u="navigator" class="jssorb01" style="position: absolute; bottom: 50px; right: 10px;">
            <!-- bullet navigator item prototype -->
            <div u="prototype" style="POSITION: absolute; WIDTH: 12px; HEIGHT: 12px;"></div>
        </div>
        <!-- Bullet Navigator Skin End -->
        
        <!-- Arrow Navigator Skin Begin -->
        <style>
            /* jssor slider arrow navigator skin 05 css */
            /*
            .jssora05l              (normal)
            .jssora05r              (normal)
            .jssora05l:hover        (normal mouseover)
            .jssora05r:hover        (normal mouseover)
            .jssora05ldn            (mousedown)
            .jssora05rdn            (mousedown)
            */
            .jssora05l, .jssora05r, .jssora05ldn, .jssora05rdn
            {
                position: absolute;
                cursor: pointer;
                display: block;
                background: url(img/a17.png) no-repeat;
                overflow:hidden;
            }
            .jssora05l { background-position: -10px -40px; }
            .jssora05r { background-position: -70px -40px; }
            .jssora05l:hover { background-position: -130px -40px; }
            .jssora05r:hover { background-position: -190px -40px; }
            .jssora05ldn { background-position: -250px -40px; }
            .jssora05rdn { background-position: -310px -40px; }
        </style>
        <!-- Arrow Left -->
        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; bottom: 10px; left: 330px;">
        </span>
        <!-- Arrow Right -->
        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; bottom: 10px; right: 330px">
        </span>
        <!-- Arrow Navigator Skin End -->
        <a style="display: none" href="http://www.jssor.com">image carousel</a>
        <!-- Trigger -->
    </div>
    <!-- Jssor Slider End -->

    <section id="apartments">
    <?php
        $rsForIndex = null;
        if (isset($_GET['sortBy'])) {
            $value = $_GET['sortBy'];
            $rsForIndex = $productObj->checkSortBy($value);
        }else{
            $rsForIndex = $productObj->displayAllProducts();
        }
        
        if (count($rsForIndex) > 0) {
            for($row = 0; $row < count($rsForIndex); $row++){
                echo "
                <table id='apt' align='center'>
                  <tr id='col1'>
                    <td rowspan='3'><img id='placeImg' src='apartment_images/" . $rsForIndex[$row]['file_name'] . "'/></td>
                    <td rowspan='3' id='col2'>" . $rsForIndex[$row]['description'] . "</th>
                    <th></th>
                  </tr>
                  <tr>
                    <td></td>
                  </tr>
                  <tr id='price'>
                    <td><p id='number'>" . $rsForIndex[$row]['price'] . "$</p></td>
                  </tr>
                </table>";
            }
        }
    ?>
    </section>
   
    </section>
    </body>
</html>
<?php   } ?>