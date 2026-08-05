<?php
    include('connection.php');

    $tbody = "";

    $sql="SELECT * FROM pay_otherdeductions WHERE datedeleted = ''";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $tbody .= "<tr>";
            $tbody .= "<td>".$row["employeeId"]."</td>";
            $tbody .= "<td>".$row["name"]."</td>";
            $tbody .= "<td>".$row["position"]."</td>";
            $tbody .= "<td>".$row["branch"]."</td>";
            $tbody .= "<td>".$row["amount"]."</td>";
            $tbody .= "<td>".$row["date"]."</td>";
            $tbody .= "<td>".$row["remarks"]."</td>";
            $tbody .= "<td class='d-flex flex-row gap-3'>
            <a class='update' data-id='". $row['id'] ."'><i class='fa-lg fa-solid fa-pen'></i></a>
            <a class='delete-link' href='paydeletededuction.php?id=". $row['id'] . "'><i class=' fa-lg fa-solid fa-trash'></i></a>
            </td>"; 
            $tbody .= "</tr>";
        }
    } else {
        $tbody .= "<tr><td colspan='9'>No results found</td></tr>";
        
    }

    // You can then use $tbody wherever you need to output the table data in your HTML
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="devCiao">
        <meta name="description" content="A payslip for OUR Bank.">
        <link rel="icon" href="images/favicon.ico">

        <title>Online Payslip</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">

        <!-- jQuery UI CSS -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="templaemo-style.css">
    </head>
    <body>
            <!-- MODAL -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Modal Title</h4>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <p>This is the content of the modal.</p>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>
<!-- MODAL -->
    <a class="btn btn-secondary btn-md btnBack" href="pay-payanddeduct.php">Back</a>  
    <div class="container">
        <div class="d-flex justify-content-center align-items-center"><h3>Other Deduction</h3></div>
        <div class="d-flex flex-row gap-2 m-2">
        <div class="ms-auto"> <!-- Utilizing ms-auto (margin-left: auto) to push the button to the right -->
        <a class="otherpayment-link btn btn-primary">Add Other Deduction</a>
        </div>
    </div>

        <table class="table table-bordered">
            <thead>
                <th>ID</th>
                <th>Name</th>
                <th>Position</th>
                <th>Branch</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Remarks</th>
                <th>Function</th>
            </thead>
            <tbody>
                <?php echo $tbody; ?>
            <tbody>
        </table>
        <div class="pagination" id="pagination"></div>
    </div>
    </body>
<style>
.pagination {
display: inline-block;
float: right;
}

.pagination a {
color: black;
float: left;
padding: 8px 16px;
text-decoration: none;
transition: background-color .3s;
border: 1px solid #ddd;
margin: 0 4px;
}

.pagination a.active {
background-color: #0d6efd;
color: white;
border: 1px solid #0d6efd;
}

.pagination a:hover:not(.active) {background-color: #ddd;}

</style>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://kit.fontawesome.com/e924e7f226.js" crossorigin="anonymous"></script>

    </html>

<script>
$('.otherpayment-link').click(function(){
    var employeeId = $(this).data('id');
    $.ajax({
        url: "payotherdeductionform.php?id=" + employeeId,
        type: "post",
        data: {},
        success: function(data) {
            $(".modal-title").html('<div class="">Add Other Deduction</div>');
            $(".modal-footer").html('<font >OUR BANK</font>');
            $(".modal-body").html(data);
            $(".modal").modal('show');
        },
        error: function() {
            console.log();
            alert('Failed');
        }
    });
    
});

$('.update').click(function(){
    var id = $(this).data('id');
    $.ajax({
        url: "payupdatedeductform.php?id=" + id,
        type: "post",
        data: {},
        success: function(data) {
            $(".modal-title").html('<div class="">Add Other Payment</div>');
            $(".modal-footer").html('<font >OUR BANK</font>');
            $(".modal-body").html(data);
            $(".modal").modal('show');
        },
        error: function() {
            console.log();
            alert('Failed');
        }
    });
    
});

$(document).on('click', '[data-dismiss="modal"]', function() {
    $('.modal').modal('hide');
});

$('.delete-link').on('click', function(e) {
    e.preventDefault(); // Prevent the default link behavior
    var href = $(this).attr('href');
    if (confirm('Are you sure you want to delete this record?')) {
        window.location.href = href; // Proceed with deletion if confirmed
    }
});

</script>        

<script>
    var itemsPerPage = 10;
    var tbody = document.getElementsByTagName('tbody')[0];
    var items = tbody.getElementsByTagName('tr');
    var totalPages = Math.ceil(items.length / itemsPerPage);
    var currentPage = 1;

    function showPage(page) {
        var startIndex = (page - 1) * itemsPerPage;
        var endIndex = Math.min(startIndex + itemsPerPage, items.length);

        for (var i = 0; i < items.length; i++) {
            if (i >= startIndex && i < endIndex) {
                items[i].style.display = 'table-row';
            } else {
                items[i].style.display = 'none';
            }
        }
        currentPage = page;
        updatePaginationState();
    }

    function setupPagination() {
        var pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        var prevButton = document.createElement('a');
        prevButton.href = '#';
        prevButton.textContent = 'Prev';
        prevButton.onclick = function() {
            if (currentPage > 1) {
                showPage(currentPage - 1);
            }
            return false;
        };
        pagination.appendChild(prevButton);

        for (var i = 1; i <= totalPages; i++) {
            var link = document.createElement('a');
            link.href = '#';
            link.textContent = i;
            link.onclick = function() {
                showPage(parseInt(this.textContent));
                return false;
            };
            pagination.appendChild(link);
        }

        var nextButton = document.createElement('a');
        nextButton.href = '#';
        nextButton.textContent = 'Next';
        nextButton.onclick = function() {
            if (currentPage < totalPages) {
                showPage(currentPage + 1);
            }
            return false;
        };
        pagination.appendChild(nextButton);

        showPage(1);
    }

    function updatePaginationState() {
        var paginationLinks = document.getElementById('pagination').getElementsByTagName('a');
        for (var i = 0; i < paginationLinks.length; i++) {
            var link = paginationLinks[i];
            if (parseInt(link.textContent) === currentPage) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        }
    }

    setupPagination();
</script>