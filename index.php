<?php
include('connection.php');
// require 'pay-updatepayrolltime.php';
require 'auth_check.php';

ini_set('session.gc_maxlifetime', 86400);
ini_set('session.cookie_lifetime', 86400); 

header("X-Frame-Options: SAMEORIGIN");
header("X-XSS-Protection: 1; mode=block");
header("X-Content-Type-Options: nosniff");
// header("Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://trusted-cdn.com;");
header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
header("Referrer-Policy: strict-origin-when-cross-origin");
header("Permissions-Policy: geolocation=(), microphone=(), camera=()");

if (!isset($_SESSION['welcome_alert_triggered'])) {
  // Generate JavaScript code for the welcome alert
  $welcomeMessage = "Welcome, " . $_SESSION['fullname'] . "!";
  echo "<script>alert('$welcomeMessage');</script>";

  // Set the flag to indicate that the welcome alert has been triggered
  $_SESSION['welcome_alert_triggered'] = true;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
  <meta http-equiv="Pragma" content="no-cache">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta name="author" content="devCiao">
  <meta name="description" content="OUR Bank">
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <title>OUR Bank Dashboard</title>
  <script>
  let baseTitle = "OUR Bank Dashboard";
  let scrollTitle = "";
  let scrollPos = 0;
  let enableScroll = false;

  function scrollWindowTitle() {
      if (enableScroll && scrollTitle) {
          document.title = scrollTitle.substring(scrollPos) + scrollTitle.substring(0, scrollPos);
          scrollPos = (scrollPos + 1) % scrollTitle.length;
      } else {
          document.title = baseTitle;
      }
  }

  // Poll server every 1 second for notification updates
  setInterval(function () {
      fetch('title_message_checker.php')
          .then(response => response.text())
          .then(newTitle => {
              if (newTitle.includes("You have a new message")) {
                  scrollTitle = newTitle + "   ";
                  enableScroll = true;

                  // Show and make clickable
                  const notify = document.getElementById('notify-msg');
                  notify.style.display = 'flex'; // triggers opacity animation
              } else {
                  enableScroll = false;
                  document.title = baseTitle;

                  // Hide it and disable clicking
                  const notify = document.getElementById('notify-msg');
                  notify.style.display = 'none';
              }
          });
  }, 1000);


  // Scroll the title every 200ms for animation
  setInterval(scrollWindowTitle, 200);
  </script>



  <link rel="stylesheet" href="./css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
  <!-- Bootstrap 4.6.2 -->
  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous"> -->

  <!-- For payslip (currently disabled) -->
  <!-- <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css"> -->

  <!-- Custom CSS -->
  <link rel="stylesheet" type="text/css" href="./css/dash.css">
<style>

.chat-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  margin-bottom: 8px;
  max-width: 90%;
}

.chat-message.own-message {
  display: flex;
  justify-content: flex-end;
}

.chat-message.own-message .chat-row {
  flex-direction: row-reverse; /* avatar on right */
  text-align: start;
  justify-content: flex-end;
}

.chat-avatar img.avatar-img {
  width: 25px;
  height: 28px;
  border: 1px solid lightgrey;
  border-radius: 40%;
  background-color: white;
}

.chat-avatar{
  margin-top: 8px;
}

.chat-text {
  margin-top: 8px;
  background-color: #f0f0f0;
  padding: 8px 12px;
  border-radius: 10px;
  max-width: 100%;
  word-wrap: break-word;
  line-height: 1.4;
}

.chat-message.own-message .chat-text {
  background-color:rgb(149, 191, 246); /* light green for own messages */
}


.hide-this {
    position: block;
    display: none;
  }  

  .sidebar-submenu:hover{
    /* font-size: 13px; */
    background-color: white;
    color: black;
  }
  
  .pointer{
    cursor: pointer;
  }
  .chat-container {
      /* display: none; */  
  }
  .chat-message {
    margin: 10px 0;
    font-size: 12.1px;
  }
  .chat-form {
    display: flex;
    align-items: center;
  }
  .chat-input {
    flex: 1;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-right: 10px;
  }

  .chat-ppl {
    flex: 1;
    padding: 7px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .chat-submit {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 4px;
    padding: 8px 16px;
    cursor: pointer;
  }
  .chat-submit:hover {
    background-color: #0056b3;
  }

  #wait {
    /* display: flex; */
    position: fixed;
    justify-content: right;
    float: right;
    align-items: center;
    font-family: Arial, sans-serif;
    /* background-color: #f0f0f0; */
    margin: 0;
    padding: 0; 
    bottom: 1rem;
    visibility: visible;
    right: 40px;
  }
  .header{
    /* background-color: #fff; */
    /* border-radius: 8px; */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 10px;
    width: 450px;
    top: -20px;
    background: rgba(0, 0, 0, 0, 0.2);
    height: 40px!important;
    background-color: black;
    color: #fff;
    border-radius: 5px;
  }

  #header-text { 
    margin-top: -0.55rem;
    position: absolute;
    font-size: 14px;
    cursor: pointer;
  }

  .chat-scrollable-container {
    height: 300px; /* Adjust as needed */
    overflow-y: auto;
  }

  /* #suggestions {
    position: absolute;
    background-color: #f9f9f9;
    max-height: 150px;
    overflow-y: auto;
    width: 43%;
  } */

  #suggestions div {
      cursor: pointer;
  }

  #suggestions div:hover {
      background-color: #ddd;
  }

  .sticky-chat {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 1000; /* Adjust the z-index as needed */
    max-width: 100rem; /* Adjust the max-width as needed */
  }

  .fixed-button {
    position: fixed;
    bottom: 20px;
    right: 30px; 
    z-index: 999;
  }

  .chatbox-cons{
    background-color: #fff;
    /* border-radius: 4px; */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 10px;
    width: 450px;
    top: -20px;
    background: rgba(0, 0, 0, 0, 0.2);
    max-height: 400px;
    overflow-y: auto;
  }

  .highlighted {
    background-color:rgba(143, 206, 245, 0.25); /* You can adjust the highlight color */
    border-radius: 5px;
    height: auto;
  }

  .group-highlighted {
    background-color:rgba(143, 206, 245, 0.25); /* You can adjust the highlight color */
    border-radius: 5px;
    height: auto;
  }
  
  .notify, .notify2{
    cursor: pointer;
  }

  #chat-container2 {
    /* Set dimensions */
    width: 100%;
    height: 300px; /* Adjust height as needed */

    /* Set overflow behavior for scrollbar */
    overflow-y: auto; /* Add vertical scrollbar if content overflows */
    overflow-x: hidden; /* Hide horizontal scrollbar */

    /* Add border and shadow for a container effect */
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

    /* Set background color and font */
    background-color: #f9f9f9;
    font-family: Arial, sans-serif;
    font-size: 14px;
    color: #333; /* Text color */

    padding-left: 5px;
    padding-right: 3px;
}

/* Style chat messages inside the container */
#chat-container2 .message {
    /* Customize message appearance */
    padding: 10px;
    margin: 5px;
    background-color: #fff; /* Message background color */
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Style different types of messages (e.g., sender, receiver) as needed */
#chat-container2 .sender-message {
    /* Style for sender's messages */
    float: left;
}

#chat-container2 .receiver-message {
    /* Style for receiver's messages */
    float: right;
}

#notify-msg {
    transition: opacity 0.5s ease-in-out;
    opacity: 0;
    display: none;         /* start hidden */
    position: fixed;
    right: 10px;
    top: 20px;
    z-index: 9999;         /* ensure it's on top when shown */
    pointer-events: none;  /* prevent interaction when hidden */
}

#notify-msg[style*="display: flex"] {
    opacity: 1;
    pointer-events: auto;  /* clickable when shown */
}



</style>
</head>
<script>
function reloadPage(){
  window.location = '';
}
  
</script>
<body>
  
