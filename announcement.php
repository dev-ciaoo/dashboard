<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- <link rel="stylesheet" type="text/css" href="css/style.css"> -->
</head>
<body oncontextmenu="return false;">
    <title>Announcement</title>
<style> 
@media only screen and (max-width: 600px) {
  /* .leave-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
  }
  .request-form {
    zoom: 67%;
  }
  .pending-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
  }
  .loans-form {
    zoom: 67%;
  } */
}

@media only screen and (min-width: 767.98px) and (orientation: landscape){
  /* .leave-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
    font-size: 13px;
    zoom: 50%;
  }
  input {
    width: 50%;
    /* height: auto!important; */
  /* }
  .request-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
    font-size: 13px;
    zoom: 50%;
  }
  .pending-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
    font-size: 13px;
    zoom: 50%;
  }
  .loans-form {
    zoom: 67%;
  }
  label, span {
    font-size: 10.5px;
  }
  h3 {
    font-size: 14px;
  }
  #iCategory {
    font-size: 11.8px;
  }
  #timeTo {
    font-size: 11.8px;
  } 
} */
}
@media only screen and (max-width: 767.98px) and (orientation: portrait) {
  @-ms-viewport { }
  /* body{
    background-color: red;
  } */
  /* .leave-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
    font-size: 13px;
    zoom: 50%;
  }
  input {
    width: 30px;
    height: auto!important;
  }
  .request-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
    font-size: 13px;
    zoom: 50%;
  }
  .pending-form {
    max-width: 100%;
    width: auto!important;
    height: auto!important;
    font-size: 13px;
    zoom: 50%;
  }
  .loans-form {
    zoom: 67%;
  }
  label, span {
    font-size: 10.5px;
  }
  h3 {
    font-size: 14px;
  }
  #iCategory {
    font-size: 11.8px;
  }
  #timeTo {
    font-size: 11.8px;
  } */
}


/* 175% */
@media screen and (min-width: 952.571px){
  @-ms-viewport { }
  .container{
    zoom: 81%;
  }
  img { 
    zoom: 81%;
  }
}

  /* 150% */
@media screen and (min-width: 1116.670px){
  @-ms-viewport { }
  .container{
    zoom: 91%;
  }
  img { 
    zoom: 91%;
  }

}

    /* 125% */
@media screen and (min-width: 1346.400px){
  @-ms-viewport { }
  .container{
    zoom: 91%;
  }
  img { 
    zoom: 91%;
  }
}

  /* 110 */
@media screen and (min-width: 1534px) {
  @-ms-viewport { }
  .container{
    zoom: 100%;
  }
  img { 
    zoom: 100%
  }
}

  /* 1980x1080 100%*/
 @media screen and (min-width: 1691px) {
  @-ms-viewport { }
  .container{
    zoom: 100%;
  }
  img { 
    zoom: 100%;
  }
}
* {box-sizing: border-box}

  body {
    background-color: #808080;
    font-family: Verdana, sans-serif; 
    margin-top: 1.7%;
    margin-left: 0%!important;
    margin-right: 0%!important;
    margin-bottom: 0%!important;
    /* display: inline-block; */
    /* background-position: center; */
  }

.carousel-inner > .item > img {
  display: block;
  /* max-width: 100%; */
  width: auto!important;
  height: 767px!important;
  margin-left: auto;
  margin-right: auto;
}

/* Slideshow container */
.container {
  width: 100%!important;
  height: 900px!important;
  position: relative;
  margin: 0;
  display: block;
  margin-left: auto;
  margin-right: auto;
}

/* Next & previous buttons */
.prev, .next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto!important;
  padding: 16px;
  margin-top: -22px;
  color: white;
  font-weight: bold;
  font-size: 18px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

.prev {
  left: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover, .next:hover {
  background-color: rgba(0,0,0,0.8);
}

/* Caption text */
.text {
  color: #f2f2f2;
  font-size: 15px;
  padding: 8px 12px;
  position: absolute;
  bottom: 8px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

@keyframes fade {
  from {opacity: .4} 
  to {opacity: 1}
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .prev, .next,.text {font-size: 11px}
}
</style>
</head>

<div class="container">
  <!-- <h2>Carousel Example</h2> -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0"  class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
      <!-- <li data-target="#myCarousel" data-slide-to="4"></li> -->
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="./image/DLSUMC.png" alt="hiring" >
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="./image/empLoan1.jpg" alt="Employee Loan">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="./image/empLoan2.jpg" alt="Employee Loan">
        <div class="carousel-caption">
        </div>
      </div>

      <!-- <div class="item">
        <img src="./image/hrmemo.jpg" alt="HR Memo">
        <div class="carousel-caption">
        </div>
      </div> -->

      <div class="item">
        <img src="./image/heroes.jpg" alt="Majoy" >
        <div class="carousel-caption">
          <!-- <h3>Los Angeles</h3>
          <p>LA is always so much fun!</p> -->
        </div>
      </div>

      <!-- <div class="item">
        <img src="./image/heatCare.png" alt="hiring" >
        <div class="carousel-caption">
        </div>
      </div> -->

    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

<script type='text/javascript'>
let slideIndex = 1;
var activeTimer;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function plusSlides(n) {
  n = n || 1
  showSlides(slideIndex += n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("item");
  let dots = document.getElementsById("myCarousel");
  if (n > slides.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = slides.length}
  if (activeTimer) window.clearTimeout(activeTimer)
    // ...
    
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  activeTimer = window.setTimeout(plusSlides, 5000);
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
}
</script>

</body>
</html> 
