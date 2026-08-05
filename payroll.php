<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" type="text/css" href="./css/dash.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/themes/smoothness/jquery-ui.css">

</head>
<body>

<h1>
  Time In/Out
  <small class="text-muted">HRIS System</small>
</h1>

<div class="row row-cols-1 row-cols-md-3 ">


  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/Head.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnHO" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Head Office</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/magallanes.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnMagallanes" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Magallanes</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/manggahan.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnManggahan" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Manggahan</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/maragondon.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnMaragondon" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Maragondon</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/noveleta.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnNoveleta" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Noveleta</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/poblacion.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnPoblacion" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Poblacion</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/ternate.jpeg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button id="btnTernate" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#headOfficeModal" type="button">Ternate</button>
      </div>
    </div>
  </div>
</div>



<!-- HEAD Office Modal -->
<div class="modal fade" id="headOfficeModal" data-backdrop="static" tabindex="-1" aria-labelledby="headOfficeModal"
  aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <span style="font-weight:bold" class="modal-title" id="headOfficeModalLabel"></span>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <table class="table">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th scope="col"></th>
              <th scope="col">Employee ID</th>
              <th scope="col"></th>
              <th scope="col">Payslip</th>
              <th scope="col">Accepted</th>
              <th scope="col"></th>
              <th scope="col"></th>
            </tr>
          </thead>
          <tbody class="table-group-divider" id="payTableBody">

          </tbody>
        </table> -->
        <form action="pay-extractcsv.php" id="csvForm" method="post" enctype="multipart/form-data">
          <input type="file" name="csvFile" accept=".csv" required>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-secondary upload-btn" id="csvFile">Upload</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>

<!-- bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<!-- Custom -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>


<script type="text/javascript" src="js/uploadCSV.js"></script>

<script>
  $(document).ready(function() {
    $('#btnHO').click(function(){
      $('.modal-title').text('Head Office');
    });
    $('#btnMagallanes').click(function(){
      $('.modal-title').text('Magallanes');
    });
    $('#btnManggahan').click(function(){
      $('.modal-title').text('Manggahan');
    });
    $('#btnMaragondon').click(function(){
      $('.modal-title').text('Maragondon');
    });
    $('#btnNoveleta').click(function(){
      $('.modal-title').text('Noveleta');
    });
    $('#btnPoblacion').click(function(){
      $('.modal-title').text('Poblacion');
    });
    $('#btnTernate').click(function(){
      $('.modal-title').text('Ternate');
    });
  });
</script>
<!-- FOR PAYSTATUS FUNCS -->
  <!-- let emp = [{
      name: String,
      id: String,
      branch: String
    }];

    // Variables for identifying if pay is already sent

    let payStat = "Send Pay";
    let payDisable = "";


    function getEmployees(e) {
      const table = document.getElementById("payTableBody");

      fetch("searchByBranch", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ payload: e.innerHTML })
      }).then(res => res.json()).then(data => {

        let payload = data.payload;
        let payload2 = data.payload2;


        table.innerHTML = '';
        if (payload.length < 1) {
          table.innerHTML = "<p>Sorry. Nothing Found.</p>";
          return;
        }
        payload.forEach((item, index) => {


          let employee = {
            name: item.name,
            id: item.employee_id,
            branch: item.branch
          }
          emp.push(employee);

          for (var i = 0; i < payload2.length; i++) {
            if (item.employee_id == payload2[i].employee_id) {
              if (payload2[i].payslip_sent == true) {
                payStat = "Sent";
                payDisable = "Disabled";
              }
            }
          }


          table.innerHTML +=
            ` 
              <tr>
                <td>${item.name}</td>
                <th scope="col"></th>
                <td><p class="paystatus-id">${item.employee_id}</p></td>
                <th scope="col"></th>
                <td><input type="file"></td>
                <td><input type="checkbox" class="paystatus-cb" unchecked disabled></td>
                <th scope="col"></th>
                <td><button class="btn-success btn-sm" onclick="sendPay(${item.employee_id}, this)"  ${payDisable}>${payStat}</button></td>
              </tr>
          
          `

          payStat = "Send Pay";
          payDisable = "";

        });

      });
      return;
    }


    function sendPay(id, e) {
      let data = {};
      emp.forEach((item, index) => {
        if (item.id == id) {
          data = {
            name: item.name,
            employee_id: item.id,
            branch: item.branch,
            pay_accepted: false
          };
          console.log("matched");
        }
      });

      fetch("sendPay", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ payload: data })
      })
        .then(res => res.json()).then(data => {
          e.innerText = data.payload;
          e.disabled = true;
        });
      return;
    } -->


  

</body>
</html>