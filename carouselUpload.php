<?php
include('connection.php'); // Make sure this defines $con

// Upload logic
if (isset($_FILES['file'])) {
    $file = $_FILES['file'];
    $filename = basename($file['name']);
    $targetDir = "uploads/";
    $targetFile = $targetDir . $filename;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $uploadedBy = $_SESSION['username'];
    

    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    if (move_uploaded_file($file['tmp_name'], $targetFile)) {
        // Determine if it's an image or video
        $type = in_array($fileType, ['mp4', 'webm', 'mov']) ? 'video' : 'image';

        // Get the next position number safely
        $posQuery = $con->query("SELECT IFNULL(MAX(position), 0) + 1 AS nextPos FROM carousel_items");
        $nextPos = $posQuery->fetch_assoc()['nextPos'];

        // Insert uploaded file info
        $stmt = $con->prepare("INSERT INTO carousel_items (file_name, file_type, position, uploaded_by) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssis", $targetFile, $type, $nextPos, $uploadedBy);
        $stmt->execute();

        echo "<script>alert('✅ Successfully Uploaded!'); window.location='carouselUpload.php';</script>";
    } else {
        echo "<script>alert('❌ Error Uploading File');</script>" . $con->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Carousel Manager</title>
  <link rel="stylesheet" href="./css/bootstrap533.min.css" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/fontawesome/css/all.css">
  <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">

  <style>
    body {
      background: #f8f9fa;
    }
    .card-header {
      background: linear-gradient(90deg, #0d6efd, #6610f2);
      color: #fff;
      font-weight: 500;
    }
    tbody tr {
      cursor: grab;
      transition: background 0.3s, transform 0.2s;
    }
    tbody tr:hover {
      background: #e9ecef;
      transform: scale(1.01);
    }
    tbody tr.dragging {
      background: #d1e7dd;
      opacity: 0.8;
    }
    video, img {
      border-radius: 5px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }
    .btn-upload {
      background: linear-gradient(90deg, #0d6efd, #6610f2);
      color: #fff;
      font-weight: 500;
    }
    .btn-upload:hover {
      background: linear-gradient(90deg, #6610f2, #0d6efd);
      color: #fff;
    }

    th{
        text-transform: uppercase;
    }
  </style>
</head>
<body class="p-4">
  <div class="container">
    <div class="card shadow-lg">
      <div class="card-header text-center">
        🎞 CAROUSEL UPLOAD
      </div>
      <div class="card-body">
        <form action="" method="POST" enctype="multipart/form-data" class="mb-4">
          <div class="row g-2 align-items-center">
            <div class="col-md-3">
              <!-- <input type="file" name="file" class="form-control" required> -->
            </div>
            <div class="col-md-4">
              <input type="file" name="file" class="form-control" required>
            </div>
            <div class="col-md-2">
              <button type="submit" class="btn btn-upload w-100"><i class="fa-solid fa-cloud-arrow-up"></i></button>
            </div>
            <div class="col-md-3">
              <!-- <input type="file" name="file" class="form-control" required> -->
            </div>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table table-hover table-bordered align-middle" id="sortableTable">
            <thead class="table-light text-center">
              <tr>
                <th style="width:200px;">Preview</th>
                <th>File Name</th>
                <th style="width:100px;">Position</th>
                <th style="width:120px;">Actions</th>
              </tr>
            </thead>
            <tbody id="sortable">
              <?php
              $res = $con->query("SELECT * FROM carousel_items ORDER BY position ASC");
              while ($r = $res->fetch_assoc()) {
                  echo "<tr data-id='{$r['id']}' class='text-center'>";
                  echo "<td>";
                  if ($r['file_type'] === 'video') {
                      echo "<video src='{$r['file_name']}' width='180' controls></video>";
                  } else {
                      echo "<img src='{$r['file_name']}' width='180'>";
                  }
                  echo "</td>";
                  echo "<td class='text-truncate' style='max-width: 250px;'>" . htmlspecialchars(basename($r['file_name'])) . "</td>";
                  echo "<td>{$r['position']}</td>";
                  echo "<td>
                          <a href='delete_carousel.php?id={$r['id']}' class='btn btn-danger btn-sm'><i class='fa-solid fa-trash-can'></i></a>
                        </td>";
                  echo "</tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <script src="js/jquery364.min.js"></script>
  <script src="js/jquery-ui1132.min.js"></script>

  <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
  <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

  <script>
  $(function(){
    $("#sortable").sortable({
      placeholder: "ui-state-highlight",
      start: function(e, ui){ ui.item.addClass('dragging'); },
      stop: function(e, ui){ ui.item.removeClass('dragging'); },

      update: function() {
        let order = [];

        $('#sortable tr').each(function(index){
          let id = $(this).data('id');

          if (id !== undefined) {
            order.push({
              id: id,
              position: index + 1
            });
          }
        });

        $.ajax({
          url: 'update_order.php',
          type: 'POST',
          data: { order: order },

          success: function(res){
            console.log("Saved:", res);
            // Optional: show toast instead of reload
          },

          error: function(xhr){
            console.error("Error:", xhr.responseText);
          }
        });
      }
    });

    $("#sortable").disableSelection();
  });
  </script>
</body>
</html>
