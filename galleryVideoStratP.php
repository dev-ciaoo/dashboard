<?php 
include('connection.php');
// include('galleryFileUpload.php');
?>


<!DOCTYPE html>
<html>
<head>
    <title>OUR BANK GALLERY</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <style>
        /* Your CSS styles for the photo gallery */
        body {
            background-color: #f7f7f7;
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
            margin-top: 40px;
            font-family: 'Courier New', Courier, monospace;
            color: #c62828;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .gallery img {
            width: 200px;
            height: auto;
            margin: 100px 50px 15px 50px; /* top, right, bottom, left */
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .pagination {
            margin-top: 90px;
            display: flex;
            justify-content: right;
            align-items: center;
            margin-right: 18px;
        }

        .folderList{
            margin: 100px 50px 15px 50px; /* top, right, bottom, left */
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
        }

        .pagination button {
            border: 1px solid #ddd;
            padding: 6px 12px;
            margin: 2px;
            background-color: white;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s;
            position: relative;
        }

        .pagination button.active {
            background-color: blue;
            color: white;
        }

        .pagination button:hover:not(.active) {
            background-color: #ddd;
        }

        .img-thumbnail{
            image: url('./workshop/videothumbnail.png');
        }

        #loading .spinner {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 60px;
            height: 60px;
            animation: spin 1s linear infinite;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        #back{
            float: left;
            background-color: lightgrey;
        }

        #back:hover{
            background-color: darkgrey;
        }

        .btnBack{
            margin-top: -25px;
            border-radius: 8px;
            margin-right: 60px;
            /* margin-bottom: 10px; */
            max-width: 15%;
        }

    </style>
</head>
<body>

<div class="forVUpload">
    <!-- <i class="fa fa-refresh" aria-hidden="true"></i> -->
    <a href=""><i class="fa fa-refresh btnBack" id="back" aria-hidden="true"></i></a>
    <div id="loading" style="display: none;">
        <div class="spinner"></div> 
</div>

<!-- <button id="uploadBtn">Upload</button> -->

    <h1><b></b>Strategic Plan Workshop</b></h1>


<div id="folderList" class="mb-3 py-4"></div>
<div id="photoGallery" class="gallery d-flex flex-wrap justify-content-center"></div>
<div id="pagination" class="pagination mt-3 py-5"></div>

<script>
    <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
</script>

