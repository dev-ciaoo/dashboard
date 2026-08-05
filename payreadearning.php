    <?php
    include('connection.php');

    // Initialize the variable for table body
    $tbody = "";
   
    $currentDate = date("Y-m-d");
    
        // Check if the search query is submitted
        if(isset($_POST['query'])) {
            // Get the search query
            $query = '%' . $_POST['query'] . '%';
            $branch = $_POST['branch'];
            $emptyDate = '';
        
            // Convert the search query to lowercase
            $query = strtolower($query);
        
            // Convert the address value to lowercase in the query
            $stmt = $con->prepare("SELECT pe.*, acc.* FROM accounts acc
                    LEFT JOIN (
                        SELECT pe.*
                        FROM pay_earnings pe
                        INNER JOIN (
                            SELECT employeeId, MAX(id) AS max_id
                            FROM pay_earnings
                            GROUP BY employeeId
                        ) max_pe ON pe.employeeId = max_pe.employeeId AND pe.id = max_pe.max_id
                    ) pe ON pe.employeeId = acc.employeeId AND pe.datedeleted = ?
                    WHERE LOWER(acc.fullName) LIKE ? AND LOWER(acc.address) = ? ORDER BY pe.id DESC");
            $stmt->bind_param("sss", $emptyDate, $query, $branch);
            $stmt->execute();
            $searchResult = $stmt->get_result();

            if (!$searchResult) {
                // Handle query error
                die("Error: " . $con->error);
            }
            $tbody ="";
            // Populate table body with search results
            if ($searchResult->num_rows > 0) {
                while ($row = $searchResult->fetch_assoc()) {
                    $tbody .= "<tr>";
                    $tbody .= "<td>". $row['employeeId'] ."</td>";
                    $boldFullName = str_replace($_POST['query'], '<strong>'.$_POST['query'].'</strong>', $row['fullName']);
                    $tbody .= "<td>".  $boldFullName ."</td>"; 
                    $tbody .= "<td>". $row['bankPosition'] ."</td>"; 
                    $tbody .= "<td>". $row['address'] ."</td>"; 
                    $tbody .= "<td>". ($row['MonthlySalary']) ."</td>"; 
                    $tbody .= "<td>". ($row['RiceAllowance']) ."</td>"; 
                    $tbody .= "<td>". ($row['TranspoAllowance']) ."</td>"; 
                    $tbody .= "<td>". ($row['sss']) ."</td>"; 
                    $tbody .= "<td>". ($row['sssmandprovident']) ."</td>";
                    $tbody .= "<td>". ($row['pagibig'])     ."</td>"; 
                    $tbody .= "<td>". ($row['philhealth']) ."</td>";  
                    $tbody .= "<td>". ($row['withholdingtax']) ."</td>"; 
                    $tbody .= "<td>". ($row['sssloan']) ."</td>";  
                    $tbody .= "<td>". ($row['ssscalamity']) ."</td>"; 
                    $tbody .= "<td>". ($row['pagibigloan']) ."</td>"; 
                    $tbody .= "<td>". ($row['pagibigcalamity']) ."</td>"; 
                    $tbody .= "<td>". ($row['salaryloan']) ."</td>"; 
                    $tbody .= "<td class='d-flex flex-row gap-3'>
                                <a class='view' data-id='". $row['employeeId'] ."'><i class='fa-lg fa-solid fa-eye'></i></a>
                                <a class='update' data-id='". $row['employeeId'] ."'><i class='fa-lg fa-solid fa-pen'></i></a>
                                <a class='delete-link' href='paydelete.php?id=". $row['employeeId'] . "'><i class=' fa-lg fa-solid fa-trash'></i></a>
                            </td>"; 
                    $tbody .= "</tr>";
                }
            } else {
                // No results found
                $tbody .= "<tr><td colspan='6'>No results found</td></tr>";
            }
        }
    ?>

<table id="searchResults"  class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Position</th>
            <th>Branch</th>
            <th>Monthly Salary</th>
            <th>Rice Allowance</th>
            <th>Transpo Allowance</th>
            <th style="color: red;">SSS</th>
            <th style="color: red;">SSS Mand. Provident</th>
            <th style="color: red;">Pagibig</th>
            <th style="color: red;">PhilHealth</th>
            <th style="color: red;">Withholding Tax</th>
            <th style="color: red;">SSS Loan</th>
            <th style="color: red;">SSS Calamity</th>
            <th style="color: red;">Pagibig Loan</th>
            <th style="color: red;">Pagibig Calamity</th>
            <th style="color: red;">Salary Loan</th>
            <th>Function</th>
        </tr>
    </thead>
    <tbody>
    <?php echo $tbody; ?>
    </tbody>
</table>

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

    <script>
        $(document).ready(function(){

        $('.update').click(function(){
            var employeeId = $(this).data('id');
            $.ajax({
                url: "payearningupdateform.php?id=" + employeeId,
                type: "post",
                data: {},
                success: function(data) {
                    $(".modal-title").html('<div class="">Update Employee Earnings</div>');
                    $(".modal-footer").html('<font >OUR BANK</font>');
                    $(".modal-body").html(data);
                    $(".modal-dialog").removeClass("custom-modal-body");
                    $(".modal").modal('show');
                },
                error: function() {
                    console.log();
                    alert('Failed');
                }
            });
        });

        $('.view').click(function(){
            var employeeId = $(this).data('id');
            $.ajax({
                url: "pay-viewempinfo.php?id=" + employeeId,
                type: "post",
                data: {},
                success: function(data) {
                    $(".modal-title").html('<div class="">Update Employee Earnings</div>');
                    $(".modal-footer").html('<font >OUR BANK</font>');
                    $(".modal-body").html(data);
                    $(".modal-dialog").addClass("custom-modal-body");
                    $(".modal").modal('show');
                },
                error: function() {
                    console.log();
                    alert('Failed');
                }
            });
        });

      


$('.delete-link').on('click', function(e) {
    e.preventDefault(); // Prevent the default link behavior
    var href = $(this).attr('href');
    if (confirm('Are you sure you want to delete this record?')) {
        window.location.href = href; // Proceed with deletion if confirmed
    }
});

    // Add a click event handler for the "Cancel" button inside the modal
    $(document).on('click', '.btn-danger[data-dismiss="modal"]', function() {
        $(".modal").modal('hide'); // Close the modal
    });
});
    </script>
<script>
    var itemsPerPage = 10;
    var tbody = document.getElementById('searchResults').getElementsByTagName('tbody')[0];
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