<!-- <body oncontextmenu="return false;"> -->

  <!-- Bootstrap NavBar -->
  <nav class="navbar navbar-expand-sm navbar-dark bg-dark fixed-top" id="topBar">
    <a class="navbar-brand">
      <span class="menu-collapsed"></span>
    </a>
    <div class="containerr">
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
           <li class="nav-item active">
    <!-- <a class="nav-link"><span class="sr-only"></span></a>
              <a class="nav-link dropdown-toggle" href="https://10.10.10.120/dashboard" id="navbarDropdownMenuLink"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Menu
              </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="http://localhost/dashboard/leaveForm.php">Request Leave Form</a>
              <a class="dropdown-item" href="http://localhost/dashboard/requestITForm.php">IT Request Form</a>
              <a class="dropdown-item" href="http://localhost/dashboard/leaveForm.php">Inventory</a>
              <a class="dropdown-item" href="http://localhost/dashboard/leaveForm.php">Announcement</a>
            </div>
          </li> -->
                
          <!--   <li class="nav-item dropdown d-sm-block d-md-none">
            <a class="nav-link dropdown-toggle" href="https://10.10.10.120/dashboard" id="navbarDropdownMenuLink"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Menu
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="http://localhost/dashboard/leaveForm.php">Leave Form</a>
            </div>
            -->
          </li>

          <!-- Smaller devices menu END -->
          <!-- This is for logout button -->
        </ul>
      </div>
    </div>
  </nav>
  <!-- NavBar END -->

  <!-- Bootstrap row -->
  <div class="x" id="body-row">
    <!-- Sidebar -->
    <div id="sidebar-container" class="sidebar-expanded">
      <!-- d-* hiddens the Sidebar in smaller devices. Its itens can be kept on the Navbar 'Menu' -->
      <!-- Bootstrap List Group -->
      <ul class="list-group">
        <!-- Separator with title -->
        <li class="list-group-item sidebar-separator-title text-muted d-flex align-items-center menu-collapsed bg-dark">
        </li>

        <!-- /END Separator -->
        <!-- DASHBOARD -->
        <a href="index.php" id="indexButton" class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-home fa-fw mr-3"></span>
            <span class="menu-collapsed">&nbsp;Dashboard</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <?php
        if($_SESSION['department'] == 100){ ?>
        <div class="pointer">
          <a class="list-group-item list-group-item-action bg-dark text-white" >
            <span class="fa fa-envelope fa-fw mr-3"></span>
            <span class="menu-collapsed">Webmail</span>
          </a>
          <a class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa fa-university fa-fw mr-3"></span>
            <!-- <i class="fa-solid fa-school"></i> -->
            <span class="menu-collapsed">BADA</span>
          </a>
          <?php
            if($_SESSION['username'] !== 'ctborgonia'){ ?>
              <a class="list-group-item list-group-item-action bg-dark text-white">
                      <span class="fa fa-server fa-fw mr-3"></span>
                      <span class="menu-collapsed">FileServer</span>
                    </a>
            <?php }else { ?>
              <a href="http://QuickConnect.to/ourbank-2025"  class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-server fa-fw mr-3"></span>
                    <span class="menu-collapsed">FileServer</span>
                  </a>
            <?php } ?>
          <a class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa-solid fa-user-group fa-fw mr-3"></span>
            <span class="menu-collapsed">Queueing</span>
          </a>

          <a class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa-solid fa-hand-holding-heart"></span>
            <span class="menu-collapsed">OUR Care Survey System</span>
          </a>

          <a data-toggle="collapse" aria-expanded="true"
            aria-controls="gallery" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa fa-camera-retro fa-fw mr-3"></span>
            <span class="menu-collapsed">Gallery</span>
          </a>
        </div>
        <?php }else{ ?>
        <!-- URL of OUR BANK -->
          <a class="list-group-item list-group-item-action bg-dark text-white" href="https://gw-shu21.unified-servers.com:2096" target="_blank" >
            <span class="fa fa-envelope fa-fw mr-3"></span>
            <span class="menu-collapsed">Webmail</span>
          </a>
          <a href="https://ourbank.bada.com.ph/" target="_blank" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa fa-university fa-fw mr-3"></span>
            <span class="menu-collapsed">BADA</span>
          </a>
          
          <a href="https://www.apds.ourbank.ph/" target="_blank" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa-solid fa-school fa-fw mr-3"></span>
            <span class="menu-collapsed">DepEd</span>
          </a>
          
          <?php
          if($_SESSION['username'] != 'ctborgonia'){
            echo '<a href="http://10.10.10.117:5000" target="_blank" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="fa fa-server fa-fw mr-3"></span>
                    <span class="menu-collapsed">FileServer</span>
                  </a>';
          }else {
            echo '<a href="http://QuickConnect.to/ourbank-2025" target="_blank" class="list-group-item list-group-item-action bg-dark text-white">
                  <span class="fa fa-server fa-fw mr-3"></span>
                  <span class="menu-collapsed">FileServer</span>
                </a>';
          }
          ?>
          <a class="list-group-item list-group-item-action bg-dark text-white" href="http://queue.ourbank.ph/" target="_blank" >
            <span class="fa-solid fa-user-group fa-fw mr-3"></span>
            <span class="menu-collapsed">Queueing</span>
          </a>

          <a class="list-group-item list-group-item-action bg-dark text-white" href="https://docs.google.com/forms/d/e/1FAIpQLSeG8GrIs4BSPMH0MhV97CTCzA-ZG_p1QeiRXSNVRBWvdWL_4Q/viewform" target="_blank" >
            <span class="fa-solid fa-hand-holding-heart"></span>
            <span class="menu-collapsed">&nbsp;OUR Care Survey System</span>
          </a>

          <a href="#submenuGallery" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
              <span class="fa-solid fa-image mr-3"></span>&nbsp;&nbsp;
              <span class="menu-collapsed">Gallery</span>
              <span class="submenu-icon ml-auto"></span>

            </div>
          </a>
          <div id="submenuGallery" class="collapse sidebar-submenu">
            <a href="#submenuPhoto" data-toggle="collapse" aria-expanded="false"
              class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa fa-user fa-fw mr-3"></span>
                <span class="menu-collapsed">Photo</span>
                <span class="submenu-icon ml-auto"></span>
              </div>
            </a>
            <div id="submenuPhoto" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#gallery2025" href="#gallery2025" aria-expanded="true"
                aria-controls="gallery2025" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Christmas Party 2025</span>
              </a>
              <a data-toggle="collapse" data-target="#gallery2024" href="#gallery2024" aria-expanded="true"
                aria-controls="gallery2024" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Christmas Party 2024</span>
              </a>
              <a data-toggle="collapse" data-target="#gallery" href="#gallery" aria-expanded="true"
                aria-controls="gallery" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Christmas Party 2023</span>
              </a>
              <a data-toggle="collapse" data-target="#gallery2" href="#gallery2" aria-expanded="true"
                aria-controls="gallery2" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Loan Evaluation Workshop</span>
              </a>
            </div>
            <a href="#submenuVideo" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
              <span class="fa fa-user fa-fw mr-3"></span>
              <span class="menu-collapsed">Video</span>
              <span class="submenu-icon ml-auto"></span>
            </div>
            </a>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoAccOff" href="#galleryVideoAccOff" aria-expanded="true"
                aria-controls="galleryVideoAccOff" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Accounting Meeting Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoBankWare" href="#galleryVideoBankWare" aria-expanded="true"
                aria-controls="galleryVideoBankWare" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">BankWare Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoBM" href="#galleryVideoBM" aria-expanded="true"
                aria-controls="galleryVideoBM" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">BM & DH Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoCMS" href="#galleryVideoCMS" aria-expanded="true"
                aria-controls="galleryVideoCMS" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Collection Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoEO-Loan" href="#galleryVideoEO-Loan" aria-expanded="true"
                aria-controls="galleryVideoEO-Loan" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Emp. And Officer Loan Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoGenMeet" href="#galleryVideoGenMeet" aria-expanded="true"
                aria-controls="galleryVideoGenMeet" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">General Monthly Meeting</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideo" href="#galleryVideo" aria-expanded="true"
                aria-controls="galleryVideo" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Loan Evaluation Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoFieldG" href="#galleryVideoFieldG" aria-expanded="true"
                aria-controls="galleryVideoFieldG" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">PhilGuarantee Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoPres" href="#galleryVideoPres" aria-expanded="true"
                aria-controls="galleryVideoPres" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">President Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoROPA" href="#galleryVideoROPA" aria-expanded="true"
                aria-controls="galleryVideoROPA" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">ROPOA Workshop</span>
              </a>
            </div>

            <div id="submenuVideo" class="collapse sidebar-submenu">
              <a data-toggle="collapse" data-target="#galleryVideoStratP" href="#galleryVideoStratP" aria-expanded="true"
                aria-controls="galleryVideoStratP" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="fa fa-camera-retro fa-fw mr-3"></span>
                <span class="menu-collapsed">Strategic Plan</span>
              </a>
            </div>
            
          </div>

           <!-- if($_SESSION['position'] == "Head" || $_SESSION['position'] == "BM" || $_SESSION['position'] == "Head" || $_SESSION['position'] == "GM" || $_SESSION['position'] == "AGM"){  -->
          <a data-toggle="collapse" data-target="#calendar" href="#calendar" aria-expanded="true"
            aria-controls="calendar" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa-solid fa-calendar mr-3"></span>&nbsp;
            <span class="menu-collapsed">Calendar</span>
            <span id="calendarNotif" class="notify3"></span>
            <span class="fa-solid fa-bell notify3" id="reqIcon3" style="margin-top: -0.1rem;"></span>
          </a>
          <?php 
          
          if($_SESSION['userid'] == 1 || $_SESSION['userid'] == 2 || $_SESSION['position'] == "GM" || $_SESSION['position'] == "AGM"){  ?>
            <a data-toggle="collapse" data-target="#allCalendar" href="#allCalendar" aria-expanded="true"
              aria-controls="allCalendar" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="fa-solid fa-calendar mr-3"></span>&nbsp;
              <span class="menu-collapsed">All Calendar</span>
              <!-- <span id="calendarNotif" class="notify3" style="margin-top: -0.5rem; border-radius: 5px; color: white;"></span>
              <span class="fa-solid fa-bell notify3" id="reqIcon3" style="margin-top: -0.1rem;"></span> -->
            </a>
          <?php }

          } ?>
        <!-- Menu of HR -->
        <a href="#submenu2" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-user fa-fw mr-3"></span>
            <span class="menu-collapsed">&nbsp;HR Corner</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu for HR -->
        <div id="submenu2" class="collapse sidebar-submenu">
          <!-- Announcement -->
          <a data-toggle="collapse" data-target="#collapseAnnouncement" href="#collapseAnnouncement" aria-expanded="true" 
            aria-control="collapseAnnouncement" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Announcement</span>
          </a>
          <!-- Request -->
          <a data-toggle="collapse" data-target="#collapseELF" href="#collapseELF" aria-expanded="true"
            aria-controls="collapseELF" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Loan Forms</span>
          </a>
          <a data-toggle="collapse" data-target="#collapseDirectory" href="#collapseDirectory" aria-expanded="true" 
            aria-control="collapseDirectory" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">OUR BANK Directory</span>
          </a>
          <a data-toggle="collapse" data-target="#collapseVL" href="#collapseVL" aria-expanded="true"
            aria-controls="collapseVL" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Req. for VL/SL/OT/OB</span>
          </a>
          <a data-toggle="collapse" data-target="#collapsevlStatus" href="#collapsevlStatus" aria-expanded="true"
            aria-controls="collapsevlStatus" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Status of VL/SL/OT/OB</span>
          </a>

            <!-- Online Exam START -->
            <!-- Online Examination Menu -->
            <!-- <a href="#submenuExam" data-toggle="collapse" aria-expanded="false"
              class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa-solid fa-pen-to-square"></span>&nbsp;
                    <span class="menu-collapsed">Online Training Module</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a> -->

            <?php
// Testing Only: Limited access muna sa Online Training Module
if($_SESSION['bankposition'] == 'HR Officer' ||
   $_SESSION['bankposition'] == 'HR Assistant' ||
   $_SESSION['bankposition'] == 'IT Officer' ||
   $_SESSION['bankposition'] == 'Compliance Officer')
{ 
?>
    <a href="#submenuExam" data-toggle="collapse" aria-expanded="false"
       class="list-group-item list-group-item-action flex-column align-items-start">
        <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa-solid fa-pen-to-square"></span>&nbsp;
            <span class="menu-collapsed">Online Training Module</span>
            <span class="submenu-icon ml-auto"></span>
        </div>
    </a>
<?php } ?>

            <!-- Submenu of Online Examination -->
            <div id="submenuExam" class="collapse sidebar-submenu">
                <!-- Visible to All: Take Exam / Reviewer -->
                <a data-toggle="collapse" data-target="#collapseTakeExam" href="#collapseTakeExam" class="list-group-item list-group-item-action bg-dark text-white">
                <span class="menu-collapsed">Reviewer / Exam </span>
            </a>

              <!-- Online Exam END -->

              <?php
              // Admin/HR Access Only: Online Exam Report
              if($_SESSION['bankposition'] == 'HR Officer' ||
                 $_SESSION['bankposition'] == 'HR Assistant' || 
                 $_SESSION['bankposition'] == 'IT Officer' ||
                 $_SESSION['bankposition'] == 'Compliance Officer')
                
                { 
              ?>
                  <a data-toggle="collapse" data-target="#collapseExamReport" href="#collapseExamReport" aria-expanded="true"
                    aria-controls="collapseExamReport" class="list-group-item list-group-item-action bg-dark text-white">
                      <span class="menu-collapsed">Online Training Report</span>
                  </a>
              <?php } ?>
          </div>

          <!-- Menu Memo -->
          <a href="#submenu10" data-toggle="collapse" aria-expanded="false"
              class="list-group-item list-group-item-action flex-column align-items-start">
              <div class="d-flex w-100 justify-content-start align-items-center">
                <span class="fa-solid fa-file-pdf"></span>&nbsp;
                <span class="menu-collapsed">Internal Memo</span>
                <span class="submenu-icon ml-auto"></span>
              </div>
            </a>
          <!-- Submenu of Memo -->
          <div id="submenu10" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseBdayCake" href="#collapseBdayCake" aria-expanded="true"
              aria-controls="collapseBdayCake" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Birthday Cake Benefit for Employee </span>
            </a>
            <a data-toggle="collapse" data-target="#collapseUnuse" href="#collapseUnuse" aria-expanded="true"
              aria-controls="collapseUnuse" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Cash Convertion of Unuse SL/VL</span>
            </a>
            <a data-toggle="collapse" data-target="#collapseDisciplinary" href="#collapseDisciplinary" aria-expanded="true"
              aria-controls="collapseDisciplinary" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Disciplinary Action</span>
            </a>
            <a data-toggle="collapse" data-target="#collapseDisposal" href="#collapseDisposal" aria-expanded="true"
              aria-controls="collapseDisposal" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Disposal of FFE</span>
            </a>
            <a data-toggle="collapse" data-target="#collapseJRPolicy" href="#collapseJRPolicy" aria-expanded="true"
              aria-controls="collapseJRPolicy" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Job Rotation Policy</span>
            </a>
            <a data-toggle="collapse" data-target="#collapseHealthCare" href="#collapseHealthCare" aria-expanded="true"
              aria-controls="collapseHealthCare" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Reimbursement Prog.</span>
            </a>
            <a data-toggle="collapse" data-target="#collapseStrLOA" href="#collapseStrLOA" aria-expanded="true"
              aria-controls="collapseStrLOA" class="list-group-item list-group-item-action bg-dark text-white h-100">
              <span class="menu-collapsed">Strengthening Of Controls Over Health</span>
              <span class="menu-collapsed">Reimbursement And LOA Request</span>

            </a>
           
          </div>

          <?php
            if($_SESSION['department'] == '2' || $_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['bankposition'] == 'IT Officer' || $_SESSION['username'] == 'ctborgonia' || $_SESSION['username'] == 'jatabat'|| $_SESSION['username'] == 'mclerigo' || $_SESSION['username'] == 'jalvarez') { ?>
             <!-- Start of Payroll -->

              <!-- Start of Payroll - FULL ACCESS (HR/Admin) -->
              <a href="#payroll" data-toggle="collapse" aria-expanded="false"
                class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                  <span class="fa-regular fa-calendar-days"></span>
                  <span class="menu-collapsed">&nbsp;Payroll</span>
                  <span class="submenu-icon ml-auto"></span>
                </div>
              </a>
              
              <div id="payroll" class="collapse sidebar-submenu">
                <?php 
                if($_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['username'] == 'mclerigo') {
                  // Accounting Officer - No Import Biometrics
                  echo '';
                } else { 
                ?>
                  <a data-toggle="collapse" data-target="#collapsePayslip" href="#collapsePayslip" aria-expanded="true"
                    aria-controls="collapsePayslip" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Import Biometrics</span>
                  </a>
                <?php } ?>
                
                <a data-toggle="collapse" data-target="#collapseEmpEarnings" href="#collapseEmpEarnings" aria-expanded="true"
                  aria-controls="collapseEmpEarnings" class="list-group-item list-group-item-action bg-dark text-white">
                  <span class="menu-collapsed">Employee Management</span>
                </a>
                
                <a data-toggle="collapse" data-target="#collapseMyPayslip" href="#collapseMyPayslip" aria-expanded="true" 
                  aria-control="collapseMyPayslip" class="list-group-item list-group-item-action bg-dark text-white">     
                  <span class="menu-collapsed">My Payslip</span>
                </a> 

                <?php if (in_array(strtolower($_SESSION['username']), ['cdalegre', 'jcvillanueva', 'jatabat', 'caramos'])) { ?>
                  <a data-toggle="collapse" data-target="#collapseBonus" href="#collapseBonus" aria-expanded="true"
                    aria-controls="collapseBonus" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Bonus Period</span>
                  </a>
                <?php } ?>
              </div>
              <!-- End of Payroll - FULL ACCESS -->
              
            <?php
              } else {
                // Regular Employees - LIMITED ACCESS (Only My Payslip)
            ?>
      <!-- EMPLOYEE PAYROLL UPDATED !!! -->
       <!-- EMPLOYEE PAYROLL UPDATED !!! -->
        <!-- MY PAYSLIP FOR EMPLOYEE NEW !!! -->

         <?php if($_SESSION['address'] == 'Head Office') { ?> <!-- HEAD OFFICE ONLY !!! -->

          <a href="#payrollEmployee" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
              <span class="fa-regular fa-calendar-days"></span>
              <span class="menu-collapsed">&nbsp;Payroll</span>
              <span class="submenu-icon ml-auto"></span>
            </div>
          </a>
          
          <div id="payrollEmployee" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseMyPayslip" href="#collapseMyPayslip" aria-expanded="true" 
              aria-control="collapseMyPayslip" class="list-group-item list-group-item-action bg-dark text-white">     
              <span class="menu-collapsed">My Payslip</span>
            </a> 
          </div>

          <?php } ?>  <!-- HEAD OFFICE ONLY !!! -->

    
    <!-- End of Payroll - LIMITED ACCESS -->
     <!-- MY PAYSLIP FOR EMPLOYEE END !!! -->
              
            <?php
              }
            ?>


          <!-- end of Memo -->
          <?php
            if($_SESSION['department'] == 2 || $_SESSION['bankposition'] == 'Accounting Officer'  || $_SESSION['bankposition'] == 'IT Officer' 
              || $_SESSION['username'] == 'ctborgonia' || $_SESSION['username'] == 'caramos' || $_SESSION['username'] == 'mclerigo'){ ?>
              <a href="#collapseReport" data-toggle="collapse" aria-expanded="false"
                    class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-start align-items-center">
                      <span class="fa-solid fa-table-cells"></span>
                      <span class="menu-collapsed">&nbsp;Report</span>
                      <span class="submenu-icon ml-auto"></span>
                    </div>
                </a>
                <?php 
                if($_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['username'] == 'mclerigo') {
                  echo '<div id="collapseReport" class="collapse sidebar-submenu">
                          <a data-toggle="collapse" data-target="#collapseSalaryReport" href="#collapseSalaryReport" aria-expanded="true" 
                            aria-control="collapseSalaryreport" class="list-group-item list-group-item-action bg-dark text-white">     
                            <span class="menu-collapsed">Salary Report</span>
                          </a> 
                        </div>';
                }else{
                  echo '<div id="collapseReport" class="collapse sidebar-submenu">
                          <a data-toggle="collapse" data-target="#collapseLReport" href="#collapseLReport" aria-expanded="true"
                            aria-controls="collapseLReport" class="list-group-item list-group-item-action bg-dark text-white">
                            <span class="menu-collapsed">Leave Report</span>
                          </a>

                          <a data-toggle="collapse" data-target="#collapseSalaryReport" href="#collapseSalaryReport" aria-expanded="true" 
                            aria-control="collapseSalaryreport" class="list-group-item list-group-item-action bg-dark text-white">     
                            <span class="menu-collapsed">Salary Report</span>
                          </a> 
                        </div>';
                } 
                ?>
             <?php } 
             else {
              echo "";
             }
              ?>
          
          
        </div>
        <!-- End of HR -->

          <!-- Menu for IT -->
        <?php
        if($_SESSION['department'] == 1){
           
        ?>
        <a href="#submenu4" data-toggle="collapse" aria-expanded="false"
           class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-face-smile fa-fw mr-3"></span>
            <span class="menu-collapsed">&nbsp;IT Corner</span>
            <span class="fa-solid fa-bell" id="reqIcon2"></span>
            <span id="notificationCount2" class="notificationCount2"></span>
            <span class="submenu-icon ml-auto"></span>
            
          </div>
        </a>
        <?php
        }
        else { ?>
        <a href="#submenu4" data-toggle="collapse" aria-expanded="false"
           class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-face-smile fa-fw mr-3"></span>
            <span class="menu-collapsed">IT Corner</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <?php
        }
        ?>
        <!-- Submenu of IT -->
        <div id="submenu4" class="collapse sidebar-submenu">
          <?php 
          if($_SESSION['department'] == 1 || $_SESSION['department'] == 2) {
            echo '<a data-toggle="collapse" data-target="#collapseCarousel" href="#collapseCarousel" aria-expanded="true"
                    aria-controls="collapseCarousel" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Upload For Carousel</span>
                  </a>';
          }else{
            echo '';
          }

          if($_SESSION['department'] != 1){
            echo '';
          }else{
            echo '<a data-toggle="collapse" data-target="#collapseImportIT" href="#collapseImportIT" aria-expanded="true"
                    aria-controls="collapseImportIT" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Import IT Support</span>
                  </a>
                  ';
          }
          ?>
          <!-- <a data-toggle="collapse" data-target="#collapseCarousel" href="#collapseCarousel" aria-expanded="true"
             aria-controls="collapseCarousel" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="menu-collapsed">Upload For Carousel</span>
          </a> -->
          <?php 
          if($_SESSION['department'] != 1) {
            echo '
                  <a data-toggle="collapse" data-target="#collapseITForm" href="#collapseITForm" aria-expanded="true"
                    aria-controls="collapseITForm" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Req. for IT Support</span>
                  </a>
                ';
          }else{
            echo '';
          }
          ?>
          <?php 
            if($_SESSION['department'] != 1) {
              echo '<a data-toggle="collapse" data-target="#collapserequestITStatus" href="#collapserequestITStatus" aria-expanded="true"
                    aria-controls="collapserequestITStatus" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Request Status</span></a>';
            }
            // else if($_SESSION['department'] == 1){
              //   echo '<a data-toggle="collapse" data-target="#collapserequestITStatus2" href="#collapserequestITStatus2" aria-expanded="true"
              //         aria-controls="collapserequestITStatus2" class="list-group-item list-group-item-action bg-dark text-white">
              //         <span class="menu-collapsed">Request Status</span></a>';
              // }
            else if($_SESSION['department'] == 1) {
                // if($_SESSION['department'] == 1 && $_SESSION['username'] != 'lkescano') {
                //     $sql_counter = "SELECT r.* FROM `accounts` as a
                //         JOIN `request` as r ON r.r_user_Id = a.userId
                //         WHERE r.r_Status IN (2, 7)";
                // }
                //     $query_counter = mysqli_query($con, $sql_counter);
                //     $counter = mysqli_num_rows($query_counter);
              ?>
              <a data-toggle="collapse" data-target="#collapseITApproval" href="#collapseITApproval" aria-expanded="true"
                  aria-controls="collapseITApproval" class="list-group-item list-group-item-action bg-dark text-white">
                  <!-- <span class="fa fa-check fa-fw mr-3"></span> -->
                  <span class="menu-collapsed">IT Support</span>
                  <span class="fa-solid fa-bell" id="reqIcon"></span>
                  <span id="notificationCount3" class="notificationCount3"></span>
                
                  <span id="notificationCount3"></span>
              <?php 
            }?>
          <!-- <a data-toggle="collapse" data-target="#collapserequestITStatus" href="#collapserequestITStatus" aria-expanded="true"
              aria-controls="collapserequestITStatus" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Request Status</span>
            </a> -->
          <?php 
          if($_SESSION['department'] == 1) { ?>
          <a data-toggle="collapse" data-target="#collapseITReport" href="#collapseITReport" aria-expanded="true"
             aria-controls="collapseITReport" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="menu-collapsed">Report</span>
          </a>
          <a data-toggle="collapse" data-target="#collapseAMLCReport" href="#collapseAMLCReport" aria-expanded="true"
             aria-controls="collapseAMLCReport" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="menu-collapsed">AMLC Report</span>
          </a>
          <?php } ?>
        </div>

        <!-- LOAN -->
        <?php
          $targetPosition = ["LOAN Officer", "Credit Investigator", "Credit Officer", "LOAN Docu. Officer","Loan Docu. Assistant",
          "Credit Risk", "ROPOA Officer", "ROPOA Docu. Assistant", "Collection Officer","LOAN Assistant","Collection Assistant", "Compliance Officer", "Credit Manager"];
              $targetUser=["cdcruz", "eecesar", "cgluda", "hriegodedios","cdalegre", "ejcemata", "jabportillo", "dgayac", "dmsantos", "hmmendoza", "tjqpasicolan", "smdumagat", "cbasco", "aayambot", "mdgloria", "jlcvalero", "rdalvarez", "gmrance"];
            if ($_SESSION['department'] == 1 || $_SESSION['position'] == "BM" || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'lkescano' || in_array($_SESSION['bankposition'], $targetPosition) 
            || in_array($_SESSION['username'], $targetUser )) {
        // if($_SESSION['department'] == 1) {
          // || $_SESSION['department'] == 6 || $_SESSION['username'] == 'jalvarez' || $_SESSION['position'] == 'BM'
        ?>
        <a href="#submenu7" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa-solid fa-hand-holding-dollar fa-fw mr-3"></span>
            <span class="menu-collapsed">&nbsp;LOANS</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        
          <!-- Submenu of LOAN -->
          <div id="submenu7" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseLUC" href="#collapseLUC" aria-expanded="true"
              aria-controls="collapseLUC" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Look Up Customer</span>
            </a>
          </div>
          <?php if($_SESSION['department'] == 1 || $_SESSION['department'] == 4 || $_SESSION['department'] == 15 || $_SESSION['position'] == 'BM' || $_SESSION['userid'] == 19
                || $_SESSION['userid'] == 16 || $_SESSION['userid'] == 29){ ?>
           <div id="submenu7" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapsePipe" href="#collapsePipe" aria-expanded="true"
              aria-controls="collapsePipe" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Pipeline</span>
            </a>
          </div>
          <?php }  ?>
            <?php 
            if($_SESSION['department'] == 6 || $_SESSION['department'] == 1 || $_SESSION['position'] == 'BM' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'lkescano'
              || $_SESSION['username'] == 'cgluda' || $_SESSION['username'] == 'eecesar' || $_SESSION['username'] == 'hriegodedios' || $_SESSION['username'] == "aayambot"
              || $_SESSION['username'] == 'dgayac' || $_SESSION['username'] == 'hmmendoza' || $_SESSION['username'] == "cbasco" || $_SESSION['username'] == "dmsantos" || $_SESSION['username'] == "jabportillo"
              || $_SESSION['username'] == 'jlcvalero'){
            ?>
          <div id="submenu7" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseDue" href="#collapseDue" aria-expanded="true"
              aria-controls="collapseDue" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Due Collection</span>
            </a>
          </div>
          <?php
            }
            if($_SESSION['department'] == 1 || $_SESSION['username'] == 'jdiokno' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'lkescano'){
            ?>
                <div id="submenu7" class="collapse sidebar-submenu">
                  <a data-toggle="collapse" data-target="#collapseDueReport" href="#collapseDueReport" aria-expanded="true"
                    aria-controls="collapseDueReport" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Report</span>
                  </a>
                </div>
                   <div id="submenu7" class="collapse sidebar-submenu">
                      <a data-toggle="collapse" data-target="#collapseCMSReport" href="#collapseCMSReport" aria-expanded="true"
                        aria-controls="collapseCMSReport" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">CMS Upload Report</span>
                      </a>
                    </div>
                    <div id="submenu7" class="collapse sidebar-submenu">
                      <a data-toggle="collapse" data-target="#collapseLMSReport" href="#collapseLMSReport" aria-expanded="true"
                        aria-controls="collapseLMSReport" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">LMS Upload Report</span>
                      </a>
                    </div>

                  <?php
                
                    if($_SESSION['department'] == 1){ ?>
                      <div id="submenu7" class="collapse sidebar-submenu">
                        <a data-toggle="collapse" data-target="#collapseDocReport" href="#collapseDocReport" aria-expanded="true"
                        aria-controls="collapseDocReport" class="list-group-item list-group-item-action bg-dark text-white">
                        <span class="menu-collapsed">Doc Bet Report</span>
                        </a>
                      </div>
                  <?php
                    }
            }else{
              if($_SESSION['username'] == 'cbasco' || $_SESSION['username'] == 'aayambot'){
                ?>
                <div id="submenu7" class="collapse sidebar-submenu">
                  <a data-toggle="collapse" data-target="#collapseCMSReport" href="#collapseCMSReport" aria-expanded="true"
                    aria-controls="collapseCMSReport" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">CMS Upload Report</span>
                  </a>
                </div>
                <div id="submenu7" class="collapse sidebar-submenu">
                  <a data-toggle="collapse" data-target="#collapseLMSReport" href="#collapseLMSReport" aria-expanded="true"
                    aria-controls="collapseLMSReport" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">LMS Upload Report</span>
                  </a>
                </div>
                <?php
              }
            }
        }
        if($_SESSION['position'] == 'BM'){
          echo '<div id="submenu7" class="collapse sidebar-submenu">
                  <a data-toggle="collapse" data-target="#collapseDueReportBM" href="#collapseDueReportBM" aria-expanded="true"
                    aria-controls="collapseDueReportBM" class="list-group-item list-group-item-action bg-dark text-white">
                    <span class="menu-collapsed">Report</span>
                  </a>
                </div>';
        }
        ?>

        <!-- <a data-toggle="collapse" data-target="#calculator" href="#calculator" aria-expanded="true"
          aria-controls="calculator" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="fa-solid fa-calculator mr-3"></span>&nbsp;
          <span class="menu-collapsed">Calculator</span>
        </a> -->

        <a data-toggle="collapse" data-target="#calculator" href="#calculator" aria-expanded="true"
          aria-controls="calculator" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="fa-solid fa-calculator mr-3"></span>&nbsp;
          <span class="menu-collapsed">
            Calculator 
            <!-- <span style="color: lightgreen; font-size: 0.8em;">
              ✨ New Feature
            </span> -->
          </span>
        </a>


        <!-- Menu for Inventory -->
        <a href="#submenu6" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa-solid fa-layer-group"></span>
            <span class="menu-collapsed">&nbsp;Inventory</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu of Inventory -->
        <div id="submenu6" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#collapseInventorytab" href="#collapseInventorytab" aria-expanded="true"
            aria-controls="collapseInventorytab" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Inventory</span>
          </a>
        </div>

        <?php if($_SESSION['department'] == 1){ ?>

        <!-- Menu for Inventory -->
        <a href="#submenuDisposal" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa-solid fa-layer-group"></span>
            <span class="menu-collapsed">&nbsp;Disposal</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        <!-- Submenu of Inventory -->
        <div id="submenuDisposal" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#collapseDisposalReqForm" href="#collapseDisposalReqForm" aria-expanded="true"
            aria-controls="collapseDisposalReqForm" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Disposal Request Form</span>
          </a>

          <a data-toggle="collapse" data-target="#collapseDisposalRevForm" href="#collapseDisposalRevForm" aria-expanded="true"
            aria-controls="collapseDisposalRevForm" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Disposal Review Form</span>
          </a>

          <a data-toggle="collapse" data-target="#collapseDisposalBidForm" href="#collapseDisposalBidForm" aria-expanded="true"
            aria-controls="collapseDisposalBidForm" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Disposal Bid Form</span>
          </a>

          <a data-toggle="collapse" data-target="#collapseDisposalAppForm" href="#collapseDisposalAppForm" aria-expanded="true"
            aria-controls="collapseDisposalAppForm" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Disposal Approval Form</span>
          </a>

          <a data-toggle="collapse" data-target="#collapseDisposalStatusForm" href="#collapseDisposalStatusForm" aria-expanded="true"
            aria-controls="collapseDisposalStatusForm" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Disposal Status</span>
          </a>
        </div>

        <?php } ?>
        <!-- <a href="#submenu2023" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
              <span class="fa-solid fa-video"></span>&nbsp;
              <span class="menu-collapsed">Anniversay Video</span>
              <span class="submenu-icon ml-auto"></span>
            </div>
          </a>
          <div id="submenu2023" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapse4anniv" href="#collapse4anniv" aria-expanded="true"
              aria-controls="collapse4anniv" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">4th Anniversary</span>
            </a>
          </div> -->
          <!-- <div id="submenu2023" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseAlvarez" href="#collapseAlvarez" aria-expanded="true"
              aria-controls="collapseAlvarez" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Edward Alvarez</span>
            </a>
          </div>
          <div id="submenu2023" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseArpon" href="#collapseArpon" aria-expanded="true"
              aria-controls="collapseArpon" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="menu-collapsed">Fe Arpon</span>
            </a>
          </div> -->
        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- GM/AGM IT Support Approval -->
        <?php
        if($_SESSION['username'] == 'lkescano' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'admin' || $_SESSION['username'] == 'relievergm'){
          if($_SESSION['username'] == 'lkescano' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'admin'){
            $sqlGMs = "SELECT d.departmentName, r.* FROM `accounts` as a 
                    JOIN `department` as d  ON d.id = a.userDepartment
                    JOIN `request` as r ON r.r_user_Id = a.userId
                    WHERE r.r_Status = 1";
                    // a.userPosition <> 'Staff'
            $queryGMs = mysqli_query($con, $sqlGMs);
            $queryCountGMs = mysqli_num_rows($queryGMs);
          }
      ?>
        <div id='GM'>
          <a data-toggle="collapse" data-target="#collapseReqtoGM" href="#collapseReqtoGM" aria-expanded="true"
             aria-controls="collapseReqtoGM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa fa-check fa-fw mr-3"></span>
            <span class="menu-collapsed">Supp. Approval</span>
            <span class="fa-solid fa-bell" id="reqIcon"></span>
            <!-- <span id="notificationCount" name="notificationCount"></span> -->
            <?php 
            if($queryCountGMs >= 1){ ?>
              <span id="notificationCount5" name="notificationCount" value="<?= $queryCountGMs; ?>"></span>
            <?php
            }else {
            ?>
              <span id="notificationCount5" name="notificationCount" value="<?= $queryCountGMs; ?>"></span>
          </a>
        </div>
      <?php
          }
        }
      ?>

      <!-- sir Ju IT Support Approval Section -->
      <?php
        if($_SESSION['bankposition'] == 'IT Officer' || $_SESSION['bankposition'] == 'Developer'){
          if($_SESSION['bankposition'] == 'IT Officer' || $_SESSION['bankposition'] == 'Developer'){
            $sqlReq = "SELECT * FROM `request` WHERE r_Status = 6";
                    // a.userPosition <> 'Staff'
            $queryReq = mysqli_query($con, $sqlReq);
            $queryCount = mysqli_num_rows($queryReq);
          }
      ?>
        <div id='notifC'>
          <a data-toggle="collapse" data-target="#collapseReqtoJCV" href="#collapseReqtoJCV" aria-expanded="true"
             aria-controls="collapseReqtoJCV" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa fa-check fa-fw mr-3"></span>
            <span class="menu-collapsed">Supp. Approval</span>
            <span class="fa-solid fa-bell" id="reqIcon"></span>
            <!-- <span id="notificationCount" name="notificationCount"></span> -->
            <?php 
            if($queryCount >= 1){ ?>
              <span id="notificationCount4" name="notificationCount" value="<?= $queryCount; ?>"></span>
            <?php
            }else {
            ?>
              <span id="notificationCount4" name="notificationCount" value="<?= $queryCount; ?>"></span>
          </a>
        </div>
        
      <?php
          }
        }
        date_default_timezone_set('Asia/Manila');
        $dateToday2 = date("Y-m-d");
        $sqlAbsent2 = "SELECT * FROM `leavetbl`
                                              WHERE iBranch = '" . $_SESSION['address'] . "'
                                                AND dateFrom <= '$dateToday2' AND dateTo >= '$dateToday2'
                                                AND user_Id IN (37, 10, 12, 15, 17, 25, 30, 48)"; // 71, 73, 75, 77, 79, 81, 83
        $queryAbsent2 = mysqli_query($con, $sqlAbsent2);
        $rowFetch2 = mysqli_fetch_assoc($queryAbsent2);
        if($rowFetch2['iAbsent'] == 1 && $rowFetch2['dateFrom'] <= $dateToday2 && $rowFetch2['dateTo'] >= $dateToday2 && $rowFetch2['iStatus'] == 2){
          if ($_SESSION['bankposition'] == 'BM-Noveleta' || $_SESSION['bankposition'] == 'BM-Tejero' || $_SESSION['bankposition'] == 'BM-Poblacion'
              || $_SESSION['bankposition'] == 'BM-Manggahan' || $_SESSION['bankposition'] == 'BM-Magallanes' || $_SESSION['bankposition'] == 'BM-Maragondon' 
              || $_SESSION['bankposition'] == 'BM-Ternate' || $_SESSION['bankposition'] == 'HR Officer' || $_SESSION['bankposition'] == 'LOAN Officer'
              || $_SESSION['bankposition'] == 'ROPOA Officer' || $_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['bankposition'] == 'LOAN Docu. Officer'
              || $_SESSION['bankposition'] == 'Credit Officer' || $_SESSION['bankposition'] == 'Compliance Officer' || $_SESSION['bankposition'] == 'Internal Auditor'
              || $_SESSION['bankposition'] == 'Developer' || $_SESSION['bankposition'] == 'Branch Cashier' || $_SESSION['bankposition'] == 'Credit Risk' || $_SESSION['bankposition'] == 'Collection Officer'
              || $_SESSION['bankposition'] == 'Credit Manager' || $_SESSION['bankposition'] == 'Treasurer'
              ) {

            if($_SESSION['bankposition'] == 'Developer'){
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                      JOIN `department` as d  ON d.id = a.userDepartment
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3)";
            }

            if($_SESSION['bankposition'] == 'BM-Noveleta') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
            }

            if($_SESSION['bankposition'] == 'BM-Tejero') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
            }

            if($_SESSION['bankposition'] == 'BM-Poblacion') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
            }

            if($_SESSION['bankposition'] == 'BM-Manggahan') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
            }

            if($_SESSION['bankposition'] == 'BM-Magallanes') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
                        
            }

            if($_SESSION['bankposition'] == 'BM-Maragondon') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
            }

            // if($_SESSION['position'] === "BM-Maragondon"  && $_SESSION['username'] === "mruazol"){
            //     $sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
            //             JOIN `department` as d  ON d.id = a.userDepartment
            //             JOIN `request` as r ON r.r_user_Id = a.userId
            //             WHERE d.id = '". $_SESSION['department'] ."'
            //             AND a.address = 'Ternate'
            //             AND r.r_Status IN (0, 3)";
            //   }

            if($_SESSION['bankposition'] == 'BM-Ternate') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND r.r_Status IN (0, 3)";
            }

            if($_SESSION['bankposition'] == 'Branch Cashier') {
              $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND a.address = '" . $_SESSION['address'] . "'
                        AND a.bankPosition <> 'Branch Cashier'
                        AND r.r_Status IN (0, 3)";
            }

            if($_SESSION['department'] == 2) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 3) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment IN (3, 4)";
            }
            if($_SESSION['department'] == 4) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 5) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 6) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0,3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 7) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 17) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 18) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 19) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 20) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
            if($_SESSION['department'] == 23) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
             if($_SESSION['department'] == 24) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
            }
          $query2 = mysqli_query($con, $sql2);
          $count2 = mysqli_num_rows($query2);
          ?>
          <a data-toggle="collapse" data-target="#collapseBMApproval" href="#collapseBMApproval" aria-expanded="true"
              aria-controls="collapseBMApproval" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="fa fa-check fa-fw mr-3"></span>
              <span class="menu-collapsed" id="suppApproval">Supp. Approval</span>
              <span class="fa-solid fa-bell" id="reqIcon"></span>
              <?php if($count2 >= 1){ ?>
              <span id="notificationCount6"></span>
              <?php } else {
              ?>
              <span id="notificationCount6"></span>
          </a>
          <?php 
            } 
          }
        }
        else{
          if(!empty($rowFetch2) || empty($rowFetch2)){
            if ($_SESSION['bankposition'] == 'BM-Noveleta' || $_SESSION['bankposition'] == 'BM-Tejero' || $_SESSION['bankposition'] == 'BM-Poblacion'
                || $_SESSION['bankposition'] == 'BM-Manggahan' || $_SESSION['bankposition'] == 'BM-Magallanes' || $_SESSION['bankposition'] == 'BM-Maragondon' 
                || $_SESSION['bankposition'] == 'BM-Ternate' || $_SESSION['bankposition'] == 'HR Officer' || $_SESSION['bankposition'] == 'LOAN Officer'
                || $_SESSION['bankposition'] == 'ROPOA Officer' || $_SESSION['bankposition'] == 'Accounting Officer' || $_SESSION['bankposition'] == 'LOAN Docu. Officer'
                || $_SESSION['bankposition'] == 'Credit Officer' || $_SESSION['bankposition'] == 'Compliance Officer' || $_SESSION['bankposition'] == 'Internal Auditor'
                || $_SESSION['bankposition'] == 'Developer' || $_SESSION['bankposition'] == 'Credit Risk' || $_SESSION['bankposition'] == 'Collection Officer'
                || $_SESSION['bankposition'] == 'Credit Manager' || $_SESSION['bankposition'] == 'Treasurer'
                ) {

              if($_SESSION['bankposition'] == 'Developer'){
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'BM-Noveleta') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'BM-Tejero') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'BM-Poblacion') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'BM-Manggahan') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'BM-Magallanes') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'BM-Maragondon') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              // if($_SESSION['position'] === "BM-Maragondon"  && $_SESSION['username'] === "mruazol"){
              //     $sql = "SELECT d.departmentName, r.* FROM `accounts` as a 
              //             JOIN `department` as d  ON d.id = a.userDepartment
              //             JOIN `request` as r ON r.r_user_Id = a.userId
              //             WHERE d.id = '". $_SESSION['department'] ."'
              //             AND a.address = 'Ternate'
              //             AND r.r_Status IN (0, 3)";
              //   }
              

              if($_SESSION['bankposition'] == 'BM-Ternate') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['bankposition'] == 'Branch Cashier') {
                $sql2 = "SELECT d.departmentName, r.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `request` as r ON r.r_user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.address = '" . $_SESSION['address'] . "'
                          AND r.r_Status IN (0, 3)";
              }

              if($_SESSION['department'] == 2) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 3) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment IN (3, 4)";
              }
              if($_SESSION['department'] == 4) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 5) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 6) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0,3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 7) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 17) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 18) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 19) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 20) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 23) {
                $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                        JOIN `request` as r ON r.r_user_Id = a.userId
                        WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              if($_SESSION['department'] == 24) {
              $sql2 = "SELECT r.*, a.userDepartment FROM `accounts` as a
                      JOIN `request` as r ON r.r_user_Id = a.userId
                      WHERE r.r_Status IN (0, 3) AND a.userDepartment = '" . $_SESSION['department'] . "'";
              }
              $query2 = mysqli_query($con, $sql2);
              $count2 = mysqli_num_rows($query2);
              ?>
              <a data-toggle="collapse" data-target="#collapseBMApproval" href="#collapseBMApproval" aria-expanded="true"
                  aria-controls="collapseBMApproval" class="list-group-item list-group-item-action bg-dark text-white">
                  <span class="fa fa-check fa-fw mr-3"></span>
                  <span class="menu-collapsed" id="suppApproval">Supp. Approval</span>
                  <span class="fa-solid fa-bell" id="reqIcon"></span>
                  <?php if($count2 >= 1){ ?>
                  <span id="notificationCount6"></span>
                  <?php } else {
                  ?>
                  <span id="notificationCount6"></span>
              </a>
              <?php 
              } 
            }
          }
        }
        ?>  
        <?php
        date_default_timezone_set('Asia/Manila');
        $dateToday = date("Y-m-d");
        $sqlAbsent = "SELECT * FROM `leavetbl`
                                              WHERE iBranch = '" . $_SESSION['address'] . "'
                                                        AND dateFrom <= '$dateToday' AND dateTo >= '$dateToday'
                                                        AND user_Id IN (37, 10, 12, 15, 17, 25, 30, 48)"; // 71, 73, 75, 77, 79, 81, 83
        $queryAbsent = mysqli_query($con, $sqlAbsent);
        $rowFetch = mysqli_fetch_assoc($queryAbsent);
        // print_r(mysqli_fetch_assoc($queryAbsent));
        /* IF BM is ABSENT */
        if($rowFetch['iAbsent'] == 1 && $rowFetch['dateFrom'] <= $dateToday && $rowFetch['dateTo'] >= $dateToday && $rowFetch['iStatus'] == 2){
          if($_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'GM' 
             || $_SESSION['position'] == 'AGM' || $_SESSION['bankposition'] == 'Developer' 
             || $_SESSION['bankposition'] == 'Branch Cashier') {

            if($_SESSION['position'] == 'Head') {
              if($_SESSION['username'] == 'jcvillanueva'){
                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `leavetbl` as l ON l.user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.userId <> '" . $_SESSION['userid'] . "'
                          AND l.iStatus = 1";
                // $sql = "
                //         SELECT d.departmentName, l.*
                //         FROM `accounts` AS a
                //         JOIN `department` AS d ON d.id = a.userDepartment
                //         JOIN `leavetbl` AS l ON l.user_Id = a.userId
                //         WHERE 
                //         (
                //             (
                //                 l.iStatus = 1 
                //                 AND a.userPosition <> 'Staff'
                //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                //             )
                //             OR
                //             (
                //                 l.iStatus = 1
                //                 AND d.id = '" . $_SESSION['department'] . "'
                //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                //             )
                //         )";

              }else if($_SESSION['username'] == 'jbquijano') {
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                                                JOIN `department` as d ON d.id = a.userDepartment
                                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                                WHERE l.iStatus = 1 
                                                                        AND d.id IN (3, 6, 4)
                                                                        AND a.userPosition = 'Staff'
                                                ";
              }else{
                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                          JOIN `department` as d  ON d.id = a.userDepartment
                          JOIN `leavetbl` as l ON l.user_Id = a.userId
                          WHERE d.id = '". $_SESSION['department'] ."'
                          AND a.userId <> '" . $_SESSION['userid'] . "'
                          AND l.iStatus = 1";
              }
             
            }
            if($_SESSION['position'] == 'BM') {
              // if($_SESSION['username'] !== 'mruazol'){
                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                      JOIN `department` as d  ON d.id = a.userDepartment
                      JOIN `leavetbl` as l ON l.user_Id = a.userId
                      WHERE d.id = '". $_SESSION['department'] ."'
                      AND l.iStatus = 1";
              // }else{
              //   $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
              //         JOIN `department` as d  ON d.id = a.userDepartment
              //         JOIN `leavetbl` as l ON l.user_Id = a.userId
              //         WHERE d.id IN (12, 14)
              //         AND l.iStatus = 1";
              // }
              
            }

            if($_SESSION['bankposition'] == 'Branch Cashier'){
              $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                        JOIN `department` as d  ON d.id = a.userDepartment
                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                        WHERE d.id = '". $_SESSION['department'] ."'
                        AND l.iStatus = 1 ";
            }
            if($_SESSION['position'] == 'GM'){
              $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                      JOIN `department` as d ON d.id = a.userDepartment
                      JOIN `leavetbl` as l ON l.user_Id = a.userId
                      WHERE l.iStatus = 1 
                      AND a.userPosition <> 'Staff'
                      AND a.userId <> '" . $_SESSION['userid'] . "' ";
            }
            if($_SESSION['position'] == 'AGM'){
              $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                      JOIN `department` as d ON d.id = a.userDepartment
                      JOIN `leavetbl` as l ON l.user_Id = a.userId
                      WHERE l.iStatus = 1 
                      AND a.userPosition <> 'Staff'
                      AND a.userId <> '" . $_SESSION['userid'] . "' ";
            }
            if($_SESSION['bankposition'] == 'Developer'){
              $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                      JOIN `department` as d ON d.id = a.userDepartment
                      JOIN `leavetbl` as l ON l.user_Id = a.userId
                      AND l.iStatus = 1";
            }
        $query = mysqli_query($con, $sql);
        $count = mysqli_num_rows($query);
        ?>
          <a data-toggle="collapse" data-target="#collapseheadApproval" href="#collapseheadApproval" aria-expanded="true"
             aria-controls="collapseheadApproval" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="fa fa-check fa-fw mr-3"></span>
            <span class="menu-collapsed" id="forApproval">For Approval</span>
            <span class="fa-solid fa-bell" id="reqIcon"></span>
            <?php if($count >= 1){ ?>
            <span id="notificationCount7"></span>
            <?php } else {
            ?>
            <span id="notificationCount7"></span>
          </a>
        <?php 
            }
          }
        }
        else{
          /* IF BM is PRESENT */
          if(!empty($rowFetch) || empty($rowFetch)){
            if($_SESSION['position'] == 'Head' || $_SESSION['position'] == 'BM' || $_SESSION['position'] == 'GM' 
              || $_SESSION['position'] == 'AGM' || $_SESSION['bankposition'] == 'Developer') {
                if($_SESSION['position'] == 'Head') {
                  if($_SESSION['username'] == 'jcvillanueva'){
                    $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `leavetbl` as l ON l.user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.userId <> '" . $_SESSION['userid'] . "'
                              AND l.iStatus = 1";
                    // $sql = "
                    //         SELECT d.departmentName, l.*
                    //         FROM `accounts` AS a
                    //         JOIN `department` AS d ON d.id = a.userDepartment
                    //         JOIN `leavetbl` AS l ON l.user_Id = a.userId
                    //         WHERE 
                    //         (
                    //             (
                    //                 l.iStatus = 1 
                    //                 AND a.userPosition <> 'Staff'
                    //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                    //             )
                    //             OR
                    //             (
                    //                 l.iStatus = 1
                    //                 AND d.id = '" . $_SESSION['department'] . "'
                    //                 AND a.userId <> '" . $_SESSION['userid'] . "'
                    //             )
                    //         )";

                  }else if($_SESSION['username'] == 'jbquijano') {
                                        $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                                                                JOIN `department` as d ON d.id = a.userDepartment
                                                                JOIN `leavetbl` as l ON l.user_Id = a.userId
                                                                WHERE l.iStatus = 1 
                                                                        AND d.id IN (3, 6, 4)
                                                                        AND a.userPosition = 'Staff'
                                                ";
                  }else{
                    $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                              JOIN `department` as d  ON d.id = a.userDepartment
                              JOIN `leavetbl` as l ON l.user_Id = a.userId
                              WHERE d.id = '". $_SESSION['department'] ."'
                              AND a.userId <> '" . $_SESSION['userid'] . "'
                              AND l.iStatus = 1";
                  }
                }
              if($_SESSION['position'] == 'BM') {
                // if($_SESSION['username'] !== 'mruazol'){
                  $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                    JOIN `department` as d  ON d.id = a.userDepartment
                    JOIN `leavetbl` as l ON l.user_Id = a.userId
                    WHERE d.id = '". $_SESSION['department'] ."'
                    AND l.iStatus = 1";
                // }else{
                //   $sql = "SELECT d.departmentName, l.* FROM `accounts` as a 
                //         JOIN `department` as d  ON d.id = a.userDepartment
                //         JOIN `leavetbl` as l ON l.user_Id = a.userId
                //         WHERE d.id IN (12, 14)
                //         AND l.iStatus = 1";
                // }
              }

              if($_SESSION['position'] == 'GM'){
                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                        JOIN `department` as d ON d.id = a.userDepartment
                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                        AND l.iStatus = 1 AND a.userPosition <> 'Staff'
                        AND a.userId <> '" . $_SESSION['userid'] . "' ";
              }
              
              if($_SESSION['position'] == 'AGM'){
                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                        JOIN `department` as d ON d.id = a.userDepartment
                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                        AND l.iStatus = 1 AND a.userPosition <> 'Staff'
                        AND a.userId <> '" . $_SESSION['userid'] . "' ";
              }
              if($_SESSION['bankposition'] == 'Developer'){
                $sql = "SELECT d.departmentName, l.* FROM `accounts` as a
                        JOIN `department` as d ON d.id = a.userDepartment
                        JOIN `leavetbl` as l ON l.user_Id = a.userId
                        AND l.iStatus = 1";
              }
              $query = mysqli_query($con, $sql);
              $count = mysqli_num_rows($query);
              ?>
              <a data-toggle="collapse" data-target="#collapseheadApproval" href="#collapseheadApproval" aria-expanded="true"
              aria-controls="collapseheadApproval" class="list-group-item list-group-item-action bg-dark text-white">
              <span class="fa fa-check fa-fw mr-3"></span>
              <span class="menu-collapsed" id="forApproval">For Approval</span>
              <span class="fa-solid fa-bell" id="reqIcon"></span>
              <?php if($count >= 1){ ?>
              <span id="notificationCount7"></span>
              <?php } else {
              ?>
              <span id="notificationCount7"></span>
              </a>
              <?php 
              }
            }
          }
        }
        ?>

        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->

        <!-- Menu for P&P -->
        <a href="#submenu3" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-book fa-fw mr-3"></span>
            <span class="menu-collapsed">&nbsp;Policy&Procedure</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>

        <!-- Submenu of P&P -->
        <div id="submenu3" class="collapse sidebar-submenu">
        <a data-toggle="collapse" data-target="#collapseAccMan" href="#collapseAccMan" aria-expanded="true"
             aria-controls="collapseAccMan" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Accounting Manual</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseAML" href="#collapseAML" aria-expanded="true"
             aria-controls="collapseAML" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Anti-Money</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseAPP" href="#collapseAPP" aria-expanded="true" 
            aria-controls="collapseAPP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Audit Program</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseASDM" href="#collapseASDM" aria-expanded="true" 
            aria-controls="collapseASDM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Authorized Signatories</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseGuarantee" href="#collapseGuarantee" aria-expanded="true" 
            aria-controls="collapseGuarantee" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Bank Guarantee Program With<br>Real Estate Developer</span>
          </a>
        
        <a data-toggle="collapse" data-target="#collapseBCP" href="#collapseBCP" aria-expanded="true" 
            aria-controls="collapseBCP" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Business Continuity Plan</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCoC" href="#collapseCoC" aria-expanded="true"
             aria-controls="collapseCoC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Code of Conduct</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCP" href="#collapseCP" aria-expanded="true"
             aria-controls="collapseCP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Compliance Program</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCSOM" href="#collapseCSOM" aria-expanded="true"
             aria-controls="collapseCSOM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Compliance System</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCGP" href="#collapseCGP" aria-expanded="true"
             aria-controls="collapseCGP" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Corporate Governance Policy</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCPRMS" href="#collapseCPRMS" aria-expanded="true"
             aria-controls="collapseCPRMS" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Consumer Protection Risk<br>Management System</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCCC" href="#collapseCCC" aria-expanded="true"
             aria-controls="collapseCCC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Credit Comm. Charter</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCRM" href="#collapseCRM" aria-expanded="true"
             aria-controls="collapseCRM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Credit Risk Mngmnt</span>
          </a>
        <a data-toggle="collapse" data-target="#collapsePDiscount" href="#collapsePDiscount" aria-expanded="true"
             aria-controls="collapsePDiscount" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Credit Risk Policy On<br>Penalty Discount</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseDRKM" href="#collapseDRKM" aria-expanded="true"
             aria-controls="collapseDRKM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Deposit Record</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseDashboard" href="#collapseDashboard" aria-expanded="true"
             aria-controls="collapseDashboard" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Dashboard Manual</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseSRM" href="#collapseSRM" aria-expanded="true"
             aria-controls="collapseSRM" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Environmental And Social Risk<br>Management System</span>
          </a>
        <!-- <a data-toggle="collapse" data-target="#collapseEEL" href="#collapseEEL" aria-expanded="true"
             aria-controls="collapseEEL" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Emp. Emergency Loan</span>
          </a> -->
          <a data-toggle="collapse" data-target="#collapseOEPL" href="#collapseOEPL" aria-expanded="true"
             aria-controls="collapseOEPL" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Employee And Officer Loan</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseEB" href="#collapseEB" aria-expanded="true"
             aria-controls="collapseEB" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">End Buyer Financing...</span>
          </a>
        <!-- <a data-toggle="collapse" data-target="#collapseHRP" href="#collapseHRP" aria-expanded="true"
             aria-controls="collapseHRP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">HR Policy</span>
          </a> -->
        <a data-toggle="collapse" data-target="#collapseCPIT" href="#collapseCPIT" aria-expanded="true"
             aria-controls="collapseCPIT" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">IT Business Continuity Plan</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseITP" href="#collapseITP" aria-expanded="true"
             aria-controls="collapseITP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">IT Policy</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseHB" href="#collapseHB" aria-expanded="true"
             aria-controls="collapseHB" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">IT Handbook</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseBOF" href="#collapseBOF" aria-expanded="true" 
            aria-controls="collapseBOF" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Branch Operation Files</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCMS" href="#collapseCMS" aria-expanded="true"
             aria-controls="collapseCMS" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Collection<br>Management System</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseHRCorner" href="#collapseHRCorner" aria-expanded="true"
             aria-controls="collapseHRCorner" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - HR Corner</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseCCorner" href="#collapseCCorner" aria-expanded="true"
             aria-controls="collapseCCorner" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Compliance Corner</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseChatt" href="#collapseChatt" aria-expanded="true"
             aria-controls="collapseChatt" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Dashboard Chat</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseDBPol" href="#collapseDBPol" aria-expanded="true"
             aria-controls="collapseDBPol" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Dashboard Policy<br>& Procedures</span>
          </a>
        <a data-toggle="collapse" data-target="#colapseITCorner" href="#colapseITCorner" aria-expanded="true"
             aria-controls="colapseITCorner" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - IT Corner</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseFServer" href="#collapseFServer" aria-expanded="true"
             aria-controls="collapseFServer" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - File Server</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseInventory" href="#collapseInventory" aria-expanded="true"
             aria-controls="collapseInventory" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Inventory</span>
          </a>
        <!-- <a data-toggle="collapse" data-target="#collapseITPnProc" href="#collapseITPnProc" aria-expanded="true"
             aria-controls="collapseITPnProc" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - IT Policy & Procedures</span>
          </a> -->
        <a data-toggle="collapse" data-target="#collapseLoanCalculator" href="#collapseLoanCalculator" aria-expanded="true"
             aria-controls="collapseLoanCalculator" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">IT Manual - Loan Calculator</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseLMS" href="#collapseLMS" aria-expanded="true"
             aria-controls="collapseLMS" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Loan Mngmt System</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseSS" href="#collapseSS" aria-expanded="true"
             aria-controls="collapseSS" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Survey System</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseTC" href="#collapseTC" aria-expanded="true"
             aria-controls="collapseTC" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Treasury Corner</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseQS" href="#collapseQS" aria-expanded="true"
             aria-controls="collapseQS" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">IT Manual - Queueing System</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseIAP" href="#collapseIAP" aria-expanded="true"
             aria-controls="collapseIAP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Internal Audit Policy</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseIRM" href="#collapseIRM" aria-expanded="true"
             aria-controls="collapseIRM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Invest. Risk Mngmnt</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseLRM" href="#collapseLRM" aria-expanded="true"
             aria-controls="collapseLRM" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Liquidity Risk Mngmnt</span>
          </a>
        
        <a data-toggle="collapse" data-target="#collapseManualOps" href="#collapseManualOps" aria-expanded="true"
             aria-controls="collapseManualOps" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Manual of Operations</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseOP" href="#collapseOP" aria-expanded="true"
             aria-controls="collapseOP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Outsourcing Policy</span>
          </a>
        <a data-toggle="collapse" data-target="#collapsePCAB" href="#collapsePCAB" aria-expanded="true"
             aria-controls="collapsePCAB" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Procedure For Creating Or <br>Amending Bank Policies</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseRecovery" href="#collapseRecovery" aria-expanded="true"
            aria-controls="collapseRecovery" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="menu-collapsed">Recovery Plan Policy</span>
        </a>
        <a data-toggle="collapse" data-target="#collapseRPT" href="#collapseRPT" aria-expanded="true"
            aria-controls="collapseRPT" class="list-group-item list-group-item-action bg-dark text-white">
          <span class="menu-collapsed">Related Party Transaction <br> Policy</span>
        </a>
        <a data-toggle="collapse" data-target="#collapseRMP" href="#collapseRMP" aria-expanded="true"
             aria-controls="collapseRMP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Risk Mngmnt Policy</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseROPA" href="#collapseROPA" aria-expanded="true"
             aria-controls="collapseROPA" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">ROPA Policy</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseSMRM" href="#collapseSMRM" aria-expanded="true"
             aria-controls="collapseSMRM" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed">Social Media Risk Management</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseSPR" href="#collapseSPR" aria-expanded="true"
             aria-controls="collapseSPR" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Succession Planning Procedure</span>
          </a>
        <a data-toggle="collapse" data-target="#collapseSP" href="#collapseSP" aria-expanded="true"
             aria-controls="collapseSP" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Sustainability Policy</span>
          </a>
        </div>
          <a href="#submenu11" data-toggle="collapse" aria-expanded="false"
            class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-start align-items-center">
              <span class="fa fa-book fa-fw mr-3"></span>
              <span class="menu-collapsed">&nbsp;Compliance Corner</span>
              <span class="submenu-icon ml-auto"></span>
            </div>
          </a>

        <div id="submenu11" class="collapse sidebar-submenu">

        <?php 
        if($_SESSION['department'] == '1' || $_SESSION['department'] == '1' || $_SESSION['department'] == '6' || $_SESSION['department'] == '7' || $_SESSION['position'] == 'BM' || $_SESSION['bankposition'] == 'Branch Cashier' || $_SESSION['bankposition'] == 'Teller'){
        ?>
          <a data-toggle="collapse" data-target="#collapseCC" href="#collapseCC" aria-expanded="true"
             aria-controls="collapseCC" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed" id="complianceCC" name="complianceCC" >Watchlist</span>
            <form id="hiddenForm">
              <input type="hidden" value="<?php $_SESSION['userid']; ?>" name="recordUserId" id="recordUserId">
              <input type="hidden" value="<?php $_SESSION['fullname']; ?>" name="recordName" id="recordName">
            </form>
          </a>
        <?php 
        }
        ?>
          <a href="#submenuCompliance" data-toggle="collapse" aria-expanded="false"
                class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                  <span class="fa-solid fa-triangle-exclamation"></span>&nbsp;
                  <span class="menu-collapsed">Announcement</span>
                  <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
          <div id="submenuCompliance" class="collapse sidebar-submenu">
            <a data-toggle="collapse" data-target="#collapseCPA" href="#collapseCPA" aria-expanded="true"
              aria-controls="collapseCPA" class="list-group-item list-group-item-action bg-dark h-100 text-white">
              <span class="menu-collapsed">Covered Person Under the <br>Anti-Money Laundering Act</span>
            </a>
            <a data-toggle="collapse" data-target="#collapseCDDCD" href="#collapseCDDCD" aria-expanded="true"
              aria-controls="collapseCDDCD" class="list-group-item list-group-item-action bg-dark h-100 text-white">
              <span class="menu-collapsed">Customer Due Diligence For <br>Corporate Clients</span>
            </a>
            <a data-toggle="collapse" data-target="#GST" href="#GST" aria-expanded="true"
              aria-controls="GST" class="list-group-item list-group-item-action bg-dark h-100 text-white">
              <span class="menu-collapsed">Guideline For Suspicious <br>Transaction</span>
            </a>
          </div>
        </div>
        <?php
        if($_SESSION['department'] == 1 || $_SESSION['username'] === 'pnerona' || $_SESSION['department'] == 15){ ?>

        <a href="#submenuTreasury" data-toggle="collapse" aria-expanded="false"
          class="list-group-item list-group-item-action flex-column align-items-start">
          <div class="d-flex w-100 justify-content-start align-items-center">
            <span class="fa fa-balance-scale mr-3"></span>
            <span class="menu-collapsed">&nbsp;Treasury Corner</span>
            <span class="submenu-icon ml-auto"></span>
          </div>
        </a>
        
        <div id="submenuTreasury" class="collapse sidebar-submenu">
          <a data-toggle="collapse" data-target="#TB" href="#TB" aria-expanded="true"
             aria-controls="TB" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Treasury Bill</span>
          </a>
          <a data-toggle="collapse" data-target="#TD" href="#TD" aria-expanded="true"
             aria-controls="TD" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Time Deposit</span>
          </a>
          <!-- <a data-toggle="collapse" data-target="#BSPDDA" href="#BSPDDA" aria-expanded="true"
             aria-controls="BSPDDA" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Corporate Bonds</span>
          </a> -->
          <a data-toggle="collapse" data-target="#TBReport" href="#TBReport" aria-expanded="true"
             aria-controls="TBReport" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Treasury Bill Report</span>
          </a>
          <a data-toggle="collapse" data-target="#TDReport" href="#BSPTDReportDDA" aria-expanded="true"
             aria-controls="TDReport" class="list-group-item list-group-item-action bg-dark text-white">
            <span class="menu-collapsed">Time Deposit Report</span>
          </a>
        </div>
        <?php
        }
        ?>

        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>

        <a data-toggle="collapse" data-target="#collapseBlotter" href="#collapseBlotter" aria-expanded="true"
            aria-controls="collapse" class="list-group-item list-group-item-action bg-dark text-white">
            <i class="fa-solid fa-download"></i>&nbsp;<span class="menu-collapsed">Branch Operation Files
              <!-- <span style="color: lightgreen; font-size: 0.8em;">
                ✨ New Feature
              </span> -->
            </span>
        </a>




      <?php if($_SESSION['username'] == 'ctborgonia'){ ?>
        <a data-toggle="collapse" data-target="#bsp" href="#bsp" aria-expanded="true"
             aria-controls="bsp" class="list-group-item list-group-item-action bg-dark h-100 text-white">
            <span class="menu-collapsed"><strong>BSP EXAMINATION 2024</strong></span>
        </a>

        <a class="list-group-item list-group-item-action bg-dark text-white" href="https://www.share.ourbank.ph" target="_blank" >
            <span class="menu-collapsed"><strong>BSP EXAMINATION 2024</strong></span>
        </a>
      <?php } ?>
        
        <!-- Separator without title -->
        <li class="list-group-item sidebar-separator menu-collapsed bg-dark"></li>
        <!-- /END Separator -->
        <!-- data-toggle="sidebar-colapse" -->
        
        <br>
        <p id="welcomeText">WELCOME<p>
        
                   <!-- personal logo -->
           <?php
           $acc = $_SESSION['userid'];
           $sql2 = "SELECT * FROM `accounts` WHERE userId = $acc ";
           $query = mysqli_query($con, $sql2);
           while($row = mysqli_fetch_assoc($query)) {
           ?>
           <img id="profileAvatar" src="<?php echo $row['userAvatar'];?>" alt="Avatar" style="width:120px;">
           <?php } ?>
           <?php
              if (isset($_SESSION['userid']) && isset($_SESSION['role'])) {
                if ($_SESSION['role'] == 'admin') {
                echo "<p class='para'><b>". $_SESSION['fullname'] ."<br>". $_SESSION['bankposition'] ."</b><br>";
                // echo "<a style='font-size: 0.7rem; background-color: #333;' class='fa fa-solid fa-key fa-xs ' href='changePassword.php'>Change Password</p></a>";
                // echo "<a style='font-size: 0.7rem; background-color: #333;' class='fa fa-sign-out fa-xs' href='logout.php'>Logout</p></a>";
              } else {
                echo "<p class='para'><b>". $_SESSION['fullname'] ."<br>". $_SESSION['bankposition'] ."</b><br>";
                // echo "<a style='font-size: 0.7rem; background-color: #333;' class='fa fa-sign-out fa-xs' href='logout.php'>Logout</a></p>";
                }
              }
          ?>
        <!-- profile -->
          <!-- <li class="dropdown"> -->
            <!-- <a id="profile" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false" class="dropdown-toggle nav-link">
              <i class="fa fa-user-circle-o"></i>
            </a> -->
            <ul aria-labelledby="notifications" class="dropdown-menu dropdown-profile" id="userprof">
              <!-- <li><a href="#"><i class="fa fa-cog p-1"></i> Settings</a></li>
                 <li class="dropdown-divider"></li>
                <li><a href="logout.php"><i class="fa fa-sign-out p-1"></i>Logout</a></li> -->
            </ul>


          <!-- this is for profile -->
          <?php if($_SESSION['department'] == '1' || $_SESSION['username'] == 'cdalegre' || $_SESSION['username'] == 'mfreyes'){ ?>
            <li class="nav-item">
             <a href="collapseProfile" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true"
                  aria-controls="collapseProfile" class="nav-link"><span class="fa-regular fa-id-card"
                aria-hidden="true" style="font-size: 0.7rem"></span> Profile</a>
              <!-- <div id="submenuProfile" class="collapse sidebar-submenu">
                <a data-toggle="collapse" data-target="#collapseProfile" href="#collapseProfile" aria-expanded="true"
                  aria-controls="collapseProfile" class="list-group-item list-group-item-action bg-dark h-100 text-white">
                <span class="menu-collapsed">Profile</span>
                </a>
            </div> -->
          </li>
          <?php }else{
            echo "";
          } ?>

          <!-- This is for logout button -->
          <li class="nav-item"><a href="changePassword.php" class="nav-link"><span class="fa fa-solid fa-key fa-xs"
                aria-hidden="true" style="font-size: 0.7rem"></span> Change Password</a></li>
          <li class="nav-item"><a href="logout.php" class="nav-link"><span class="fa fa-sign-out fa-xs"
                aria-hidden="true" style="font-size: 0.7rem"></span> Logout</a></li>
        <!-- Logo -->
          <!-- <img src="logo/logo.png" width="40" height="40"> -->
         <!-- <a href="https://www.ourbank.ph" target="_blank"> -->
        <div class="copyRight">
        <p style="color:white; font-size: 0.8rem;font-style: italic;">©OUR Bank 2023</p>
        </div>
      </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->

    <!-- MAIN -->
    <div class="col content-area" overflow="hidden">
    <!-- <div id="backgroundVideo">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <button style="bottom: 10%;" class="carousel-control-prev rounded-circle" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="visually-hidden">Previous</span>
        </button>
        <button style="bottom: 10%;" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-inner">
          <div class="carousel-item welcome active image-container" style="max-height:100%;">
            <div style="max-height:100%; overflow: hidden; background-color: grey;">
              <video controls autoplay muted style="height:100vh; width:100%; object-fit:contain; position: relative; top:-26px;" id="annivIframe">
                <source src="video/bdayGirl.mp4" type="video/mp4">
                Your browser does not support the video tag.
              </video>
            </div>
          </div>
          <div class="carousel-item welcome active image-container"  style="max-height:100%;">
            <div style="max-height:100%; overflow: hidden; background-color: grey;">
              <img class="img-fluid" style="height:100vh;width:100%;object-fit:contain; top: -26px; position: relative;" src="image/polymer.png" alt="Logo">
            </div>
          </div>
          <div class="carousel-item featured active  image-container"  style="max-height:100%;">
            <div style="max-height:100%; overflow: hidden; background-color: grey">
              <img class="img-fluid" controls style="height:100vh;width:100%;object-fit:contain; top: -26px; position: relative;" src="image/bdayNov2025.png" alt="Logo">
            </div>
          </div>
        </div>
      </div>
    </div> -->

    <?php
    $result = $con->query("SELECT * FROM carousel_items ORDER BY position ASC");
    ?>
    <div id="backgroundVideo">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <button style="bottom: 10%;" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
          <span class="visually-hidden">Previous</span>
        </button>
        <button style="bottom: 10%;" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
          <span class="visually-hidden">Next</span>
        </button>
        <div class="carousel-inner">
          <?php
          $active = "active";
          while ($row = $result->fetch_assoc()) {
              echo '<div class="carousel-item ' . $active . ' image-container">';
              echo '<div style="max-height:100%; overflow: hidden; background-color: white;">';

              if ($row['file_type'] === 'video') {
                  echo '<video controls autoplay muted style="width:100%; height:auto; max-height:100vh; object-fit:contain;" id="annivIframe">
                          <source src="'.$row['file_name'].'" type="video/mp4">
                        </video>';
              } else {
                  echo '<img class="img-fluid" style="width:100%; height:auto; max-height:100vh; object-fit:contain;" src="'.$row['file_name'].'">';
              }

              echo '</div></div>';
              $active = "";
          }
          ?>
        </div>
      </div>
    </div>


      <!-- <div id="backgroundVideo" > -->
        <!-- <video src="./video/DASHBOARD.mp4" id="media-video" poster="./image/dashboard.jpg" autoplay muted></video> -->
        <!-- <video id="media-video" poster="./image/dashboard.jpg">
          <source src="./video/DASHBOARD.mp4" type="video/mp4" /></source>
        </video> -->
      <!-- </div> -->
      <div id="videoBtn">
      <!-- <button type="button" id="playVideo" name="playVideo" class="btn btn-success btn-md btnPlay" onclick="btnPlay()">+</button>
        <button type="button" id="pauseVideo" name="pauseVideo" class="btn btn-danger btn-md btnPause" onclick="btnPause()">=</button> -->
        <!-- <button id="button1" onclick="SwitchButtons('button1');" class="sideviewtoggle myButton">Test 1</button> -->
        <!-- <button id="button2" onclick="SwitchButtons('button2');" class="sideviewtoggle myButton" style='display:none;'>Test 2</button> -->
      </div>
      <!-- ACCORDION -->
      <div class="accordion" id="accordionExample">
      
      <div id="notify-msg" class="alert alert-info d-flex justify-content-end"
          style="cursor:pointer; position: fixed; right: 10px; top: 20px; display: none; z-index: -1">
          <span class="notify-msg">📩 You have a new message — Click to view</span>
      </div>
      

        <?php if($_SESSION['department'] != 100){ ?>
        <!-- POLICY & PROCEDURE -->
        <div id="submenu3" class="collapse" data-parent="#accordionExample">
            <embed src="policyCorner.php" type="text/html" width='100%' height='1658px'>
        </div> 
        <div id="collapseDRKM" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/DepositRecord.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/DepositRecord.pdf" rel="external">Click This</a></p>
        </div>
        <div id="collapseAPP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAuditProgram.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/AuditProgramV3.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/AuditProgramV3.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAuditProgram.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCMS" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAuditProgram.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-CMS.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="ITManual-CMS.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAuditProgram.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseLMS" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAuditProgram.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/LMS.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/LMS.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAuditProgram.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseASDM" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/ASMD.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ASMD.pdf" rel="external">Click This</a></p>
        </div> 
        <div id="collapseAML" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAntiMoney.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/AntiMoneyLaundering.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/AntiMoneyLaundering.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAntiMoney.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div> 
        <div id="collapseGuarantee" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAntiMoney.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/bank-guarantee.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/bank-guarantee.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAntiMoney.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div> 
        <div id="collapseBCP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAntiMoney.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/BCP.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/BCP.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAntiMoney.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div> 
        <div id="collapseAccMan" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfAntiMoney.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/accntngMan.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/BCP.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfAntiMoney.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div> 
        <div id="collapseCoC" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfCodeofConduct.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CodeofConduct.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CodeofConduct.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfCodeofConduct.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCP" class="collapse" scrolling='auto' data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfCP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ComplianceProgram.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ComplianceProgram.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfCP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCSOM" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfCSOM.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CSOM.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CSOM.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfCSOM.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCGP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfCSOM.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CorporateGovernancePolicy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/corporateGovernancePolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfCSOM.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCCC" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfCCC.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CCC.pdf"" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CCC.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfCCC.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseDashboard" class="collapse" data-parent="#accordionExample">
            <!-- <embed src="pdfDashboard.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/dashboardManual.pdf" rel="external">Click This</a></p> -->
            <embed src="dashboardVideo.php" type="video/mp4" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="dashboardVideo.php" rel="external">Click This</a></p>
        </div>
        <div id="collapseEEL" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfEmpEmeLoan.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/EmpEmeLoan.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/EmpEmeLoan.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfEmpEmeLoan.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseChatt" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfEmpEmeLoan.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/DC.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/DC.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfEmpEmeLoan.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseIAP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfInternalAP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/internal-audit-policy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/internal-audit-policy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfInternalAP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseIRM" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfInvestmentRM.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/InvestmentRiskManagement.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/InvestmentRiskManagement.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfInvestmentRM.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCPIT" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CPIT.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CPIT.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseITP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ItPolicy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ItPolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseHB" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITHandbook.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITHandbook.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCCorner" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-CCorner.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-CCorner.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseFServer" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-FServer.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-FServer.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseInventory" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManualInventory.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManualInventory.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseSMRM" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/SMRM.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/SMRM.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseSS" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-SS.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-SS.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseOEPL" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/officerEmployeePolicy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/officerEmployeePolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseTC" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-Treasury.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-Treasury.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseQS" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-QSystem.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-QSystem.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseHRCorner" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-HRCorner.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-HRCorner.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="colapseITCorner" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-ITCorner.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-ITCorner.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseDBPol" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ITManual-DashPolicynProc.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ITManual-DashPolicynProc.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseITPnProc" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/ItPolicy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ItPolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseLRM" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfLiquidityRM.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/LiquidityRiskManagement.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/LiquidityRiskManagement.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfLiquidityRM.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseManualOps" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfITPolicy.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/manualOpsv2.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/manualOpsv2.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfITPolicy.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseRecovery" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfRiskMP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/recoveryPlanv1.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/RiskManagementPolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfRiskMP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseRMP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfRiskMP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/RiskManagementPolicy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/RiskManagementPolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfRiskMP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseSP" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfSustainabilityP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/SustainabilityPolicy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/SustainabilityPolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfSustainabilityP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseSPR" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfSustainabilityP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/SuccessionPlanning.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/SuccessionPlanning.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfSustainabilityP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseEB" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfEB.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/EB.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/EB.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfEB.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseCRM" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfCreditRiskP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CRMMnew.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CRMMnew.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfCreditRiskP.php" scrolling='auto' frameborder="0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapsePDiscount" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/penaltyDiscount.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/penaltyDiscount.pdf" rel="external">Click This</a></p>
        </div>
        <div id="collapseSRM" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/SRM.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/SRM.pdf" rel="external">Click This</a></p>
        </div>
        <div id="collapsePCAB" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfSustainabilityP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/PCAB.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/PCAB.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfSustainabilityP.php" scrolling='auto' frameborder= "0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseOP" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/OPv2.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/OPv2.pdf" rel="external">Click This</a></p>
        </div>
        <div id="collapseROPA" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/ROPA-policy.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ROPA-policy.pdf" rel="external">Click This</a></p>
        </div>
        <div id="collapseRPT" class="collapse" data-parent="#accordionExample">
            <embed src="./pdf/RPT.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/RPT.pdf" rel="external">Click This</a></p>
        </div>
        <div id="collapseCPRMS" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfSustainabilityP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/CPRMS.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CPRMS.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfSustainabilityP.php" scrolling='auto' frameborder= "0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseLoanCalculator" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfSustainabilityP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/LCalculator.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/LCalculator.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfSustainabilityP.php" scrolling='auto' frameborder= "0" width='100%' height='1658px'></iframe> -->
        </div>
        <div id="collapseBOF" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='pdfSustainabilityP.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/BOF.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/BOF.pdf" rel="external">Click This</a></p>
            <!-- <iframe src="pdfSustainabilityP.php" scrolling='auto' frameborder= "0" width='100%' height='1658px'></iframe> -->
        </div>
        <!-- END OF P&P -->
        <div id="gallery" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="gallery.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>

        <div id="gallery2025" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="gallery2025.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>

        <div id="gallery2024" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="gallery2024.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>

        <div id="gallery2" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="gallery2.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>

        <div id="galleryVideoAccOff" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoAccOff.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoBankWare" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoBankWare.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoEO-Loan" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoeo-loan.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoBM" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoBM.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoCMS" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoCMS.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoFieldG" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoFieldG.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoPres" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoPres.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoROPA" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoROPA.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoGenMeet" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoGeneralMonthly.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="galleryVideoStratP" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideoStratP.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        

        <div id="galleryVideo" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="galleryVideo.php" type="text/html" width='100%' height='950px'>
          </div>
        </div>

        <div id="calendar" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="calendar.php" type="text/html" width='100%' height='3000px'>
          </div>
        </div>

        <div id="allCalendar" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <embed src="allCalendar.php" type="text/html" width='100%' height='3000px'>
          </div>
        </div>
        <!-- HR -->
        <div id="collapseVL" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <!-- <object data='leaveForm.php' width='100%' height='1885px'> -->
                <embed src="leaveForm.php" type="text/html" width='100%' height='1885px'>
              <!-- </object> -->
              <!-- <iframe src="leaveForm.php" frameborder="0" width='100%' height='1885px'></iframe> -->
            </div>
        </div>
        <div id="collapseBlotter" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <embed src="employeeBlotter.php" type="text/html" width='100%' height='1885px'>
            </div>
        </div>
        <div id="collapseELF" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
                <embed src="employeeLF.php" type="text/html" width='100%' height='1885px'>
            </div>
        </div>
        <div id="collapsevlStatus" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
              <!-- <object data='leavePending.php' width='100%' height='1885px'></object> -->
              <embed src="leavePending.php" type="text/html" width='100%' height='1885px'>
              <!-- <iframe src="leavePending.php" frameborder="0" width='100%' height='1885px'></iframe> -->
            </div>
        </div>
        <div id="collapseLeaveCount" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <!-- <object data="announcement.php" width='100%' height='1885px'></object> -->
            <embed src="leave-report-count.php" type="text/html" width='100%' height='1120px'>
          <!-- <iframe src="announcement.php" frameborder="0" width='100%' height='1000px'></iframe> -->
            </div>
        </div>
        <div id="collapseAnnouncement" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <!-- <object data="announcement.php" width='100%' height='1885px'></object> -->
            <embed src="announcement.php" type="text/html" width='100%' height='1120px'>
          <!-- <iframe src="announcement.php" frameborder="0" width='100%' height='1000px'></iframe> -->
            </div>
        </div>
        <div id="collapseDirectory" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <!-- <object data="announcement.php" width='100%' height='1885px'></object> -->
            <embed src="hrDirectory.php" type="text/html" width='100%' height='900px'>
          <!-- <iframe src="announcement.php" frameborder="0" width='100%' height='1000px'></iframe> -->
            </div>
        </div>
        <div id="collapseLReport" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
              <!-- <object data='leaveReport.php' width='100%' height='1885px'></object> -->
              <embed src="leaveReport.php" type="text/html" width='100%' height='1885px'>
              <!-- <iframe src="leaveReport.php" frameborder="0" width='100%' height='1885px'></iframe> -->
            </div>
        </div>
        <!-- <div id="collapsePayslip" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="payslip.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div> -->
          <!-- MEMO -->
        <div id="collapseDisciplinary" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memoDisciplinary.php' type='application/pdf' width='100%' height='1658px'></object> -->
            <embed src="memoDisciplinary.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/disciplinaryAction.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memoDisciplinary.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseDisposal" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfDisposal.php' type='application/pdf' width='100%' height='1658px'></object> -->
            <embed src="memopdfDisposal.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/ffeDisposal.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfDisposal.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseJRPolicy" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfJobRotation.php' width='100%' height='1658px'></object> -->
            <embed src="memopdfJobRotation.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/JobRotationPolicy.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfJobRotation.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>

        <div id="collapseBdayCake" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="memoBdayCake.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/birthdayCake.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseUnuse" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="memopdfUnuseLeave.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/memopdfUnuseLeave.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseHealthCare" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="memopdfHealthCare.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/OURHCReimProg.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseStrLOA" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="./pdf/strLOA.pdf" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/strLOA.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseCPA" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="memoCPA.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/memoCPA.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="collapseCDDCD" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="memoCDDCD.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/CDDCC.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
        <div id="GST" class="collapse" data-parent="#accordionExample">
            <!-- <object class='pdfViewer' data='memopdfHealthCare.php' width='100%' height='1658px'></object> -->
            <embed src="memoGST.php" type="text/html" width='100%' height='1658px'>
            <p>If PDF file can't load <a target="_blank" href="./pdf/GST.pdf" rel="external">Click This</a></p>
            <!-- <iframe src='memopdfHealthCare.php' scrolling='auto' frameborder="0" height='1658px' width='100%'></iframe> -->
        </div>
          <!-- END OF MEMO -->

        <div id="collapsePayslip" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='payslip.php' width='100%' height='1885px'></object> -->
            <!-- <embed src="payroll.php" type="text/html" width='100%' height='1885px'> -->
            <iframe src="pay-importdata.php"  frameborder="0" width='100%' height='1885px'></iframe>
          </div>
        </div>

        <div id="collapseMyPayslip" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='payslip.php' width='100%' height='1885px'></object> -->
            <embed src="pay-mypayslip.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="payslip.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>

        <div id="collapseBonus" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="pay-bonus.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>

        <div id="collapseSalaryReport" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="pay-reportsalary.php" type="text/html" width='100%' height='1885px'>
            <!-- <object data='requestITReport.php' width='100%' height='1885px'></object> -->
            <!-- <iframe src="requestITReport.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>

        <div id="collapseEmpEarnings" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="pay-employeemanagement.php" type="text/html" width='100%' height='1885px'>
            <!-- <object data='requestITReport.php' width='100%' height='1885px'></object> -->
            <!-- <iframe src="requestITReport.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>

        <!-- ONLINE EXAM -->
        <div id="collapseTakeExam" class="collapse" data-parent="#accordionExample">
        <div class="card-body">
          <embed src="OnlineExam/online-exam.php" type="text/html" width='100%' height='1885px'>
        </div>
      </div>

      <div id="collapseExamReport" class="collapse" data-parent="#accordionExample">
        <div class="card-body">
          <embed src="OnlineExam/online-exam-report.php" type="text/html" width='100%' height='1885px'>
        </div>
      </div>

      <!-- END OF HR -->

              <!-- IT SUPPORT -->
        <div id="collapseCarousel" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="carouselUpload.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>
        <div id="collapseImportIT" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='requestITForm.php' width='100%' height='1885px'></object> -->
            <!-- <embed src="requestITImport.php" type="text/html" width='100%' height='1885px'> -->
            <iframe src="requestITImport.php" width="100%" height="1885px"></iframe>
          </div>
        </div>
        <div id="collapseITForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='requestITForm.php' width='100%' height='1885px'></object> -->
            <embed src="requestITForm.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="requestITForm.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <div id="collapserequestITStatus" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='requestITStatus.php' width='100%' height='1885px'></object> -->
            <embed src="requestITStatus.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="requestITStatus.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <div id="collapseAMLCReport" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='recordAMLCtbl.php' width='100%' height='1885px'></object> -->
            <embed src="recordAMLCtbl.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="recordAMLCtbl.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!-- END OF IT -->
        <!-- LOANS -->
        <?php
          $targetPosition = ["LOAN Officer", "Credit Investigator", "Credit Officer", "LOAN Docu. Officer","Loan Docu. Assistant",
                            "Credit Risk", "ROPOA Officer", "ROPOA Docu. Assistant", "Collection Officer","LOAN Assistant","Collection Assistant", "Compliance Officer", "Credit Manager"];
          $targetUser = ["hriegodedios", "cgluda", "eecesar","cdalegre", "ejcemata", "jabportillo", "dgayac", "dmsantos", "hmmendoza", "tjqpasicolan", "smdumagat", "cbasco", "aayambot", "mdgloria", "jlcvalero", "rdalvarez", "gmrance"];
            if ($_SESSION['department'] == 1 || $_SESSION['position'] == "BM" || $_SESSION['username'] == 'jalvarez' || in_array($_SESSION['bankposition'], $targetPosition) || in_array($_SESSION['username'], $targetUser )) {
        // if($_SESSION['department'] == 1){
          ?>
        <div id="collapseLUC" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="loanCustomer.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>
        <?php } ?>

        <div id="collapsePipe" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="pipeline2.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>

        <?php
        if($_SESSION['department'] == 1 || $_SESSION['department'] == 6  || $_SESSION['position'] == 'BM' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'lkescano'
          || $_SESSION['username'] == 'eecesar' || $_SESSION['username'] == 'cgluda' || $_SESSION['username'] == 'hriegodedios' || $_SESSION['username'] == 'dgayac'  || $_SESSION['username'] == "aayambot"
          || $_SESSION['username'] == 'hmmendoza' || $_SESSION['username'] == 'tjqpasicolan' || $_SESSION['username'] == "cbasco" || $_SESSION['username'] == "dmsantos" || $_SESSION['username'] == "jabportillo"
          || $_SESSION['username'] == 'jlcvalero' ){
          ?>
          <div id="collapseDue" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <embed src="dueCollection.php" type="text/html" width='100%' height='1885px'>
            </div>
          </div>
        <?php
        }
        if($_SESSION['department'] == 1 || $_SESSION['department'] == 6  || $_SESSION['position'] == 'BM' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'lkescano' || $_SESSION['username'] == 'cbasco'
        || $_SESSION['username'] == 'cbasco' || $_SESSION['username'] == 'aayambot'){
          ?>
          <div id="collapseDueReport" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <embed src="dueReport.php" type="text/html" width='100%' height='1885px'>
            </div>
          </div>
          <div id="collapseCMSReport" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <embed src="dueCollection-Micro-Report.php" type="text/html" width='100%' height='1885px'>
            </div>
          </div>
          <div id="collapseLMSReport" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <embed src="lms-micro-report.php" type="text/html" width='100%' height='1885px'>
            </div>
          </div>
          <div id="collapseDocReport" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <embed src="loan-over-all-branches.php" type="text/html" width='100%' height='1885px'>
            </div>
          </div>
        <!-- END OF LOAN -->
        <?php } if($_SESSION['position'] == 'BM'){
          echo '<div id="collapseDueReportBM" class="collapse" data-parent="#accordionExample">
                  <div class="card-body">
                    <embed src="dueReportBM.php" type="text/html" width="100%" height="1885px">
                  </div>
                </div>';
          }?>

        <?php
        if($_SESSION['username'] == 'lkescano' || $_SESSION['username'] == 'jalvarez' || $_SESSION['username'] == 'relievergm'){
          ?>
        <!-- if BM/HEAD is absent and Cashier Requesting for IT Support Approval -->
        <div id="collapseReqtoGM" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="requestRequestGMSuppApproval.php" type="text/html" width='100%' height='1885px'>
          </div>
        </div>
        <?php } ?>
        <!-- END -->
      
        <!-- if BM/HEAD Request for IT Support -->
        <div id="collapseReqtoJCV" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='requestRequestSuppApproval.php' width='100%' height='1885px'></object> -->
            <embed src="requestRequestSuppApproval.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="requestRequestSuppApproval.php" frameborder="0"  width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!-- END of BM/HEAD Request for IT Support -->
        
        <!-- BM Request Support Approval -->
        <div id="collapseBMApproval" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <!-- <object data='requestRequestHeadSuppApproval.php' width='100%' height='1885px'></object> -->
            <embed src="requestpartHead.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="requestpartHead.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!-- END of BM Request Support Approval -->

        <!-- IT Request -->
        <div id="collapseITApproval" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <!-- <object data='requestpartITFormTable.php' width='100%' height='1885px'></object> -->
            <embed src="requestpartITFormTable.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="requestpartITFormTable.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!-- END IT Request -->

        <!-- IT Report -->
        <div id="collapseITReport" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <embed src="requestITReport.php" type="text/html" width='100%' height='1885px'>
            <!-- <object data='requestITReport.php' width='100%' height='1885px'></object> -->
            <!-- <iframe src="requestITReport.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!--  End of IT Report -->
        <!-- Head Approval -->
        <div id="collapseheadApproval" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <!-- <object data='leaveReqApproval.php' width='100%' height='1885px'></object> -->
            <embed src="leaveReqApproval.php" type="text/html" width='100%' height='1885px'>
            <!-- <iframe src="leaveReqApproval.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!-- End of Leave Approval -->

        <!-- Compliance Corner -->
        <div id="collapseCC" name="collapseCC" class="collapse" data-parent="#accordionExample">
          <div class="card-body" overflow='hidden'>
            <!-- <object data='complianceCorner2.php' width='100%' height='1885px'></object> -->
            <embed src="complianceCorner2.php" type="text/html" width='100%' height='1700px'>
            <!-- <iframe src="complianceCorner2.php" frameborder="0" width='100%' height='1885px'></iframe> -->
          </div>
        </div>
        <!-- End of Compliance -->

        <!-- Treasury Corner -->
        <div id="TB" name="TB" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="tTreasuryBill.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>
        <div id="TD" name="TD" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="tTimeDeposit.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>
        <div id="BSPDDA" name="BSPDDA" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="thankYou.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>
        <div id="TDReport" name="TDReport" class="collapse" data-parent="#accordionExample">
          <div class="card-body">
            <embed src="tTimeDepositReport.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>
        <div id="TBReport" name="TBReport" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="tTreasureBillReport.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>

        <div id="bsp" name="bsp" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="bsp.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>

        <div id="collapseProfile" name="collapseProfile" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="profile.php" type="text/html" width='100%' height='1500px'>
          </div>
        </div>

        <div id="calculator" name="calculator" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <embed src="calculator.php" type="text/html" width='100%' height='1700px'>
          </div>
        </div>
        <!-- Video -->
          <!-- <div id="collapse4anniv" class="collapse" data-parent="#accordionExample">
            <div class="card-body">
              <iframe src="video/4anniv.mp4" frameborder="0" width="100%" height="970px" id="annivIframe" name="video"></iframe>
            </div>
          </div>  -->
          <!-- <div id="collapseAlvarez" class="collapse" data-parent="#accordionExample">
            <div class="card-body" overflow='hidden'>
              <iframe src="showVideo2.php" frameborder="0" width='100%' height='1000px'></iframe>
            </div>
          </div> 
          <div id="collapseArpon" class="collapse" data-parent="#accordionExample">
            <div class="card-body" overflow='hidden'>
              <iframe src="showVideo3.php" frameborder="0" width='100%' height='1000px'></iframe>
            </div>
          </div>  -->
        <!-- end of Video -->
        <!-- INVENTORY -->
        <div id="collapseInventorytab" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <div class="inv">
                <embed src="inventory.php" type="text/html" width='100%' height='1700px'>
            </div>
          </div>
        </div> 
        <!-- END OF INVENTORY -->

        <div id="collapseDisposalReqForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <div class="inv">
                <embed src="ffeDisposalRequestForm.php" type="text/html" width='100%' height='1700px'>
            </div>
          </div>
        </div> 

        <div id="collapseDisposalRevForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <div class="inv">
                <embed src="ffeDisposalReviewForm.php" type="text/html" width='100%' height='1700px'>
            </div>
          </div>
        </div> 

        <div id="collapseDisposalBidForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <div class="inv">
                <embed src="ffeDisposalBiddingForm.php" type="text/html" width='100%' height='1700px'>
            </div>
          </div>
        </div> 

        <div id="collapseDisposalAppForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <div class="inv">
                <embed src="ffeDisposalApproveForm.php" type="text/html" width='100%' height='1700px'>
            </div>
          </div>
        </div> 

        <div id="collapseDisposalStatusForm" class="collapse" data-parent="#accordionExample">
          <div class="card-body" >
            <div class="inv">
                <embed src="ffeDisposalTable.php" type="text/html" width='100%' height='1700px'>
            </div>
          </div>
        </div> 

        <?php 
        }else{
          echo '<div id="bsp" name="bsp" class="collapse" data-parent="#accordionExample">
                  <div class="card-body" >
                    <embed src="bsp.php" type="text/html" width="100%"" height="1700px">
                  </div>
                </div>';
        }?>

      </div><!-- Accordion END -->

    </div><!-- Main Col END -->

  </div><!-- body-row END -->

