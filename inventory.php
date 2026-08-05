<?php 
include('connection.php');
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="devCiao">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap5.0.1.min.css" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
  <title>OUR Bank Inventory</title>
  <link rel="icon" type="images/x-icon" href="./logo/favicon.ico" />
  <!-- Style -->
  <style rel="stylesheet" type="text/css">

    /* .modal-body {
    max-height: 70vh;
    overflow-y: auto;
    margin: auto;
    }  */
    
    #example {
      font-family: Arial, Helvetica, sans-serif;
      border-collapse: collapse;
      width: 100%;  
      zoom: 90%;
    }

    #example th {
      padding-top: 12px;
      padding-bottom: 12px;
      text-align: center;
      /* background-color: #04AA6D;
      color: white; */
      font-size: 12px;
      white-space: nowrap;
      /* overflow: hidden; */
      text-overflow: ellipsis;
      background-color: #E4C514;
      text-transform: uppercase;
    }

    .scrollable-td {
      max-height: 7rem; /* Set max height */
      overflow-y: auto; /* Enable vertical scrolling */
      white-space: normal; /* Allows text wrapping */
      padding: 5px; /* Optional padding */
      /* border: 1px solid #ddd;  */
    }

    /* #example tr:nth-child(even){
      background-color: #f2f2f2;
    } */

    #example tbody tr:hover {
      background-color: #ddd;
    }

    #btnAdd {
      margin-bottom: 1%;
      /* margin-left: 1850px; */
    }

    /* .editbtn:hover {
      font-size: 105%;
    }

    .transferBtn:hover {
      font-size: 105%;
    }

    .deleteBtn:hover {
      font-size: 105%;
    }

    .approveBtn:hover {
      font-size: 105%;
    }

    .disapproveBtn:hover {
      font-size: 105%;
    } */


    .editbtn {
      padding: 2px;
      font-size: 12px;
    }

    .transferBtn {
      padding: 2px;
      font-size: 12px;
    }

    .deleteBtn {
      padding: 2px;
      font-size: 12px;
    }

    .approveBtn {
      padding: 2px;
      font-size: 12px;
    }

    .disapproveBtn {
      padding: 2px;
      font-size: 11px;
    }

    .disposalBtn {
      padding: 2px;
      font-size: 12px;
    }

    td {
      font-size: 12px;
      cursor: pointer;
    }

    #inventorylogo {
      width: 25%;
      height: auto;
    }

    .flogo {
      text-align: center;
    }

    .hiLi {
      background-color: #48D1CC !important;
    }

    .disposed {
      background-color: #fb55556b !important;
    }

  </style>
