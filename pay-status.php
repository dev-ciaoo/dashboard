<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
<h1>
  Select Branch
  <small class="text-muted">HRIS System</small>
</h1>


<div class="row row-cols-1 row-cols-md-3 ">


  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/Head.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#headOfficeModal" type="button" onclick="getEmployees(this)">Head Office</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/magallanes.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#magallanesModal" type="button" onclick="getEmployees(this)">Magallanes</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/manggahan.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#magallanesModal" type="button" onclick="getEmployees(this)">Manggahan</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/maragondon.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#maragondonModal" type="button" onclick="getEmployees(this)">Maragondon</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/noveleta.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#noveletaModal" type="button" onclick="getEmployees(this)">Noveleta</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/poblacion.jpg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#poblacionModal" type="button" onclick="getEmployees(this)">Poblacion</button>
      </div>
    </div>
  </div>
  <div class="col mb-4">
    <div class="card h-100 shadow">
      <img src="images/branches/ternate.jpeg" class="card-img-top" alt="...">
      <div class="card-body text-center">
        <button class="btn btn-secondary" data-toggle="modal" data-target="#ternateModal" type="button" onclick="getEmployees(this)">Ternate</button>
      </div>
    </div>
  </div>
</div>  

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<!-- Head Office -->
<div class="modal fade" id="headOfficeModal" data-backdrop="static" tabindex="-1" aria-labelledby="headOfficeModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="headOfficeModalLabel">Head Office</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- Magallanes -->
<div class="modal fade" id="magallanesModal" data-backdrop="static" tabindex="-1" aria-labelledby="magallanesModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="magallanesModalLabel">Magallanes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- Manggahan -->
<div class="modal fade" id="manggahanModal" data-backdrop="static" tabindex="-1" aria-labelledby="manggahanModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="manggahanModal">Manggahan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- Maragondon -->
<div class="modal fade" id="maragondonModal" data-backdrop="static" tabindex="-1" aria-labelledby="maragondonModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="maragondonModalLabel">Maragondon</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- Noveleta -->
<div class="modal fade" id="noveletaModal" data-backdrop="static" tabindex="-1" aria-labelledby="noveletaModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="noveletaModalLabel">Noveleta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- Poblacion -->
<div class="modal fade" id="poblacionModal" data-backdrop="static" tabindex="-1" aria-labelledby="poblacionModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="poblacionModalLabel">Noveleta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- Ternate -->
<div class="modal fade" id="ternateModal" data-backdrop="static" tabindex="-1" aria-labelledby="ternateModal" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ternateModalLabel">Noveleta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
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
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" disabled>Save and Create New</button>
      </div>
    </div>
  </div>
</div>

<!-- FOR PAYSTATUS FUNCS -->

<script>

let emp = [{
  name: String,
  id: String,
}];

function getEmployees(e){
  const table = document.getElementById("payTableBody");
  fetch("searchByBranch", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ payload: e.innerHTML})
    }).then(res => res.json()).then(data =>{

      let payload = data.payload;
      table.innerHTML = '';
      if(payload.length < 1){
        table.innerHTML = "<p>Sorry. Nothing Found.</p>";
        return;
      }
      payload.forEach((item, index)=>{
        let employee = {
          name: item.name,
          id: item.employee_id,
        }
        emp.push(employee);


        table.innerHTML += ` 
            <tr>
              <td>${item.name}</td>
              <th scope="col"></th>
              <td><p class="paystatus-id">${item.employee_id}</p></td>
              <th scope="col"></th>
              <td><input type="file"></td>
              <td><input type="checkbox" class="paystatus-cb" unchecked></td>
              <th scope="col"></th>
              <td><button class="btn-success btn-sm" onclick="sendPay(${item.employee_id}, this)">Send Pay</button></td>
            </tr>`
      });
      console.log(payload);
    });
    return;
}

function sendPay(id, e){
  let data = {};
  emp.forEach((item, index)=>{
    if(item.id == id){
      data = {
        name: item.name,
        employee_id: item.id,
        pay_accepted: false
      };
      console.log("matched");
    }
  });

  fetch("sendPay", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ payload: data})
    })
    .then(res => res.json()).then(data =>{
      e.innerText = data.payload;
      e.disabled = true;
    });
    return;
}

</script>
</body>
</html>