<!-- CHATBOX -->
<?php 
// if($_SESSION['department'] == '1' || $_SESSION['department'] == '2'){ 
?>

<section id="wait"  class="sticky-chat">
  <div class="header">
    <?php 
    $notif2 = "SELECT * FROM `chatbox` WHERE notif = 2 AND receiver = '" . $_SESSION['userid']. "'";
    $queryNotif2 = mysqli_query($con, $notif2);
    $rowNotif2 = mysqli_num_rows($queryNotif2);
    if($rowNotif2 >= 1){ ?>
      <span id="messageNotif2" class="notify2" style="margin-top: -0.8rem; border-radius: 5px; color: white;"></span>
    <?php }else{ ?>
      <span id="messageNotif2" class="notify2" style="margin-top: -0.8rem; border-radius: 5px; color: white;"></span>
    <?php
    }
    ?>
    <span class="fa-solid fa-envelope notify" id="reqIcon2" style="margin-top: -0.5rem; color: #C0C0C0;"></span>

    <?php
    $notif = "SELECT * FROM `chatbox` WHERE receiver = '" . $_SESSION['userid'] . "' AND `text1` LIKE '%" . mysqli_real_escape_string($con, $_SESSION['fullname']) . "%' AND notif = 2 AND groupby = 'Public'";
    $queryNotif = mysqli_query($con, $notif);
    $rowNotif = mysqli_num_rows($queryNotif);

    if($rowNotif >= 1){ ?>
      <span id="messageNotif" class="notify" style="margin-top: -0.8rem; border-radius: 5px; color: white;"></span>
    <?php }else{ ?>
      <span id="messageNotif" class="notify" style="margin-top: -0.8rem; border-radius: 5px; color: white;"></span>
    <?php
    }
    ?>
    <span class="fa-solid fa-bell notify2" id="reqIcon2" style="margin-top: -0.5rem; color: #C0C0C0;"></span>
    <span id="header-text"><strong>OUR Bank Chat</strong>
      <!-- <span style="color: lightgreen; font-size: 0.8em;">
        ✨ New Feature
      </span> -->
    </span>
      <i class="fa-solid fa-window-minimize" id="window-minimize" style="float: right; cursor: pointer; margin-top: -0.77rem; position: relative; color: #C0C0C0;"></i></strong>
    <br>
  </div>
  <div class="chatbox-cons">
    <div id="suggestions"></div>

      <div class="chat-container"><br>
        <form id="chatbox" class="chat-form" method="post">
              <select class="form-control chat-ppl" name="personn" id="personn">
                  <option value="" hidden>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Inbox</option>
                  <option value="0" selected>Public</option>
                  <?php
                  if($_SESSION['department'] == 1){ 
                  echo 
                    '
                      <option value="group-it">IT</option>
                    ';
                  }
                  ?>

                  <?php 
                  if($_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'cdalegre' || $_SESSION['username'] == 'jalvarez' || $_SESSION['position'] == 'BM') {
                    echo 
                      '
                        <option value="group-bm">BM</option>
                      ';
                  }
                  ?>

                  <?php 
                  if($_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'cdalegre' || $_SESSION['username'] == 'jalvarez' || $_SESSION['position'] == 'BM' || $_SESSION['bankposition'] == 'Branch Cashier'
                    || $_SESSION['bankposition'] == 'Teller') {
                    echo 
                      '
                        <option value="group-casa">CASA</option>
                      ';
                  }
                  ?>

                  <?php 
                  if($_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'cdalegre' || $_SESSION['username'] == 'jalvarez' || $_SESSION['bankposition'] == 'Branch Cashier') {
                    echo 
                      '
                        <option value="group-cashier">Cashier</option>
                      ';
                  }
                  ?>

                  <?php 
                  if($_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'cdalegre' || $_SESSION['username'] == 'jalvarez' || $_SESSION['position'] == 'Head') {
                    echo 
                      '
                        <option value="group-dp">Department Head</option>
                      ';
                  }
                  ?>

                  <?php 
                  if($_SESSION['username'] == 'jcvillanueva' || $_SESSION['username'] == 'cdalegre' || $_SESSION['username'] == 'jalvarez' || $_SESSION['position'] == 'Teller') {
                    echo 
                      '
                        <option value="group-teller">Teller</option>
                      ';
                  }
                  ?>
                  <option value="xxx" disabled>------------------------------------------</option>

                  <?php
                  $mySessionId = $_SESSION['userid'];
                  // $targetIDs = [$mySessionId, 68, 71, 100, 81, 82, 83, 90, 14, 7, 103, 92, 94, 95, 96, 104, 105, 91, 87, 72, 99, 79, 26, 16, 34, 50, 40, 39, 69, 64];

                  // Create a comma-separated string
                  // $idsList = implode(',', $targetIDs);


                  $sNames = "SELECT userId, fullName FROM accounts WHERE stats <> 1 AND userId <> $mySessionId ORDER BY fullName";
                  $qNames = mysqli_query($con, $sNames);
                  while ($row = mysqli_fetch_assoc($qNames)) { 
                    $userId = $row['userId'];
                    $fullName = $row['fullName'];
                    // $targetID = [68, 71, 100, 81, 82, 83, 90, 14, 7, 103, 92, 94, 95, 96, 104, 105, 91, 87, 72, 99, 79, 26, 16, 34, 50, 40, 39, 69, 64];
                    // if($userId !== '' && !in_array($userId, $targetID)) {
                        echo '<option value="' . $userId . '">' . $fullName . '</option>';
                    // }
                }
                  ?>

              </select>
              <br>
              <div class="col-auto">
                <input hidden type="text" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" id="name" name="name">
              </div>
              &nbsp;
              <div class="col-auto">
                <input type="text" class="form-control chat-input" id="chat1" name="chat1" placeholder="Type your message here...">
              </div>&nbsp;
              <button type="submit" id="submit" name="submit" class="btn btn-info chat-submit">Send</ion-icon></button>
        </form>
  
            <div id="chat-container2"></div>
      </div>
  </div>
