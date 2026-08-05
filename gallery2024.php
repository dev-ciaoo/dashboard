<!DOCTYPE html>
<html>
<head>
    <title>OUR BANK GALLERY</title>
    <link rel="stylesheet" href="./css/bootstrap521.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.min.css">
    <style>
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
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 25px 20px;
            justify-content: center;
            margin: 20px;
            position: relative;
            justify-items: center;
        }

        .gallery img {
            width: 30rem%;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            cursor: pointer;
            margin-top: 50px;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .pagination {
            margin-top: 40px;
            display: flex;
            justify-content: end;
        }

        .pagination button {
            border: 1px solid #ddd;
            padding: 8px 16px;
            margin: 2px;
            background-color: white;
            color: black;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .pagination button.active {
            background-color: lightblue!important;
            color: blue !important;
        }

        .pagination button:hover:not(.active) {
            background-color: #ddd;
        }

        /* Modal Styles */
        .modal img {
            max-width: 100%;
            max-height: 80vh;
        }

        .modal-header {
            justify-content: space-between;
        }

        .modal-footer button {
            width: 100px;
        }

        .download {
            /* position: absolute; */
            /* display: flex; */
            /* float: end; */
            outline: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1><b>2024 Christmas Party Photo Gallery</b></h1>
    <div class="gallery" id="photoGallery">
        <!-- Images will be dynamically loaded here -->
    </div>

    <div class="pagination" id="pagination">
        <!-- Bootstrap Previous and Next buttons will be dynamically generated here -->
    </div>

    <!-- Modal for Image Preview -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="previewModalLabel">Photo Preview</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="Photo Preview">
                </div>
                <div class="modal-footer justify-content-end">
                    <a href="#" download>
                        <button class="download">
                            <span class="fa-solid fa-download btn-primary btn-sm"></span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script src="js/jquery-3.6.0.min.js" crossorigin="anonymous"></script>

    <script src="js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

    <script src="assets/fontawesome/js/all.js" crossorigin="anonymous"></script>
    <script src="assets/fontawesome/js/all.min.js" crossorigin="anonymous"></script>

    <script>
        const photosPerPage = 9; // Number of photos per page
        const photos = []; // Array to hold photo URLs
        let currentPage = 1;

        // Fetch video files from the directory
        async function fetchPhotoFiles() {
            try {
                const response = await fetch('./galleryGetGal2024.php'); // Fetch file list from PHP
                const photoFiles = await response.json(); // Assuming it returns a JSON array of file names

                // Populate the photos array with photo paths
                photoFiles.forEach(file => {
                    photos.push(`./workshop/xmas2024/${file}`);
                });

                // After fetching, create pagination buttons
                createPaginationButtons();
            } catch (error) {
                console.error('Error fetching photo files:', error);
            }
        }

        const photoGallery = document.getElementById('photoGallery');
        const pagination = document.getElementById('pagination');
        const modalImage = document.getElementById('modalImage');
        const previewModal = new bootstrap.Modal(document.getElementById('previewModal'));
        let currentPreviewIndex = 0;

        function displayPhotos(pageNumber) {
            photoGallery.innerHTML = ''; // Clear previous photos
            const startIndex = (pageNumber - 1) * photosPerPage;
            const endIndex = pageNumber * photosPerPage;
            const displayedPhotos = photos.slice(startIndex, endIndex);

            displayedPhotos.forEach((photo, index) => {
                const img = document.createElement('img');
                img.src = './workshop/videothumbnail.png';
                img.alt = 'Photo';
                img.dataset.index = startIndex + index; // Store the photo index
                img.addEventListener('click', () => openPreviewModal(startIndex + index));
                photoGallery.appendChild(img);
            });
        }

        // Create a preview container for hover effect
        const hoverPreview = document.createElement('img');
        hoverPreview.style.position = 'absolute';
        hoverPreview.style.zIndex = '1000';
        hoverPreview.style.width = '200px'; // Adjust size as needed
        hoverPreview.style.height = 'auto';
        hoverPreview.style.border = '2px solid #ccc';
        hoverPreview.style.boxShadow = '0px 4px 8px rgba(0, 0, 0, 0.2)';
        hoverPreview.style.display = 'none'; // Initially hidden
        document.body.appendChild(hoverPreview);

        function handleMouseEnter(event, photo) {
            hoverPreview.src = photo; // Set the small preview image
            hoverPreview.style.display = 'block'; // Show the preview
        }

        function handleMouseMove(event) {
            // Position the preview near the cursor
            hoverPreview.style.left = event.pageX + 15 + 'px'; // Offset by 15px to the right
            hoverPreview.style.top = event.pageY + 15 + 'px'; // Offset by 15px below
        }

        function handleMouseLeave() {
            hoverPreview.style.display = 'none'; // Hide the preview
        }

        function displayPhotos(pageNumber) {
            photoGallery.innerHTML = ''; // Clear previous photos
            const startIndex = (pageNumber - 1) * photosPerPage;
            const endIndex = pageNumber * photosPerPage;
            const displayedPhotos = photos.slice(startIndex, endIndex);

            displayedPhotos.forEach((photo, index) => {
                const img = document.createElement('img');
                img.src = './workshop/image-icon.png'; // Placeholder image
                img.alt = 'Photo';
                img.dataset.index = startIndex + index; // Store the photo index
                img.addEventListener('click', () => openPreviewModal(startIndex + index));

                // Add hover events for the preview
                img.addEventListener('mouseenter', (event) => handleMouseEnter(event, photo));
                img.addEventListener('mousemove', handleMouseMove);
                img.addEventListener('mouseleave', handleMouseLeave);

                photoGallery.appendChild(img);
            });
        }

        function createPaginationButtons() {
            const numPages = Math.ceil(photos.length / photosPerPage);

            function updatePagination() {
                pagination.innerHTML = '';

                const prevButton = document.createElement('button');
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

                let startPage = Math.max(1, currentPage - 1);
                let endPage = Math.min(numPages, currentPage + 1);

                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.innerText = i;
                    pageButton.className = i === currentPage ? 'active' : '';
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        displayPhotos(currentPage);
                        updatePagination();
                    });
                    pagination.appendChild(pageButton);
                }

                const nextButton = document.createElement('button');
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

            displayPhotos(currentPage); // Display the first page of photos
            updatePagination(); // Create pagination buttons
        }

        function openPreviewModal(index) {
            currentPreviewIndex = index;
            modalImage.src = photos[index];

            // Set the download link and file name
            const downloadButton = document.querySelector('.modal-footer a');
            downloadButton.href = photos[index]; // Set the current photo URL
            const fileName = photos[index].split('/').pop(); // Extract the file name from the path
            downloadButton.download = fileName; // Set the file name for download

            previewModal.show();
        }
        // Add click event to the modal image for navigation
        modalImage.addEventListener('click', (event) => {
            const imageWidth = modalImage.offsetWidth;
            const clickX = event.offsetX;

            if (clickX < imageWidth / 2) {
                // Left half: Go to the previous image
                if (currentPreviewIndex > 0) {
                    currentPreviewIndex--;
                    modalImage.src = photos[currentPreviewIndex];
                }
            } else {
                // Right half: Go to the next image
                if (currentPreviewIndex < photos.length - 1) {
                    currentPreviewIndex++;
                    modalImage.src = photos[currentPreviewIndex];
                }
            }
        });

        document.onkeydown = function(e) {
            switch (e.keyCode) {
                case 37:
                    // alert('left');
                    if (currentPreviewIndex > 0) {
                        currentPreviewIndex--;
                        modalImage.src = photos[currentPreviewIndex];
                    }
                    break;
                // case 38:
                //     alert('up');
                //     break;
                case 39:
                    if (currentPreviewIndex < photos.length - 1) {
                        currentPreviewIndex++;
                        modalImage.src = photos[currentPreviewIndex];
                    }
                    break;
                // case 40:
                //     alert('down');
                //     break;
            }
        };

        // document.getElementById('prevButton').addEventListener('click', () => {
        //     if (currentPreviewIndex > 0) {
        //         currentPreviewIndex--;
        //         modalImage.src = photos[currentPreviewIndex];
        //     }
        // });

        // document.getElementById('nextButton').addEventListener('click', () => {
        //     if (currentPreviewIndex < photos.length - 1) {
        //         currentPreviewIndex++;
        //         modalImage.src = photos[currentPreviewIndex];
        //     }
        // });

        // Fetch photos on load
        fetchPhotoFiles();
    </script>

    <script>
        $(document).on('click', '.close', function(e){
            e.preventDefault();
            bootstrap.Modal.getInstance(document.getElementById('previewModal'))?.hide();
        });
    </script>
    
</body>
</html>
