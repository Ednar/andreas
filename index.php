<?php
/**
 * Created by PhpStorm.
 * User: Robert
 * Date: 2015-02-04
 * Time: 08:19
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <link href='http://fonts.googleapis.com/css?family=Lato:100,300,400,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/superslides.css">

    <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    <script src="js/vendor/jquery-1.10.2.min.js"></script>
    <script src="js/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>

</head>
<body>
<!--[if lt IE 8]>
<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->

<!-- Our content -->
<header id="topHeader">
    <div id="menu-logo" >
        <img src="img/logo_kropp.png" alt="AK"/>
        <h1>
            <small>
                <span class="thin">Photographer</span>
                <span class="mobile-break"><br></span>
            </small>
            <span class="bold">Andreas Karlsson</span>
        </h1>
    </div>
        <nav id="nav-main">
            <ul>
                <li><a href=""><i class="fa fa-home fa-fw"></i>Home</a></li>
                <li><a href=""><i class="fa fa-picture-o fa-fw"></i>Buy prints</a></li>
                <li><a href=""><i class="fa fa-user fa-fw"></i>About</a></li>
                <li><a href=""><i class="fa fa-external-link fa-fw"></i>Portfolio</a></li>
                <li><a href=""><i class="fa fa-comments fa-fw"></i>Contact</a></li>
                <li class="mobile-only"><a href=""><i class="fa fa-shopping-cart fa-fw"></i>View Cart</a></li>
                <li class="mobile-only"><a href=""><i class="fa fa-angle-double-right fa-fw"></i>Checkout</a></li>
            </ul>
        </nav>

        <div id="nav-trigger">
            <a id="nav-toggle" class="nav-toggle-a" href="#"><div><span></span></div></a>
        </div>

        <nav id="nav-mobile"></nav>
    <div id="logo-wrapper" class ="mobile-only">
        <div id ="logo" >
            <img src="img/logo_kropp.png" alt="AK"/>
            <h1>
                <small>
                    <span class="thin">Photographer</span>
                    <span class="mobile-break"><br></span>
                </small>
                <span class="bold">Andreas Karlsson</span>
            </h1>
        </div>
    </div>
    </div>
    <aside class="right-tray">
        <nav>
            <img src="img/cart_small.png" alt="shopping cart">
        </nav>
    </aside>
</header>
<div class="intro-text"><h2>
        <span class="thin row-1">Fantastic</span><br>
        <span class="bold row-2">Landscape</span>
        <span class="italic thin row-2">&amp; </span>
        <span class="light row-2">Street</span><br>
        <span class="light row-3">Photography</span>
    </h2>
    <div class="btn">
        Buy prints
    </div>
</div>

<div class="watermark">
    <img class="footer-logo" src="img/digimarc.png" alt="Digimarc logo">
    <p>
        Images Digitally Watermarked by Digimarc | Images on the website have been digitally
        watermarked with ownership and usage information. Digimarc and the Digimarc logo
        are registered trademarks of Digimarc Corporation. The "Digimarc-Enabled" Web Button
        is a trademark of Digimarc Corporation, used with permission.
    </p>

</div>

    <div class="slides-wrapper">
        <div id ="slides">
            <div class ="slides-container">
                <img src="img/newyork.jpg">
                <img src="img/graffiti.jpg">
                <img src="img/roads.jpg">

            </div>
            <nav class="slides-navigation">
                <a href="#" class="next"><img src="img/arrow_right.png"></a>
                <a href="#" class="prev"><img src="img/arrow_left.png"></a>
            </nav>
        </div>
        <script>
            $(function() {
                $('#slides').superslides({
                    hashchange: true,
                    animation:'fade',
                    animation_speed: 'slow',
                    inherit_height_from: '.slides-wrapper'
                });
            });
        </script>

    </div>



    <script> //för att skjuta in och ut nav-meny på mobil
    $(document).ready(function () {
        $("#nav-mobile").html($("#nav-main").html());
        $("#nav-toggle").click(function () {
            if ($("nav#nav-mobile ul").hasClass("expanded")) {
                $("nav#nav-mobile ul.expanded").removeClass("expanded").slideUp(250);
                //$(this).removeClass("open");
            } else {
                $("nav#nav-mobile ul").addClass("expanded").slideDown(250);
                //$(this).addClass("open");
            }
        });
    });
</script>
<script> // för att animera hamburgaren vid klick/pet

    $(function() {
        $("#nav-toggle").click(function() {
            $("#nav-toggle").toggleClass("active")
        });
    });

</script>

<p>This is teh content</p>
<p>This is teh content</p>
<p>This is teh content</p><p>This is teh content</p>
<p>This is teh content</p><p>This is teh content</p>
<p>This is teh content</p>

<p>This is teh content</p>



</body>

</html>