</section>
<?php
//  } 
 ?>
  <!-- END OF CHATBOX -->

  <!-- CDN Scripts for payslip generation (currently disabled) -->
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script>
  if(typeof jQuery == 'undefined') {
      document.write('<script src="js/jQuery-library1132.min.js"><\/script>');
  }
  </script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script> -->

    <!-- FOR DROP DOWN OF SIDE NAVBAR -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
  <script>
  if(typeof jQuery == 'undefined') {
      document.write('<script src="js/bootstrap.bundle.min.js"><\/script>');
  }
  </script>

    <!-- FOR Table Inventory -->
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <!-- FOR ICONS -->
  <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
  <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
  
   <!-- CUSTOM SCRIPT FOR SIDE NAVBAR ANIMATION -->
   <script src="./js/dashboard.js"></script>
   <script src="js/getNames.js"></script>
   <script src="js/notify.js"></script>

  <script>
    function refreshCNotif() {

    // Use AJAX to fetch new messages
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("calendarNotif").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "fetch_calendar_notif.php", true);
    xhttp.send();
    }

    // Call refreshNotif function every 1 second
    setInterval(refreshCNotif, 3000);
  </script>

  <script>
  $(document).ready(function () {
    $(".chatbox-cons").hide();

    function scrollToBottomm() {
      const chatContainer = document.querySelector('.chat-container2');
      if (chatContainer) {
        chatContainer.scrollTop = chatContainer.scrollHeight;
      }
    }

    function scrollToBottom() {
      var $container = $('#chat-container2');
      $container.stop().animate({ scrollTop: $container[0].scrollHeight }, 300);
    }

    function scrollToBottom1() {
      var $chatbox = $(".chatbox-cons");
      $chatbox.stop().animate({ scrollTop: $chatbox[0].scrollHeight }, 300);
    }

    $("#window-minimize").click(function () {
      $(".chatbox-cons").toggle(function () {
        scrollToBottom1();
      });
    });

    $('#header-text').click(function () {
      $(".chatbox-cons").toggle(function () {
        scrollToBottom1();
      });
    });

    if ($(".chatbox-cons").is(":visible")) {
      scrollToBottom();
    }

    let isUserNearBottom = true;

    // Track scroll position
    $('#chat-container2').on('scroll', function () {
      var $this = $(this);
      var scrollTop = $this.scrollTop();
      var scrollHeight = $this[0].scrollHeight;
      var clientHeight = $this.outerHeight();

      // if user is near the bottom (within 50px), allow auto-scroll
      isUserNearBottom = (scrollTop + clientHeight + 50) >= scrollHeight;
    });

    function fetchAndUpdateChat() {
      var text = $('#personn').val();
      $.ajax({
        url: "fetch_message.php",
        data: { userId: text },
        type: 'post',
        success: function (response) {
          $('#chat-container2').html(response);

          if (isUserNearBottom) {
            scrollToBottom();
          }
        },
        error: function (xhr, status, error) {
          console.error('Error fetching message:', error);
        }
      });
    }


    $('#chatbox').submit(function(event){
      event.preventDefault();
      var text1 = $('#chat1').val();
      var person = $('#personn').val();
      var newForm = new FormData(this);

      if (text1 !== "") {
        $.ajax({
          url: "bspchatbox.php",
          type: "post",
          data: newForm,
          contentType: false,
          processData: false,
          success: function(data) {
            $('#chat1').val('');

            // 🔥 Allow scroll again after sending
            isUserNearBottom = true;

            // 🔥 Optional: immediate scroll after sending
            scrollToBottom();
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          }
        });
      } else {
        return false;
      }
    });

    fetchAndUpdateChat();
    setInterval(fetchAndUpdateChat, 500);

    // ✅ Handle notify click to open chatbox and clear input

    $('#notify-msg').click(function () {
      $('#personn').val('');              // Clear field
      $(".chatbox-cons").show();          // Show chatbox

      // Scroll to .highlighted if it exists, else scroll to top
      const $container = $(".chatbox-cons");
      const $highlight = $container.find(".highlighted");

      if ($highlight.length) {
          // Scroll so that .highlighted is visible
          $container.animate({
              scrollTop: $highlight.position().top + $container.scrollTop()
          }, 300);
      } else {
          // Scroll to top
          $container.animate({ scrollTop: 0 }, 300);
      }

      $(this).hide(); // Hide notify message
    });


    
    
  });