<!-- Add Bootstrap JS script -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
       const photosPerPage = 3;
        let photos = []; // videos of current folder
        let folders = {}; // all folders with videos
        let currentPage = 1;
        let currentFolder = null;

        const photoGallery = document.getElementById('photoGallery');
        const pagination = document.getElementById('pagination');

        // Show folders as clickable folder icons
        function displayFolders() {
            photoGallery.innerHTML = '';
            pagination.innerHTML = '';

            Object.keys(folders).forEach(folder => {
                const folderDiv = document.createElement('div');
                folderDiv.style.cursor = 'pointer';
                folderDiv.style.display = 'inline-block';
                folderDiv.style.margin = '15px';
                folderDiv.style.textAlign = 'center';

                // Folder icon (you can replace with an actual icon or SVG)
                const folderIcon = document.createElement('div');
                folderIcon.style.fontSize = '64px';
                folderIcon.style.color = '#FFA500'; // orange folder color
                folderIcon.innerHTML = '&#128193;'; // folder emoji 📁

                const folderName = document.createElement('p');
                folderName.innerText = folder;
                folderName.style.fontWeight = 'bold';

                folderDiv.appendChild(folderIcon);
                folderDiv.appendChild(folderName);

                folderDiv.addEventListener('click', () => {
                    currentFolder = folder;
                    photos = folders[folder];
                    currentPage = 1;
                    createPaginationButtons();
                });

                photoGallery.appendChild(folderDiv);
            });
        }

        // Display photos/videos with pagination
        function displayPhotos(pageNumber) {
            photoGallery.innerHTML = '';

            const startIndex = (pageNumber - 1) * photosPerPage;
            const endIndex = pageNumber * photosPerPage;
            const displayedPhotos = photos.slice(startIndex, endIndex);

            displayedPhotos.forEach(photo => {
                const anchor = document.createElement('a');
                anchor.href = photo;

                const img = document.createElement('img');
                if (photo.match(/\.(mp4|mov|MP4|MOV)$/i)) {
                    img.src = './workshop/videothumbnail.png'; // thumbnail for videos
                    img.alt = 'Video Thumbnail';
                } else {
                    img.src = photo;
                    img.alt = 'Photo';
                }
                img.classList.add('img-thumbnail');
                anchor.appendChild(img);

                // Add video click behavior
                if (photo.match(/\.(mp4|mov|MP4|MOV)$/i)) {
                    anchor.addEventListener('click', function (event) {
                        event.preventDefault();
                        showVideoPlayer(photo);
                    });
                }

                const photoContainer = document.createElement('div');
                photoContainer.style.textAlign = 'center';
                photoContainer.style.margin = '10px';

                const fileName = photo.split('/').pop();
                const fileNameWithoutExtension = fileName.replace(/\.[^/.]+$/, '');

                const caption = document.createElement('p');
                caption.innerText = fileNameWithoutExtension;
                caption.style.fontSize = '14px';
                caption.style.fontWeight = 'bold';

                photoContainer.appendChild(anchor);
                photoContainer.appendChild(caption);
                photoGallery.appendChild(photoContainer);
            });
        }

        function showVideoPlayer(videoSrc) {
            const video = document.createElement('video');
            video.src = videoSrc;
            video.controls = true;
            video.style.width = '100%';
            video.style.height = '100%';
            video.style.position = 'fixed';
            video.style.top = '0';
            video.style.left = '0';
            video.style.zIndex = '1000';
            video.style.backgroundColor = 'black';
            video.autoplay = true;

            const closeButton = document.createElement('button');
            closeButton.innerText = 'X';
            closeButton.style.position = 'absolute';
            closeButton.style.top = '10px';
            closeButton.style.right = '20px';
            closeButton.style.fontSize = '24px';
            closeButton.style.color = 'white';
            closeButton.style.background = 'transparent';
            closeButton.style.border = 'none';
            closeButton.style.cursor = 'pointer';
            closeButton.style.zIndex = '1001';

            document.body.appendChild(closeButton);
            document.body.appendChild(video);

            closeButton.addEventListener('click', () => {
                document.body.removeChild(video);
                document.body.removeChild(closeButton);
            });

            video.addEventListener('click', () => {
                if (video.paused) video.play();
                else video.pause();
            });

            video.addEventListener('dblclick', () => {
                if (!document.fullscreenElement) video.requestFullscreen();
                else document.exitFullscreen();
            });

            // closeButton.addEventListener('click', () => {
            //             window.location.href="galleryVideoGeneralMonthly.php";
            //             });
        }

        // Pagination buttons and logic
        function createPaginationButtons() {
            const numPages = Math.ceil(photos.length / photosPerPage);

            function updatePagination() {
                pagination.innerHTML = '';

                if (numPages <= 1) return;

                const prevButton = document.createElement('button');
                prevButton.classList.add('btn', 'btn-primary', 'mr-2');
                prevButton.innerText = 'Previous';
                prevButton.disabled = currentPage === 1;
                prevButton.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        displayPhotos(currentPage);
                        updatePagination();
                    }
                });
                pagination.appendChild(prevButton);

                for (let i = 1; i <= numPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.classList.add('btn', 'btn-primary', 'mr-2');
                    if (i === currentPage) {
                        pageButton.disabled = true;
                    }
                    pageButton.innerText = i;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        displayPhotos(currentPage);
                        updatePagination();
                    });
                    pagination.appendChild(pageButton);
                }

                const nextButton = document.createElement('button');
                nextButton.classList.add('btn', 'btn-primary');
                nextButton.innerText = 'Next';
                nextButton.disabled = currentPage === numPages;
                nextButton.addEventListener('click', () => {
                    if (currentPage < numPages) {
                        currentPage++;
                        displayPhotos(currentPage);
                        updatePagination();
                    }
                });
                pagination.appendChild(nextButton);
            }

            displayPhotos(currentPage);
            updatePagination();
        }

        // Fetch folders and videos initially
        async function fetchVideoFiles() {
            try {
                const response = await fetch('./galleryGetVideosStratP.php');
                folders = await response.json();

                // Initially show folder list
                displayFolders();
            } catch (error) {
                console.error('Error fetching video files:', error);
            }
        }

        fetchVideoFiles();


</script>

<script>
   document.getElementById('videoUpload').addEventListener('change', () => {
    const files = document.getElementById('videoUpload').files;
    const loading = document.getElementById('loading');

    if (files.length === 0) {
        alert('Please select a video file to upload.');
        return;
    }

    // Show loading animation
    loading.style.display = 'block'; 

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) {
        formData.append('videos[]', files[i]); // Append each video to formData
    }

    // Fetch request to upload video files
    fetch('galleryFileUploadStratP.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()) // Parse JSON response
    .then(data => {
        if (data.success) {
            // Hide loading animation
            loading.style.display = 'none'; 
            
            // Assuming your PHP returns the uploaded file names
            data.uploadedFiles.forEach(file => {
                photos.push('./workshop/video/stratP/' + file); // Add uploaded videos to the photos array
            });
            console.log('Updated photos array:', photos);
            // Call a function to refresh the gallery or display the new videos
            updateGallery();
            alert('Successfully Uploaded');
            window.location.reload();
        } else {
            loading.style.display = 'none'; // Hide loading animation on error
            alert('Error uploading videos: ' + data.error);
        }
    })
    .catch(error => {
        loading.style.display = 'none'; // Hide loading animation on error
        console.error('Upload failed:', error);
        alert('An error occurred while uploading the videos. Please try again.');
    });
});


// Function to update the gallery after upload (optional)
function updateGallery() {
    // Logic to refresh or display the updated list of videos
    console.log('Gallery updated with new videos!');
}

    </script>
    
</body>
</html>
