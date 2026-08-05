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
  
    <link rel="stylesheet" href="./css/bootstrap521.min.css">
    <link rel="stylesheet" href="./css/calendar.css">
</head>

<style>
.red-dot {
    width: 8px;
    height: 8px;
    background-color: red;
    border-radius: 50%;
    margin-left: 5px;
    display: inline-block;
    vertical-align: middle;
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

.displayTime{
    font-size: 12px!important;
}
</style>
<body>

<input type="hidden" id="userId" value="<?php echo $userId; ?>">
<input type="hidden" id="username" value="<?php echo $userName; ?>">

<div class="mt-1">
<?php 
// if($_SESSION['position'] == "Head" || $_SESSION['position'] == "BM" || $_SESSION['position'] == "Head" || $_SESSION['position'] == "GM" || $_SESSION['position'] == "AGM"){ ?>
    <button id="addEvent" class="btn btn-primary btn-sm ml-auto mb-3 justify-content-end d-flex float-end">Add Event</button>
<?php //} ?>
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

    <?php 
        $bm = [
                '@Ritchie L. Arcilla', '@Melody Ruazol', '@Karen Dianne Dampitan', 
                '@Joan Reduca', 'Ednalyn S. Paraiso', '@Jennifer B. Giron'
              ];
        $dp = [
                '@Julius C. Villanueva', '@Christine Diane Alegre', '@Monica D. Gloria',
                '@Jonathan Quijano', '@Mark Chester Rivera', '@Mary Ann J. Luna',
                '@Irene R. Milano', '@Cherissa D. Basco', '@Luisito Verder'
              ];
        $marketing = [
                        '@Shane M. Dumagat', '@Tom Julius Q. Pasicolan', '@Judy Ann B. Portillo',
                        '@Julio R. Paraino Jr.', '@Dencel Mae Santos', '@Dynder Gayac', '@Harvey M. Mendoza'
                     ];

    ?>

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
                        <div class="col-md-12 px-1">
                            <div class="form-floating">
                                <input type="date" id="eventDate" name="eventDate" class="form-control mb-3" placeholder="Select Date" required>
                                <label for="eventDate">Select Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex position-relative">
                        <div class="col-md-6 px-1">
                            <div class="form-floating">
                                <input type="time" id="eventTime" name="eventTime" class="form-control mb-3" placeholder="Select Time" required>
                                <label for="eventTime">Select Time From</label>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-floating">
                                <input type="time" id="eventTimeTo" name="eventTimeTo" class="form-control mb-3" placeholder="Select Time">
                                <label for="eventTimeTo">Select Time To</label>
                            </div>
                        </div>
                    </div>
                    <div id="suggestions"></div>
                    <div class="form-floating">
                        <textarea type="text" name="tagg" id="tagg" class="form-control mb-3" placeholder="Tag Employee: Ex. @Juan Dela Cruz"></textarea>
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
    <div class="modal bd-display-modal-xl" id="displayModal">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Event Details</h4>

                    <?php 
                    // $calenderSelect = "SELECT id FROM duecalendar WHERE calendar_receiver = '" . $_SESSION['userid'] . "' ";
                    // $calendarQry = mysqli_query($con, $calenderSelect);

                    // while($dataC = mysqli_fetch_assoc($calendarQry)) { 
                    //     $calendarId = $dataC['id'];
                    // }
                    ?>
                    
                     <button type="button" class="close" id="closeDisplayModal" >&times;</button>

                </div>
                <div class="col-md-12 d-flex py-2 float-center position-relative justify-content-center">
                    <div class="modal-body"></div>
                    <div class="col-md-12">
                        <div class="eventDetails" id="eventDetails">
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
    <div class="modal" id="editModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Edit Event</h4>
                    <button type="button" class="close" id="closeEditModal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12 d-flex position-relative">
                        <div class="col-md-12 px-1">
                            <div class="form-floating">
                                <input type="date" id="editEventDate" name="editEventDate" class="form-control mb-3" placeholder="Select Date">
                                <label for="editEventDate">Select Date</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex position-relative">
                        <div class="col-md-6 px-1">
                            <div class="form-floating">
                                <input type="time" id="editEventTime" name="editEventTime" class="form-control mb-3" placeholder="Select Time">
                                <label for="editEventTime">Select Time From</label>
                            </div>
                        </div>
                        <div class="col-md-6 px-1">
                            <div class="form-floating">
                                <input type="time" id="editEventTimeTo" name="editEventTimeTo" class="form-control mb-3" placeholder="Select Time">
                                <label for="editEventTimeTo">Select Time To</label>
                            </div>
                        </div>
                    </div>
                    <div id="suggestions2"></div>
                    <div class="form-floating">
                        <textarea style="" type="text" name="editEventTags" id="editEventTags" class="form-control mb-3" placeholder="Tag Employee: Ex. @Juan Dela Cruz"></textarea>
                        <label for="editEventTags" style="color: gray;">Tag Employee: Ex. @Juan Dela Cruz</label>
                    </div>
                    <div class="form-floating">
                        <textarea id="editEventText" class="form-control" placeholder="Event details"></textarea>
                        <label for="editEventText" style="color: gray;">Event details</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="deleteEdit" class="btn btn-danger">Delete</button>
                    <button id="saveEdit" class="btn btn-success">Save</button>
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
    <script src="./js/calendar.js"></script>
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

    <script>
    const groups = {
            BM: <?php echo json_encode($bm); ?>,
            DH: <?php echo json_encode($dp); ?>,
            MD: <?php echo json_encode($marketing); ?>
            };
    const taggInput = document.getElementById('tagg');

    let addedGroups = new Set();

    taggInput.addEventListener('input', function () {
        const inputText = this.value.trim();

        for (const [groupCode, members] of Object.entries(groups)) {
            if(inputText.toUpperCase().includes(groupCode)) {
                //  && !addedGroups.has(groupCode) add this after groupCode if you want to be not repeated.
                this.value = inputText.replace(groupCode, members.join(', ') + ', ');

                addedGroups.add(groupCode);
            }
        }
    });

    const editTaggInput = document.getElementById('editEventTags');


    editTaggInput.addEventListener('input', function () {
        const inputText = this.value.trim();

        for (const [groupCode, members] of Object.entries(groups)) {
            if(inputText.toUpperCase().includes(groupCode)) {
                //  && !addedGroups.has(groupCode) add this after groupCode if you want to be not repeated.
                this.value = inputText.replace(groupCode, members.join(', ') + ', ');

                addedGroups.add(groupCode);
            }
        }
    });
    </script>

</body>
</html>