</script>


<script>
$('#personn').on('change', function () {
  const selectedValue = $(this).val();
  const validGroups = ['group-it', 'group-bm', 'group-casa', 'group-cashier', 'group-teller', 'group-heads'];

  if (validGroups.includes(selectedValue)) {
    $.ajax({
      url: 'bspchat-updateNotif.php',
      method: 'POST',
      data: { group: selectedValue },
      success: function (response) {
        isUserNearBottom = true; // Optional scroll flag
        scrollToBottomm();        // Scroll after notif update
        console.log('Notification updated:', response);
      },
      error: function () {
        console.error('Failed to update notif');
      }
    });
  }

  // 🔥 Always scroll chatbox to bottom on change
  scrollToBottomm();
});
</script>

<script>
</script>
  

<script>
$('.notify2').click(function(){
  $('#personn').val('0');
});
</script>

<script>
function refreshNotif() {

  // Use AJAX to fetch new messages
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("messageNotif").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "fetch_notif.php", true);
  xhttp.send();
}

// Call refreshNotif function every 1 second
setInterval(refreshNotif, 1000);
</script>

<script>
  //chatbox
function refreshNotif2() {
  // Use AJAX to fetch new messages
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("messageNotif2").innerHTML = this.responseText;
      // document.getElementById("messageNotif3").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "fetch_notif2.php", true);
  xhttp.send();
}
// Call refreshNotif function every 1 second
setInterval(refreshNotif2, 1000);
</script>