</head>
<body oncontextmenu="return false;">
  <div class="col-md-10 p-2">
    <!-- <ul class="nav justify-content-end"> -->
    <ul class="nav justify-content-end"> 
    <!-- <a class='btn btn-dark btn-sm' href='logout.php' role='button'>Logout</a> -->
    <!-- <li class='nav-item'> <a class='btn btn-dark btn-sm' href='dboard.php' role='button'> ← Dashboard</a></li> -->
      <!-- required open ?php -->
      <?php
      if (isset($_SESSION['userid'])) {
        // echo "<a class='btn btn-dark btn-sm' href='logout.php' role='button'>Logout</a>";
        echo "";
      } else {
        echo "<li class='nav-item'><a class='btn btn-dark btn-sm' href='login.php' role='button'>Log in</a></li>";
      }
      ?>
    </ul>
  </div>
  <div class="flogo">
    <img src="./logo/logo.png" id="inventorylogo" alt="invtrylogo" />
  </div>
  <div class="container-fluid">
    <!-- NEED NG OPEN ?PHP -->

    
    <div class="row">
      <div class="container">
        <!-- <div class="btnAdd col-md-8"> -->
        <div class="row">
          <div class="col-md-2"></div>
            <div class="dataTables_filter" id="btnAdd">
              <?php
                if (
                      ($_SESSION['role'] === 'admin' && $_SESSION['department'] == 1) 
                      || $_SESSION['username'] === 'rdcramos'
                    ) { 
              ?>
              <a href="#!" data-id="" data-bs-toggle="modal" data-bs-target="#addProductModal"  class="btn btn-success btn-sm"><strong>Add Product</strong></a>
              
              <button class="btn btn-primary btn-sm" onclick="exportAllInventory()"><strong>Export Full Inventory</strong></button>
              <?php
              }
              ?>
            </div>
          <div class="col-md-12">
            <!-- <div class="col-md-8"> -->
            <table id="example" class="table table-bordered align-middle" width="100%" height="auto" cellspacing="0">
              <thead>
                <th>&nbsp;&nbsp;&nbsp;#&nbsp;&nbsp;&nbsp; </th>
                <th>&nbsp;&nbsp;Equipment</th>
                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Code</th>
                <th>Location</th>
                <th class="scrollable-td">Description</th>
                <th>Brand/Model</th>
                <th>Condition</th>
                <th>Quantity</th>
                <th>Serial</th>
                <th>Price</th>
                <th>Image</th>
                <th>Date Acquired&nbsp;&nbsp;&nbsp;</th>
                <th>Date Transfer&nbsp;</th>
                <th>Name</th>
                <th>Disposed?</th>
                <th class="action">Operations</th>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="col-md-2"></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript; choose one of the two! -->
  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/dt-1.10.25datatables.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <script type="text/javascript">
    $(document).ready(function() {
        var mytable = $('#example').DataTable({
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
          $(nRow).attr('id', aData[0]);
          if(aData[14] == 'Waiting for Approval') {
            $(nRow).addClass('hiLi');
          }else if(aData[14] == 'Yes') {
            $(nRow).addClass('disposed');
          }
        },
        'serverSide': 'true',
        'processing': 'true',
        'paging': 'true',
        'responsive': 'true',
        'order': [],
        'ajax': {
          'url': 'fetch_data.php',
          'type': 'post',
        },
        "aoColumnDefs": [{
            "bSortable": false,
            "aTargets": [15] //total tables of database. 
          },

        ]
      });
      
    /* for category auto input in codeField and auto increment of id */ 
    $('body').on('change', '#category ', function(event) {
      var text = $(this).val();
      $.ajax({
        url: "getCategoryCount.php",
        data: {
          id: text
        },
        type: 'post',
        success: function(data) {
          var json = (data);
        $('#addCodeField').val(data);
        }
      })
    });
    });

    /* Submit Add Product Form */
    $(document).on('submit', '#addProduct', function(e) {
      e.preventDefault();
      var category = $('#addCatField').val();
      var computer = $('#addComputerField').val();
      var code = $('#addCodeField').val();
      var location = $('#addLocationField').val();
      var description = $('#addDescriptionField').val();
      var connectivity = $('addConnectivityField').val();
      var conditions = $('#addConditionsField').val();
      var quantity = $('#addQuantityField').val();
      var serials = $('#addSerialsField').val();
      var price = $('#addPriceField').val();
      // var fname = $('addfnameField').val();
      var dateAdded = $('#addDateAddedField').val();
      var fd = new FormData(this);
      if (computer != '' && location != '' && code != '' && category != '' && description != '' && quantity != '' && price != '' & dateAdded != '') {
        $.ajax({
          url: "add_product.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            var response = JSON.parse(data);
            if (response['result']) {
              mytable = $('#example').DataTable();
              mytable.draw();
              mytable.ajax.reload();
              $('#addProductModal').modal('hide');
              alert(response['message']);
              $('#addProduct')[0].reset();
              window.location.reload();
            } else {
              alert(response['message']);
            }
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });

    /* Submit Update Form */
    $(document).on('submit', '#updateProduct', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var computer = $('#computerField').val();
      var code = $('#codeField').val();
      var location = $('#locationField').val();
      var description = $('#descriptionField').val();
      var connectivity = $('#connectivityField').val();
      var conditions = $('#conditionsField').val();
      var quantity = $('#quantityField').val();
      var serials = $('#serialsField').val();
      var price = $('#priceField').val();
      var dateAdded = $('#dateAddedField').val();
      // var fname = $('#fnameField').val();
      var fd = new FormData(this);
      var trid = $('#trid').val();
      var id = $('#id').val();
      if (computer != '' && location != '') {
        $.ajax({
          url: "update_product.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.status;
            if (status == 'true') {
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(computer);
              // table.cell(parseInt(trid) - 1,2).data(code);
              // table.cell(parseInt(trid) - 1,3).data(location);
              // table.cell(parseInt(trid) - 1,4).data(description);
              // table.cell(parseInt(trid) - 1,5).data(connectivity);
              // table.cell(parseInt(trid) - 1,6).data(conditions);
              // table.cell(parseInt(trid) - 1,7).data(quantity);
              // table.cell(parseInt(trid) - 1,8).data(serials);
              // table.cell(parseInt(trid) - 1,9).data(price);
              // table.cell(parseInt(trid) - 1,10).data(img);
              // table.cell(parseInt(trid) - 1,11).data(dateAdded);
              var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td> <a href="#!"  data-id="' + id + '"  class="btn btn-secondary btn-sm transferBtn">Transfer</a></td>';
              mytable = $('#example').DataTable();
              mytable.draw();
              mytable.ajax.reload();
              $('#exampleModal').modal('hide');
              alert('Successfully Updated!');
            } else {
              alert('failed');
            }
          },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          }
        });
      } else {
        alert('Fill all the required fields');
      }
    });
  
    /* Transfer Product Modal */
    $(document).on('submit', '#transferProduct', function(e) {
      e.preventDefault();
      //var tr = $(this).closest('tr');
      var t_computer = $('#tComputerField').val();
      var t_code = $('#tCodeField').val();
      var t_location = $('#tLocationField').val();
      var hiddenLoc = $('#hiddenLoc').val();
      var t_description = $('#tDescriptionField').val();
      var t_connectivity = $('#tConnectivityField').val();
      var t_conditions = $('#tConditionsField').val();
      var t_quantity = $('#tQuantityField').val();
      var t_serials = $('#tSerialsField').val();
      var t_price = $('#tPriceField').val();
      var t_dateAdded = $('#tdateAddedField').val();
      var dateTransfer = $('#tdateTransfer').val();
      var t_fname = $('#tfnameField').val();
      var fd = new FormData(this);
      var trid = $('#trid').val();
      var id = $('#t_id').val();
      if (t_location != '' && dateTransfer != '' && t_fname != '') {
        if(!confirm("Are you you want to transfer this product from "+ hiddenLoc +" to " + t_location + "?")) {
              return false;
            }
        $.ajax({
          url: "transfer_product.php",
          type: "post",
          data: fd,
          contentType: false,
          processData: false,
          success: function(data) {
            var json = JSON.parse(data);
            var status = json.result;
            if (status) {
              $('#transferModal').modal('hide');
              // table.cell(parseInt(trid) - 1,0).data(id);
              // table.cell(parseInt(trid) - 1,1).data(computer);
              // table.cell(parseInt(trid) - 1,2).data(code);
              // table.cell(parseInt(trid) - 1,3).data(location);
              // table.cell(parseInt(trid) - 1,4).data(description);
              // table.cell(parseInt(trid) - 1,5).data(connectivity);
              // table.cell(parseInt(trid) - 1,6).data(conditions);
              // table.cell(parseInt(trid) - 1,7).data(quantity);
              // table.cell(parseInt(trid) - 1,8).data(serials);
              // table.cell(parseInt(trid) - 1,9).data(price);
              // table.cell(parseInt(trid) - 1,10).data(img);
              // table.cell(parseInt(trid) - 1,11).data(dateAdded);
              // table.cell(parseInt(trid) - 1,12).data(dateTransfer);
              // table.cell(parseInt(trid) - 1,13).data(fname);
              var button = '<td><a href="javascript:void(0);" data-id="' + id + '" class="btn btn-info btn-sm editbtn">Edit</a>  <a href="#!"  data-id="' + id + '"  class="btn btn-danger btn-sm deleteBtn">Delete</a></td> <a href="#!"  data-id="' + id + '"  class="btn btn-secondary btn-sm transferBtn">Transfer</a></td>';
              mytable = $('#example').DataTable();
              mytable.draw();
              alert('Transferred Successfully!');
              mytable.ajax.reload();
            } else {
              alert('failed');
            }
           
        },
          error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            alert(err.Message);
          } 
        });
      } else {
        alert('Fill all the required fields');
      }
    });

    /* Edit Button */
    $('#example').on('click', '.editbtn ', function(event) {
      var mytable = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
      $('#exampleModal').modal('show');
      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#computerField').val(json.computer);
          $('#codeField').val(json.code);
          $('#locationField').val(json.location);
          $('#descriptionField').val(json.description);
          $('#connectivityField').val(json.connectivity);
          $('#conditionsField').val(json.conditions);
          $('#quantityField').val(json.quantity);
          $('#serialsField').val(json.serials);
          $('#priceField').val(json.price);
          $('#dateAddedField').val(json.dateAdded);
          $('#fnameField').val(json.fname);
          $('#id').val(id);
          $('#trid').val(id);
        }
      })
    });

    /* Transfer Button */
    $('#example').on('click', '.transferBtn ', function(event) {
      var mytable = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      var id = $(this).data('id');
      $('#transferModal').modal('show');
      $.ajax({
        url: "get_single_data.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          $('#tComputerField').val(json.computer);
          $('#tCodeField').val(json.code);
          $('#tLocationField').val(json.location);
          $('#hiddenLoc').val(json.location);
          $('#tDescriptionField').val(json.description);
          $('#tConnectivityField').val(json.connectivity);
          $('#tConditionsField').val(json.conditions);
          $('#tQuantityField').val(json.quantity);
          $('#tSerialsField').val(json.serials);
          $('#tPriceField').val(json.price);
          $('#tdateAddedField').val(json.dateAdded);
          $('#tdateTransferField').val();
          $('#tfnameField').val();
          //$('#t_inventory_id').val(id);
          $('#t_id').val(id);
          $('#trid').val(id);
        }
      })
    });

    /* Delete Button */
    $(document).on('click', '.deleteBtn', function(event) {
      var mytable = $('#example').DataTable();
      event.preventDefault();
      var id = $(this).data('id');
      if (confirm("Are you sure want to delete this Product ? ")) {
        $.ajax({
          url: "delete_product.php",
          data: {
            id: id
          },
          type: "post",
          success: function(data) {
            var json = JSON.parse(data);
            status = json.status;
            if (status == 'success') {
              //table.fnDeleteRow( table.$('#' + id)[0] );
              //$("#example tbody").find(id).remove();
              //table.row($(this).closest("tr")) .remove();
              $("#" + id).closest('tr').remove();
              mytable.ajax.reload();
              alert('Successfully Deleted!');
            } else {
              alert('Failed');
              return;
            }
          }
        });
      } else {
        return null;
      }
    });

    /* Disposal Button */
    $('#example').on('click', '.disposalBtn ', function(event) {
      var mytable = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      if (!confirm("Are you sure want to request for a disposal of this product ?")){
          return false;
      }
        var id = $(this).data('id');
      $.ajax({
        url: "disposal_product.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          status = json.status;
          mytable.ajax.reload();
        }
      })
    });

    /* Approve Button */
    $('#example').on('click', '.approveBtn ', function(event) {
      var mytable = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      if (!confirm("Are you sure want to dispose this product ?")){
          return false;
      }
        var id = $(this).data('id');
      $.ajax({
        url: "approve_product.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          status = json.status;
          mytable.ajax.reload();
          alert('Approved Successfully!');
        }
      })
    });

    /* Disapprove Button*/
    $('#example').on('click', '.disapproveBtn ', function(event) {
      var mytable = $('#example').DataTable();
      var trid = $(this).closest('tr').attr('id');
      // console.log(selectedRow);
      if (!confirm("You want to disapprove this request?")){
          return false;
      }
        var id = $(this).data('id');
      $.ajax({
        url: "disapprove_product.php",
        data: {
          id: id
        },
        type: 'post',
        success: function(data) {
          var json = JSON.parse(data);
          status = json.status;
          mytable.ajax.reload();
          alert('Success!');
        }
      })
    });
    


  </script>
  <!-- Update Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Product</h5>
        </div>
        <form id="updateProduct" enctype="multipart/data-form">
          <div class="modal-body">
            <input type="hidden" name="id" id="id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="computerField" class="col-md-3 form-label">Equipment</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="computerField" name="computer" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="codeField" class="col-md-3 form-label">Code</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="codeField" name="code" Required readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="locationField" class="col-md-3 form-label">Location</label>
              <div class="col-md-9">
                <select class="form-control" name="location" id="locationField" value="" Required>
                  <option value="">-Select Branch-</option>
                  <option value="Head Office">Head Office</option>
                  <option value="Maragondon">Maragondon</option>
                  <option value="Manggahan">Manggahan</option>
                  <option value="Magallanes">Magallanes</option>
                  <option value="Noveleta">Noveleta</option>
                  <option value="Poblacion">Poblacion</option>
                  <option value="Ternate">Ternate</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="descriptionField" class="col-md-3 form-label">Description</label>
              <div class="col-md-9">  
                <input type="text" class="form-control" id="descriptionField" name="description" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="connectivityField" class="col-md-3 form-label">Connectivity</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="connectivityField" name="connectivity">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="conditionsField" class="col-md-3 form-label">Conditions</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="conditionsField" name="conditions" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="quantityField" class="col-md-3 form-label">Quantity</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="quantityField" name="quantity" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="serialsField" class="col-md-3 form-label">Serial</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="serialsField" name="serials" >
              </div>
            </div>
            <div class="mb-3 row">
              <label for="priceField" class="col-md-3 form-label">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="priceField" name="price" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="imgField" class="col-md-3 form-label">Image</label>
              <div class="col-md-9">
                <input type="file" class="form-control" id="imgField" name="img" accept="image/png, image/jpg">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="dateAddedField" class="col-md-3 form-label">Date Added</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="dateAddedField" name="dateAdded" Required>
              </div>
            </div>
            <!-- <div class="mb-3 row">
              <label for="fnameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="fnameField" name="fname">
              </div>
            </div> -->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><strong>Close</strong></button>
            <button type="submit" class="btn btn-primary"><strong>Update</strong></button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!-- Add product Modal -->
  <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        </div>
        <div class="modal-body">
          <form id="addProduct" action="" enctype="multipart/form-data">
            <div class="mb-3 row" id="id">
            <label for="addCatField" class="col-md-3 form-label">Category</label>
              <div class="col-md-9">
                <select class="form-control" id="category" name="category" Required>
                  <option selected disabled>--Select Category--</option>
                <?php
                  $sql = "SELECT * FROM `categorytbl` ORDER BY categoryName";
                  $query = mysqli_query($con, $sql);
                  while ($row = mysqli_fetch_assoc($query)) { 
                  $category = $row['categoryName'];
                  echo '<option value="'.$row['id'].'">'.$row['categoryName'].'</option>';
                  }
                ?>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addComputerField" class="col-md-3 form-label">Equipment</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addComputerField" name="computer" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addCodeField" class="col-md-3 form-label">Code</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addCodeField" name="code" readonly Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addLocationField" class="col-md-3 form-label">Location</label>
              <div class="col-md-9">
                <select class="form-control" name="location" id="addLocationField" Required>
                  <option value="" selected disabled>-Select Branch-</option>
                  <option value="Head Office">Head Office</option>
                  <option value="Maragondon">Maragondon</option>
                  <option value="Manggahan">Manggahan</option>
                  <option value="Magallanes">Magallanes</option>
                  <option value="Noveleta">Noveleta</option>
                  <option value="Poblacion">Poblacion</option>
                  <option value="Ternate">Ternate</option>
                </select>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addDescriptionField" class="col-md-3 form-label">Description</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addDescriptionField" name="description" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addConnectivityField" class="col-md-3 form-label">Connectivity</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addConnectivityField" name="connectivity">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addConditionsField" class="col-md-3 form-label">Condition</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addConditionsField" name="conditions" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addQuantityField" class="col-md-3 form-label">Quantity</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addQuantityField" name="quantity" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addSerialsField" class="col-md-3 form-label">Serial</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addSerialsField" name="serials">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addPriceField" class="col-md-3 form-label">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addPriceField" name="price" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addImgField" class="col-md-3 form-label">Image</label>
              <div class="col-md-9">
                <input type="file" class="form-control" id="addImgField" name="img" accept="image/png, image/jpg">
              </div>
            </div>
            <div class="mb-3 row">
              <label for="addDateAddedField" class="col-md-3 form-label">Date Added</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="addDateAddedField" name="dateAdded" Required>
              </div>
            </div>
            <!--div class="mb-3 row">
              <label for="addDateTransferField" class="col-md-3 form-label">Date Transfer</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="addDateTransferField" name="dateTransfer">
              </div>
            </div-->
            <!-- <div class="mb-3 row">
              <label for="addfnameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="addfnameField" name="fname">
              </div>
            </div> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><strong>Close</strong></button>
          <button type="submit" class="btn btn-primary"><strong>Save</strong></button>
        </div>
        </form>
      </div>
    </div>
  </div>

  <!--Transfer Modal-->
  <div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Transfer Product</h5>
        </div>
        <div class="modal-body">
          <form id="transferProduct" enctype="multipart/data-form">
            <!--input type="hidden" name="t_inventory_id" id="t_inventory_id" value=""-->
            <input type="hidden" name="t_id" id="t_id" value="">
            <input type="hidden" name="trid" id="trid" value="">
            <div class="mb-3 row">
              <label for="tComputerField" class="col-md-3 form-label">Equipment</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tComputerField" name="t_computer" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tCodeField" class="col-md-3 form-label">Code</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tCodeField" name="t_code" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tLocationField" class="col-md-3 form-label">Location</label>
              <div class="col-md-9">
                <select class="form-control" id="tLocationField" name="t_location" Required>
                  <option value="">-Select Branch-</option>
                  <option value="Head Office">Head Office</option>
                  <option value="Maragondon">Maragondon</option>
                  <option value="Manggahan">Manggahan</option>
                  <option value="Magallanes">Magallanes</option>
                  <option value="Noveleta">Noveleta</option>
                  <option value="Poblacion">Poblacion</option>
                  <option value="Ternate">Ternate</option>
                </select>
              </div>
            </div>
            <input type="hidden" class="form-control" id="hiddenLoc" name="hiddenLoc">
            <div class="mb-3 row">
              <label for="tDescriptionField" class="col-md-3 form-label">Description</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tDescriptionField" name="t_description" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tConnectivityField" class="col-md-3 form-label">Connectivity</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tConnectivityField" name="t_connectivity" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tConditionsField" class="col-md-3 form-label">Conditions</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tConditionsField" name="t_conditions" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tQuantityField" class="col-md-3 form-label">Quantity</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tQuantityField" name="t_quantity" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tSerialsField" class="col-md-3 form-label">Serial</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tSerialsField" name="t_serials" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tPriceField" class="col-md-3 form-label">Price</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="tPriceField" name="t_price" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tdateAddedField" class="col-md-3 form-label">Date Added</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="tdateAddedField" name="t_dateAdded" readonly>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tdateTransferField" class="col-md-3 form-label">Date Transfer</label>
              <div class="col-md-9">
                <input type="date" class="form-control" id="tdateTransferField" name="dateTransfer" Required>
              </div>
            </div>
            <div class="mb-3 row">
              <label for="tFnameField" class="col-md-3 form-label">Name</label>
              <div class="col-md-9">
                <input list="names" class="form-control" id="tfnameField" name="t_fname" Required>
                <datalist id="names">
                  <option value="Julius C. Villanueva">
                  <option value="CD Alegre">
                  <option value="Grennie Cenizal">
                  <option value="Jhay-ar Borgonia">
                  <option value="Jonathan Quiano">
                  <option value="Mellanie Onsana">
                  <option value="Jessus Diokno">
                </datalist>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><strong>Close</strong></button>
          <button type="submit" class="btn btn-primary" name="transferbtn"><strong>Transfer</strong></button>
        </div>
        </form>
      </div>
    </div>
  </div>

