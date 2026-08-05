<?php
include('connection.php');
$userId = $_SESSION['userid'];
$userName = $_SESSION['userName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar Scheduler</title>
<!--   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="./css/bootstrap521.min.css">
    <link rel="stylesheet" href="./css/calendar.css">
</head>

<style>
    #editEventCreator {
        background-color: #F5FFFA;
    }

    #editEventTags {
        background-color: #F5FFFA;
        width: 100%;  /* Or use a specific width like 300px */
        height: 150px; /* Adjust the height as needed */
    }

    #editEventText {
        background-color: #F5FFFA;
        width: 100%;  /* Or use a specific width like 300px */
        height: 150px; /* Adjust the height as needed */
    }

    #editEventDate, #editEventTime {
        background-color: #F5FFFA;
    }

    .modal-dialog-centered {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: calc(100vh - 1rem); /* Ensures modal stays centered vertically */
    }

    .modal {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .time {
        font-weight: 500;
        font-size: 8.5px!important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .text{
        width: 100%;
        height: auto;
        font-weight: 600;
        border-radius: 10px!important;
        font-size: 12px!important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        text-transform: default;
    }

</style>
<body>

<input type="hidden" id="userId" value="<?php echo $userId; ?>">
<input type="hidden" id="username" value="<?php echo $userName; ?>">

<div class="mt-1">
<?php 
if($_SESSION['userid'] == 1 || $_SESSION['userid'] == 2 || $_SESSION['position'] == "GM" || $_SESSION['position'] == "AGM"){ ?>
    <button id="addEvent" class="btn btn-primary btn-sm ml-auto mb-3 justify-content-end d-flex float-end d-none" disabled>Add Event</button>
<?php } 
?>
        <div class="calendar card">
            <div class="header card-header d-flex justify-content-between align-items-center">
                <button id="prevMonth" class="btn btn-secondary btn-sm">&laquo; Previous</button>
                <h2 id="monthYear" class=""></h2>
                <button id="nextMonth" class="btn btn-secondary btn-sm">Next &raquo;</button>
                
            </div>
            <div class="weekdays">
                <div style="color: red;">Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div style="color: red;">Sat</div>
            </div>
            <div id="calendarDays" class="days"></div>
            </div>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div class="modal" id="eventModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add Event</h4>
                    <button type="button" class="close" id="closeModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 d-flex position-relative">
                        <div class="col-md-6 px-1">
                            <div class="form-floating">
                                <input type="date" id="eventDate" name="eventDate" class="form-control mb-3" placeholder="Select Date">
                                <label for="eventDate">Select Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="time" id="eventTime" name="eventTime" class="form-control mb-3" placeholder="Select Time">
                                <label for="eventTime">Select Time</label>
                            </div>
                        </div>
                    </div>
                    <div id="suggestions"></div>
                    <div class="form-floating">
                        <input type="text" name="tagg" id="tagg" class="form-control mb-3" placeholder="Tag Employee: Ex. @Juan Dela Cruz">
                        <label for="tagg" style="color: gray;">Tag Employee: Ex. @Juan Dela Cruz</label>
                    </div>
                    <div class="form-floating">
                        <textarea id="eventText" class="form-control" placeholder="Event details"></textarea>
                        <label for="eventText" style="color: gray;">Event details</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="saveEvent" class="btn btn-success">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Display Event Modal -->
    <div class="modal" id="displayModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Event Details</h4>

                    <?php 
                    // $calenderSelect = "SELECT * FROM duecalendar WHERE calendar_sender <> '" . $_SESSION['userid'] . "' ";
                    // $calendarQry = mysqli_query($con, $calenderSelect);
                    
                    // while($dataC = mysqli_fetch_assoc($calendarQry)) { 
                    //     $calendarId = $dataC['calendar_userName'];
                    // }
                    ?>
                <!-- <label for="">Created by: <?php echo $calendarId; ?> </label> -->

                    <button type="button" class="close" id="closeDisplayModal" >&times;</button>
                </div>

                <div class="col-md-12 d-flex py-2 float-center position-relative justify-content-center">

                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="eventDetails" id="eventDetails">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 justfity-content-end" id="actionD"> -->
                       <!-- <label for="">TEST</label> -->
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Edit Event Modal -->
    <div class="modal" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-center modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalCenterTitle">View Event</h4>
                    <button type="button" class="close" id="closeEditModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-floating">
                        <input type="text" id="editEventCreator" name="editEventCreator" class="form-control mb-3" readonly>
                        <label for="editEventCreator">Event Creator</label>
                    </div>
                    <div class="col-md-12 d-flex position-relative">
                        <div class="col-md-6 px-1">
                            <div class="form-floating">
                                <input type="date" id="editEventDate" name="editEventDate" class="form-control mb-3" placeholder="Select Date" readonly>
                                <label for="editEventDate">Select Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="time" id="editEventTime" name="editEventTime" class="form-control mb-3" placeholder="Select Time" readonly>
                                <label for="editEventTime">Select Time</label>
                            </div>
                        </div>
                    </div>
                    <div id="suggestions2"></div>
                    <div class="form-floating">
                        <textarea cols="50" rows="5" type="text" name="editEventTags" id="editEventTags" class="form-control mb-3" placeholder="Tag Employee: Ex. @Juan Dela Cruz" readonly></textarea>
                        <label for="editEventTags" style="color: gray;">Tag Employee: Ex. @Juan Dela Cruz</label>
                    </div>
                    <div class="form-floating">
                        <textarea id="editEventText" class="form-control" placeholder="Event details" readonly></textarea>
                        <label for="editEventText" style="color: gray;">Event details</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="saveEdit" class="btn btn-success" disabled hidden>View Only</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
    if(typeof jQuery == 'undefined') {
        document.write('<script src="js/jquery-3.6.0.min.js"><\/script>');
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
    crossorigin="anonymous"></script>
    <script>
    if(typeof jQuery == 'undefined') {
        document.write('<script src="js/popper2116.min.js"><\/script>');
    }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
    crossorigin="anonymous"></script>
    <script>
    if(typeof jQuery == 'undefined') {
        document.write('<script src="js/bootstrap.bundle521.min.js"><\/script>');
    }
    </script>
    <script src="./js/allCalendar.js"></script>
    <script src="./js/calendarGetNames.js"></script>
    <script src="./js/calendarGetNames2.js"></script>

    <!-- <script>
        // Function to add a red dot to specific dates
        function addRedDotToDate(date) {
            var dayElements = document.querySelectorAll('.day');
            dayElements.forEach(function(dayElement) {
                var dayNumber = parseInt(dayElement.textContent.trim());
                if (dayNumber === date) {
                    var redDot = document.createElement('span');
                    redDot.className = 'redDot';
                    dayElement.appendChild(redDot);
                }
            });
        }

        // Example usage: Add a red dot to the 15th day
        // addRedDotToDate(15);
    </script> -->

    <script>
    // $(document).ready(function() {
        // $(document).on('click', '.close', function(e) {
            // e.preventDefault();
            // var hiddenId = $(this).val();
            // alert(hiddenId);
            // $.ajax({
            //     url: 'calendarNotifUpdater.php',
            //     type: "post",
            //     data: { hiddenId: hiddenId },
            //     success: function(data){
            //         console.log('Successfully Cleared Notif');
            //     }
            // });
    //     });
    // });

        
    </script>

</body>
</html>