<script>
  // $('#chatbox').submit(function(event){
  //   event.preventDefault();
  //   var text1 = $('#chat1').val();
  //   var person = $('#personn').val();
  //   var newForm = new FormData(this);

  //   if (text1 !== "") {
  //     $.ajax({
  //       url: "bspchatbox.php",
  //       type: "post",
  //       data: newForm,
  //       contentType: false,
  //       processData: false,
  //       success: function(data) {
  //         $('#chat1').val('');

  //         // 🔥 Allow scroll again after sending
  //         isUserNearBottom = true;

  //         // 🔥 Optional: immediate scroll after sending
  //         scrollToBottom();
  //       },
  //       error: function(xhr, status, error) {
  //         var err = eval("(" + xhr.responseText + ")");
  //         alert(err.Message);
  //       }
  //     });
  //   } else {
  //     return false;
  //   }
  // });
</script>

<script>
  $(document).on('click', '.message-click', function () {
    var messageId = $(this).data('id');

    $.ajax({
        url: 'bsp_update_seen.php',
        type: 'POST',
        data: { messageId: messageId },
        success: function(response) {
            console.log(response); // optional
        },
        error: function(xhr, status, error) {
            console.error("Update failed:", error);
        }
    });
  });
</script>


<script>
$('.chat-input').click(function(e) {
    const personnVal = $('#personn').val();

    $.ajax({
        url: 'bspNotifUpdater.php',
        type: 'post',
        data: {
            notif: 1,
            username: personnVal // will be '' if empty
        },
        success: function(response) {
            console.log("Notification updated successfully.");
        },
        error: function(xhr, status, error) {
            console.error("Error updating notification:", error);
        }
    });
});