</body>

</html>

<script type="text/javascript">
  //var table = $('#example').DataTable();
</script>

<script>
  function exportAllInventory() {
    $.ajax({
        url: "export_inventory.php",
        type: "GET",
        dataType: "json",
        success: function(jsonData) {

            // Convert JSON to array for Excel
            var excelData = [];

            // Header row
            excelData.push([
                "ID", "Equipment", "Code", "Location", "Description", "Connectivity",
                "Condition", "Quantity", "Serial", "Price", "Image",
                "Date Acquired", "Date Transfer", "Name", "Disposed"
            ]);

            // Data rows
            jsonData.forEach(function(row) {
              // Convert status to Yes/No
              let statusText = (row.status == 2) ? "Yes" : "No";

                excelData.push([
                    row.id,
                    row.computer,
                    row.code,
                    row.location,
                    row.description,
                    row.connectivity,
                    row.conditions,
                    row.quantity,
                    row.serials,
                    row.price,
                    row.image,
                    row.dateAdded,
                    row.dateTransfer,
                    row.fname,
                    statusText
                ]);
            });

            // SheetJS: Convert to worksheet
            var ws = XLSX.utils.aoa_to_sheet(excelData);

            // Create workbook
            var wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, ws, "Full Inventory");

            // Download Excel
            XLSX.writeFile(wb, "full_inventory.xlsx");
        }
    });
}

</script>