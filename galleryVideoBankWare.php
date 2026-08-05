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
    <!-- <input type="file" id="videoUpload" accept="video/*"> -->
        <div class="spinner"></div> 
</div>

<!-- <button id="uploadBtn">Upload</button> -->

    <h1><b></b>BankWare Workshop</b></h1>


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
        // JavaScript logic to handle pagination and display images
        const photosPerPage = 3; // Number of photos per page
        const photos = []; // Initialize as an empty array

        // Fetch video files from the directory
        async function fetchVideoFiles() {
            try {
                const response = await fetch('./galleryGetVideosBankWare.php'); // Fetch file list from PHP
                const videoFiles = await response.json(); // Assuming it returns a JSON array of file names

                // Populate the photos array with video paths
                videoFiles.forEach(file => {
                    photos.push(`./workshop/video/bankware/${file}`);
                });

                // After fetching, create pagination buttons
                createPaginationButtons();
            } catch (error) {
                console.error('Error fetching video files:', error);
            }
        }

        // Call the function to fetch video files when the script loads
        fetchVideoFiles();

        const photoGallery = document.getElementById('photoGallery');
        const pagination = document.getElementById('pagination');
        let currentPage = 1;

        function displayPhotos(pageNumber) {
    photoGallery.innerHTML = ''; // Clear previous photos

    const startIndex = (pageNumber - 1) * photosPerPage;
    const endIndex = pageNumber * photosPerPage;

    const displayedPhotos = photos.slice(startIndex, endIndex);

    displayedPhotos.forEach(photo => {
        const anchor = document.createElement('a');
        anchor.href = photo;

        const img = document.createElement('img');

        // Check if the file is a video
        if (photo.endsWith('.mp4') || photo.endsWith('.mov') || photo.endsWith('.MP4') || photo.endsWith('.MOV')) {
            img.src = './workshop/videothumbnail.png'; // Set the thumbnail for the video
            img.alt = 'Video Thumbnail';
        } else {
            img.src = photo;
            img.alt = 'Photo';
        }

        img.classList.add('img-thumbnail'); // Bootstrap class for image styling
        anchor.appendChild(img);

        if (photo.endsWith('.mp4') || photo.endsWith('.mov') || photo.endsWith('.MP4') || photo.endsWith('.MOV')) {
            anchor.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default anchor behavior

                // Create a video element for full screen
                const video = document.createElement('video');
                video.src = photo;
                video.controls = true; // Add video controls like play, pause, etc.
                video.style.width = '100%'; // Fit video to the screen width
                video.style.height = '100%'; // Fit video to the screen height
                video.style.position = 'fixed';
                video.style.top = '0';
                video.style.left = '0';
                video.style.zIndex = '1000'; // Make sure the video is on top of other content
                video.style.backgroundColor = 'black';
                video.autoplay = true;

                // Append video to the body
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
                closeButton.style.zIndex = '1001'; // Make sure the button is on top of everything else

                document.body.appendChild(closeButton);
                document.body.appendChild(video);

                // Remove the video when it ends or when the user clicks anywhere on the screen
                // video.addEventListener('ended', () => document.body.removeChild(video));
                video.addEventListener('click', () => {
                    if (video.paused) {
                        video.play(); // Play the video if it is paused
                    } else {
                        video.pause(); // Pause the video if it is playing
                    }
                });

                video.addEventListener('dblclick', () => {
                    if (!document.fullscreenElement) {
                        video.requestFullscreen(); // Enter fullscreen mode
                    } else {
                        document.exitFullscreen(); // Exit fullscreen mode
                    }
                });


                // Close the video when "X" is clicked
                closeButton.addEventListener('click', () => {
                   window.location.href="galleryVideoBankWare.php";
                });

                                // Double-click event listener to toggle fullscreen
                
            });
        }

        // Create a container div for each video/thumbnail and its name
        const photoContainer = document.createElement('div');
        photoContainer.style.textAlign = 'center'; // Center the name below the thumbnail
        photoContainer.style.margin = '10px';

        // Create a caption for the video/photo file name without extension
        const fileName = photo.split('/').pop(); // Get the file name from the path
        const fileNameWithoutExtension = fileName.replace(/\.[^/.]+$/, ''); // Remove the file extension

        const caption = document.createElement('p');
        caption.innerText = fileNameWithoutExtension; // Set the file name without extension
        caption.style.fontSize = '14px'; // Optional: style the caption
        caption.style.fontWeight = 'bold';

        // Append the anchor (with image) and the caption to the container
        photoContainer.appendChild(anchor);
        photoContainer.appendChild(caption);

        // Append the container to the gallery
        photoGallery.appendChild(photoContainer);
    });
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
    fetch('galleryFileUploadBankware.php', {
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
                photos.push('./workshop/video/bankware/' + file); // Add uploaded videos to the photos array
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