$('#chat-container2').click(function(e) {
    const personnVal = $('#personn').val();

    $.ajax({
        url: 'bspNotifUpdater.php',
        type: 'post',
        data: {
            notif: 1,
            username: personnVal // will be '' if empty
        },
        success: function(response) {
            console.log("Notification updated successfully.");
        },
        error: function(xhr, status, error) {
            console.error("Error updating notification:", error);
        }
    });
});
</script>

<script>
function reply(username, text1) {
  $.ajax({
      url: 'fetch_fullname.php', 
      method: 'POST',
      data: { username: username },
      success: function(response) {
          var data = JSON.parse(response);
          var cleanedUsername = data.fullName.replace(/"/g, '');
          var userIdd = data.userId;
          var targetID = [68, 71, 100, 81, 82, 83, 90, 14, 7, 103, 92, 94, 95, 96, 104, 105, 91, 87, 72, 99, 79, 26, 16, 34, 50, 40, 39];
          if(!targetID.includes(userIdd)){
            // $('#chat1').val('@' + cleanedUsername + '');
            $('#chat1').val('')
            $('#personn').val(userIdd);
          }
      },
      error: function(xhr, status, error) {
          console.error('Error fetching full name:', error);
      }
  });
}


function openGroupChat(groupName) {
    // Convert "IT Group" → "it", "HR Group" → "hr", etc.
    var groupKey = groupName.toLowerCase().replace(/\s*group\s*/i, '').trim();
    var groupVal = 'group-' + groupKey;

    // Set the value to #personn
    $('#personn').val(groupVal);

    // Send AJAX to update notif = 1 where receiver = session user
    $.ajax({
        url: 'fetchGroupMessages.php',
        method: 'POST',
        data: { groupKey: groupVal },
        success: function (res) {
            console.log('Group notification updated:', res);
        },
        error: function (xhr, status, error) {
            console.error('Error updating group notification:', error);
        }
    });
}

</script>

   
  <script type="text/javascript">
    // click amlc
      // $('#complianceCC').on('click', function(){
      //   // alert("successclick");
      //   var values = {'recordUserId': document.getElementById('recordUserId').value,
      //                 'recordName': document.getElementById('recordName').value};
      //   $.ajax ({
      //     url: "recordAMLC.php",
      //     type: 'POST',
      //     data: values,
      //     success: function(data) {
      //     }
      //   });
      // });

    function btnPlay(){
      const videoEl = document.getElementById("media-video");
      var videoE1 = document.getElementById("media-video");
      // Will play the video
      if(videoE1.pause){
        videoEl.play(); 
      }
       // Will pause the video
      else{
        if(videoE1.play){
          videoEl.pause();
        }
      }
    }

    function btnPause(){
      const videoEl = document.getElementById("media-video");
      var videoE1 = document.getElementById("media-video");
      // Will play the video
      
      if(videoE1.play){
        videoEl.pause();
        
      }
       // Will pause the video
      else{
        if(videoE1.play){
          videoEl.pause();
        }
      }
    }
    
  </script>

<script>
  function createXHRRequest(url, elementId) {
    const xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function () {
      if (this.readyState === 4) {
        if (this.status === 200) {
          const el = document.getElementById(elementId);
          if (el) {
            el.innerHTML = this.responseText;
          }
        } else {
          console.error(`Error fetching ${url}: Status ${this.status}`);
        }
      }
    };

    xhttp.onerror = function () {
      console.error(`Request failed for ${url}`);
    };

    xhttp.open("GET", url, true);
    xhttp.send();
  }

  function setRefreshInterval(url, elementId, interval) {
    let isRequestRunning = false;

    setInterval(() => {
      // Prevent overlapping requests
      if (isRequestRunning) return;

      isRequestRunning = true;

      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function () {
        if (this.readyState === 4) {
          isRequestRunning = false;

          if (this.status === 200) {
            const el = document.getElementById(elementId);
            if (el) {
              el.innerHTML = this.responseText;
            }
          } else {
            console.error(`Error fetching ${url}: Status ${this.status}`);
          }
        }
      };

      xhttp.onerror = function () {
        isRequestRunning = false;
        console.error(`Request failed for ${url}`);
      };

      xhttp.open("GET", url, true);
      xhttp.send();

    }, interval);
  }

  // Define URLs and element IDs
  const notifications = [
    { url: "fetch_ITtab_Support.php", elementId: "notificationCount2" },
    { url: "fetch_ITtab2_Support.php", elementId: "notificationCount3" },
    { url: "fetch_ITJCV_Support.php", elementId: "notificationCount4" },
    { url: "fetch_ITGMs_Support.php", elementId: "notificationCount5" },
    { url: "fetch_ITtabHeads_Support.php", elementId: "notificationCount6" },
    { url: "fetch_leave_notif.php", elementId: "notificationCount7" }
  ];

  // Set refresh intervals
  notifications.forEach(notif => {
    setRefreshInterval(notif.url, notif.elementId, 3000);
  });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var myCarousel = document.querySelector('#carouselExampleIndicators');
    var carousel = new bootstrap.Carousel(myCarousel, {
        interval: false, // don't auto-cycle
        ride: false
    });

    // Play video when slide becomes active
    myCarousel.addEventListener('slid.bs.carousel', function (e) {
        // Pause all videos first
        myCarousel.querySelectorAll('video').forEach(v => v.pause());
        // Play video in active slide
        var activeVideo = e.relatedTarget.querySelector('video');
        if (activeVideo) activeVideo.play();
    });

    // Play first video on load if present
    var firstVideo = myCarousel.querySelector('.carousel-item.active video');
    if (firstVideo) firstVideo.play();
});
</script>

</body>
</html>