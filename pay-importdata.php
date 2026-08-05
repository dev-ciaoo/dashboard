<?php
date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Import Biometrics</title>
<style>
    /*
     * MODERNIZED GLASSMORPHISM CSS
     */

    body {
        font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        /* background-image: url('image/OurbankFront001.jpg'); /
        background-size: 100vw 100vh; /* ✅ exact na sukat ng viewport */
        background: radial-gradient(at 0% 0%, #cda811 0%, transparent 50%),
              radial-gradient(at 100% 100%, #f0d76a 0%, transparent 50%),
              #e7da9b;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; 
        margin: 0;
        padding: 0;
        width: 100vw;  
        display: flex;
        justify-content: center;
        align-items: top;
        /* min-height: 100vh;
        height: 100vh; */
        position: relative;
        overflow: hidden; 
    }

    body::before {
        content: '';
        position: fixed; 
        top: 0;
        left: 0;
        width: 100vw;    
        height: 100vh;   
        background-image: url('image/OurbankFront001.jpg'); 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        opacity: 0.30;
        z-index: 0;
        pointer-events: none;
    }
    #inventorylogo {
        width: 350px;        
        height: auto;
        max-width: 100%;
        display: block;      
        margin: 0 auto;      
    }

    .payslip-container {
        max-width: 800px;
        margin: 0 auto;
        position: relative;
        z-index: 1;     
    }

    .upload-card {
        width: 650px;
        /* Glass Effect */
        background: rgba(255, 255, 255, 0.73); 
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        position: center;
        margin: 80px auto 0 auto;
        margin-top: 200px; 
        padding: 40px;
        border-radius: 24px;
        /* Subtle white border to catch the light */
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2); 
        text-align: center;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        z-index: 10;
    }
    
    .upload-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.25);
    }

    h2 {
        color: #010110;
        margin-bottom: 35px;
        font-size: 26px;
        font-weight: 700;
        letter-spacing: -0.5px;
        text-shadow: 0 2px 4px rgba(255, 255, 255, 0.94);
    }

    label {
        font-size: 13px;
        font-weight: 600;
        color: rgba(0, 0, 0, 0.9);
        display: block;
        margin-bottom: 8px;
        text-align: left;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Glassy Inputs */
    select, input[type="file"] {
        display: block;
        width: 100%;
        padding: 12px 15px;
        margin-bottom: 20px;
        background: rgb(255, 255, 255);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        font-size: 15px;
        color: #000000;
        cursor: pointer;
        transition: all 0.3s ease;
        box-sizing: border-box; /* Ensures padding doesn't break width */
    }

    /* Styling Select options for readability */
    select option {
        background: #ffffff; 
        color: black;
    }

    select:focus, input[type="file"]:focus {
        outline: none;
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.5);
        box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
    }

    .hint-text {
        display: block;
        margin: -2px 0 20px 0;
        color: rgba(8, 8, 8, 0.7);
        font-size: 12px;
        text-align: left;
    }
    
    .btn {
        width: 100%;
        margin-top: 10px;
        padding: 16px;
        background: #fff455;
        color: #0640ff; /* Dark blue text for contrast */
        border: none;
        border-radius: 12px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 700;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .btn:hover:not(:disabled) {
        background: #f8fafc;
        transform: scale(1.02);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }

    .btn:active:not(:disabled) {
        transform: scale(0.98);
    }
    
    /* Loading Overlay Glass */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.4);
        backdrop-filter: blur(8px);
        z-index: 1000;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
    }

    .spinner {
        border: 4px solid rgba(255, 255, 255, 0.1);
        border-top: 4px solid #ffffff;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
        margin-bottom: 20px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .btn:disabled {
        background: rgba(255, 255, 255, 0.3);
        color: rgba(255, 255, 255, 0.6);
        cursor: not-allowed;
    }
    
</style>
</head>
<body>

<!-- <div class="payslip-container">
      <div class="logo-section">
        <img src="./logo/logo.png" id="inventorylogo" alt="Bank Logo" />
        <!-- <h4 class="mt-3 mb-0" style="color: #3e4444;">Employee Payslip Portal</h4> -->
      <!-- </div>     --> -->

<div class="upload-card">
    <div class="payslip-container">
      <div class="logo-section">
        <img src="./logo/logo.png" id="inventorylogo" alt="Bank Logo" />
        
      </div>
    <h2>Upload Biometrics CSV</h2>

    <form id="uploadForm" action="pay-extractcsv.php" method="POST" enctype="multipart/form-data">

        <label>Payroll Period</label>
        <select name="payrollPeriod" required>
            <option value="">-- Select Period --</option>
            <option value="15th">15th Cutoff (26th - 10th)</option>
            <option value="30th">30th Cutoff (11th - 25th)</option>
        </select>
        
        <span class="hint-text">
            💡 System auto-detects period from CSV dates
        </span>

        <label>Select CSV File</label>
        <input type="file" name="csvFile" accept=".csv" required>

        <button type="submit" id="submitBtn" class="btn">Upload File</button>
    </form>
</div>

<div id="loadingOverlay" class="loading-overlay">
    <div class="spinner"></div>
    <div class="loading-text">Processing data, please wait...</div>
</div>

<script>
    const form = document.getElementById('uploadForm');
    const submitBtn = document.getElementById('submitBtn');
    const loadingOverlay = document.getElementById('loadingOverlay');

    form.addEventListener('submit', function() {
        submitBtn.disabled = true;
        submitBtn.textContent = 'Uploading...';
        loadingOverlay.style.display = 'flex'; 
    });
</script>

</body>
</html>