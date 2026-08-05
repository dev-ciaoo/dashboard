<!DOCTYPE html>
<html>
<head>
    <title>OUR BANK GALLERY</title>
    <link rel="stylesheet" href="./css/bootstrap521.min.css" crossorigin="anonymous">
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
            width: 400px;
            height: auto;
            margin: 10px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .gallery img:hover {
            transform: scale(1.05);
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: right;
            align-items: center;
            margin-right: 18px;
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
            background-color: blue;
            color: white;
        }

        .pagination button:hover:not(.active) {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h1><b></b>Loan Evaluation Workshop</b></h1>
<div class="gallery" id="photoGallery">
        <!-- Images will be dynamically loaded here -->
    </div>

    <div class="pagination" id="pagination">
        <!-- Bootstrap Previous and Next buttons will be dynamically generated here -->
    </div>

    <!-- Add Bootstrap JS script -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    if(typeof jQuery == 'undefined') {
        document.write('<script src="js/bootstrap.bundle.min.js"><\/script>');
    }
    </script>

    <script>
        // JavaScript logic to handle pagination and display images
        const photosPerPage = 9; // Number of photos per page
        const photos = [
            './workshop/photo/1.jpg', './workshop/photo/2.jpg', './workshop/photo/3.jpg', './workshop/photo/4.jpg', './workshop/photo/5.jpg', './workshop/photo/7.jpg', './workshop/photo/8.jpg',
            './workshop/photo/9.jpg', './workshop/photo/10.jpg', './workshop/photo/11.jpg', './workshop/photo/12.jpg', './workshop/photo/13.jpg', './workshop/photo/14.jpg', './workshop/photo/15.jpg',
            './workshop/photo/16.jpg', './workshop/photo/17.jpg', './workshop/photo/18.jpg', './workshop/photo/19.jpg', './workshop/photo/20.jpg', './workshop/photo/21.jpg', './workshop/photo/22.jpg'
            // Add more photo URLs here
        ];

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
                anchor.target = '_blank';

                const img = document.createElement('img');
                img.src = photo;
                img.alt = 'Photo';
                img.classList.add('img-thumbnail'); // Bootstrap class for image styling
                anchor.appendChild(img);

                photoGallery.appendChild(anchor);
            });
        }

        function createPaginationButtons() {
            const numPages = Math.ceil(photos.length / photosPerPage);

            function updatePagination() {
                pagination.innerHTML = '';

                const prevButton = document.createElement('button');
                prevButton.classList.add('btn', 'btn-primary', 'mr-2');
                prevButton.innerText = 'Previous';
                prevButton.addEventListener('click', () => {
                    if (currentPage > 1) {
                        currentPage--;
                        displayPhotos(currentPage);
                        updatePagination();
                    }
                });
                pagination.appendChild(prevButton);

                let startPage = Math.max(1, currentPage - 2);
                let endPage = Math.min(numPages, currentPage + 2);

                if (currentPage <= 3) {
                    endPage = Math.min(5, numPages);
                } else if (currentPage >= numPages - 2) {
                    startPage = Math.max(numPages - 4, 1);
                }

                if (startPage > 1) {
                    const firstPageButton = document.createElement('button');
                    firstPageButton.classList.add('btn', 'btn-primary', 'mr-2');
                    firstPageButton.innerText = '1';
                    firstPageButton.addEventListener('click', () => {
                        currentPage = 1;
                        displayPhotos(currentPage);
                        updatePagination();
                    });
                    pagination.appendChild(firstPageButton);

                    const ellipsisButton = document.createElement('button');
                    ellipsisButton.classList.add('btn', 'btn-primary', 'mr-2');
                    ellipsisButton.innerText = '...';
                    ellipsisButton.disabled = true;
                    pagination.appendChild(ellipsisButton);
                }

                for (let i = startPage; i <= endPage; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.classList.add('btn', 'btn-primary', 'mr-2');
                    pageButton.innerText = i;
                    pageButton.addEventListener('click', () => {
                        currentPage = i;
                        displayPhotos(currentPage);
                        updatePagination();
                    });
                    pagination.appendChild(pageButton);
                }

                if (endPage < numPages) {
                    const ellipsisButton = document.createElement('button');
                    ellipsisButton.classList.add('btn', 'btn-primary', 'mr-2');
                    ellipsisButton.innerText = '...';
                    ellipsisButton.disabled = true;
                    pagination.appendChild(ellipsisButton);

                    const lastPageButton = document.createElement('button');
                    lastPageButton.classList.add('btn', 'btn-primary', 'mr-2');
                    lastPageButton.innerText = numPages;
                    lastPageButton.addEventListener('click', () => {
                        currentPage = numPages;
                        displayPhotos(currentPage);
                        updatePagination();
                    });
                    pagination.appendChild(lastPageButton);
                }

                const nextButton = document.createElement('button');
                nextButton.classList.add('btn', 'btn-primary');
                nextButton.innerText = 'Next';
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
        
        createPaginationButtons();
    </script>
</body>
</html>
