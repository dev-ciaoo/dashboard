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
<body oncontextmenu="return false;">
    <h1><b></b>2023 Christmas Party Photo Gallery</b></h1>
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
            './JPEG/DSC00003.jpg', './JPEG/DSC00004.jpg', './JPEG/DSC00005.jpg', './JPEG/DSC00006.jpg', './JPEG/DSC00007.jpg', './JPEG/DSC00008.jpg', './JPEG/DSC00009.jpg',
            './JPEG/DSC00010.jpg', './JPEG/DSC00011.jpg', './JPEG/DSC00012.jpg', './JPEG/DSC00013.jpg', './JPEG/DSC00014.jpg', './JPEG/DSC00015.jpg', './JPEG/DSC00016.jpg',
            './JPEG/DSC00017.jpg', './JPEG/DSC00018.jpg', './JPEG/DSC00019.jpg', './JPEG/DSC00021.jpg', './JPEG/DSC00022.jpg', './JPEG/DSC00023.jpg', './JPEG/DSC00024.jpg',
            './JPEG/DSC00025.jpg', './JPEG/DSC00026.jpg', './JPEG/DSC00027.jpg', './JPEG/DSC00028.jpg', './JPEG/DSC00029.jpg', './JPEG/DSC00030.jpg', './JPEG/DSC09613.jpg',
            './JPEG/DSC09614.jpg', './JPEG/DSC09615.jpg', './JPEG/DSC09616.jpg', './JPEG/DSC09617.jpg', './JPEG/DSC09618.jpg', './JPEG/DSC09619.jpg', './JPEG/DSC09620.jpg', 
            './JPEG/DSC09622.jpg', './JPEG/DSC09624.jpg', './JPEG/DSC09625.jpg', './JPEG/DSC09626.jpg', './JPEG/DSC09628.jpg', './JPEG/DSC09629.jpg', './JPEG/DSC09631.jpg',
            './JPEG/DSC09632.jpg', './JPEG/DSC09634.jpg', './JPEG/DSC09635.jpg', './JPEG/DSC09636.jpg', './JPEG/DSC09637.jpg', './JPEG/DSC09638.jpg', './JPEG/DSC09639.jpg',
            './JPEG/DSC09640.jpg', './JPEG/DSC09641.jpg', './JPEG/DSC09642.jpg', './JPEG/DSC09643.jpg', './JPEG/DSC09644.jpg', './JPEG/DSC09645.jpg', './JPEG/DSC09646.jpg',
            './JPEG/DSC09647.jpg', './JPEG/DSC09648.jpg', './JPEG/DSC09649.jpg', './JPEG/DSC09711.jpg', './JPEG/DSC09712.jpg', './JPEG/DSC09713.jpg', './JPEG/DSC09714.jpg',
            './JPEG/DSC09715.jpg', './JPEG/DSC09716.jpg', './JPEG/DSC09717.jpg', './JPEG/DSC09718.jpg', './JPEG/DSC09719.jpg', './JPEG/DSC09720.jpg', './JPEG/DSC09721.jpg',
            './JPEG/DSC09722.jpg', './JPEG/DSC09723.jpg', './JPEG/DSC09724.jpg', './JPEG/DSC09725.jpg', './JPEG/DSC09726.jpg', './JPEG/DSC09727.jpg', './JPEG/DSC09728.jpg',
            './JPEG/DSC09729.jpg', './JPEG/DSC09730.jpg', './JPEG/DSC09731.jpg', './JPEG/DSC09732.jpg', './JPEG/DSC09733.jpg', './JPEG/DSC09734.jpg', './JPEG/DSC09735.jpg',
            './JPEG/DSC09736.jpg', './JPEG/DSC09737.jpg', './JPEG/DSC09738.jpg', './JPEG/DSC09739.jpg', './JPEG/DSC09740.jpg', './JPEG/DSC09741.jpg', './JPEG/DSC09742.jpg',
            './JPEG/DSC09743.jpg', './JPEG/DSC09744.jpg', './JPEG/DSC09745.jpg', './JPEG/DSC09746.jpg', './JPEG/DSC09747.jpg', './JPEG/DSC09748.jpg', './JPEG/DSC09749.jpg',
            './JPEG/DSC09750.jpg', './JPEG/DSC09751.jpg', './JPEG/DSC09752.jpg', './JPEG/DSC09753.jpg', './JPEG/DSC09754.jpg', './JPEG/DSC09755.jpg', './JPEG/DSC09757.jpg',
            './JPEG/DSC09758.jpg', './JPEG/DSC09759.jpg', './JPEG/DSC09760.jpg', './JPEG/DSC09761.jpg', './JPEG/DSC09762.jpg', './JPEG/DSC09763.jpg', './JPEG/DSC09764.jpg',
            './JPEG/DSC09765.jpg', './JPEG/DSC09766.jpg', './JPEG/DSC09767.jpg', './JPEG/DSC09768.jpg', './JPEG/DSC09769.jpg', './JPEG/DSC09770.jpg', './JPEG/DSC09771.jpg',
            './JPEG/DSC09772.jpg', './JPEG/DSC09773.jpg', './JPEG/DSC09774.jpg', './JPEG/DSC09775.jpg', './JPEG/DSC09776.jpg', './JPEG/DSC09777.jpg', './JPEG/DSC09778.jpg',
            './JPEG/DSC09779.jpg', './JPEG/DSC09780.jpg', './JPEG/DSC09781.jpg', './JPEG/DSC09782.jpg', './JPEG/DSC09783.jpg', './JPEG/DSC09784.jpg', './JPEG/DSC09785.jpg',
            './JPEG/DSC09786.jpg', './JPEG/DSC09787.jpg', './JPEG/DSC09788.jpg', './JPEG/DSC09789.jpg', './JPEG/DSC09790.jpg', './JPEG/DSC09791.jpg', './JPEG/DSC09792.jpg',
            './JPEG/DSC09794.jpg', './JPEG/DSC09795.jpg', './JPEG/DSC09796.jpg', './JPEG/DSC09797.jpg', './JPEG/DSC09798.jpg', './JPEG/DSC09799.jpg', './JPEG/DSC09800.jpg',
            './JPEG/DSC09801.jpg', './JPEG/DSC09802.jpg', './JPEG/DSC09803.jpg', './JPEG/DSC09804.jpg', './JPEG/DSC09805.jpg', './JPEG/DSC09806.jpg', './JPEG/DSC09807.jpg',
            './JPEG/DSC09801.jpg', './JPEG/DSC09802.jpg', './JPEG/DSC09803.jpg', './JPEG/DSC09804.jpg', './JPEG/DSC09805.jpg', './JPEG/DSC09806.jpg', './JPEG/DSC09807.jpg',
            './JPEG/DSC09808.jpg', './JPEG/DSC09810.jpg', './JPEG/DSC09811.jpg', './JPEG/DSC09812.jpg', './JPEG/DSC09813.jpg', './JPEG/DSC09814.jpg', './JPEG/DSC09815.jpg',
            './JPEG/DSC09816.jpg', './JPEG/DSC09819.jpg', './JPEG/DSC09820.jpg', './JPEG/DSC09822.jpg', './JPEG/DSC09823.jpg', './JPEG/DSC09824.jpg', './JPEG/DSC09826.jpg',
            './JPEG/DSC09828.jpg', './JPEG/DSC09829.jpg', './JPEG/DSC09830.jpg', './JPEG/DSC09831.jpg', './JPEG/DSC09833.jpg', './JPEG/DSC09834.jpg', './JPEG/DSC09835.jpg',
            './JPEG/DSC09836.jpg', './JPEG/DSC09837.jpg', './JPEG/DSC09838.jpg', './JPEG/DSC09841.jpg', './JPEG/DSC09842.jpg', './JPEG/DSC09843.jpg', './JPEG/DSC09844.jpg',
            './JPEG/DSC09845.jpg', './JPEG/DSC09846.jpg', './JPEG/DSC09848.jpg', './JPEG/DSC09850.jpg', './JPEG/DSC09851.jpg', './JPEG/DSC09852.jpg', './JPEG/DSC09853.jpg',
            './JPEG/DSC09854.jpg', './JPEG/DSC09855.jpg', './JPEG/DSC09856.jpg', './JPEG/DSC09859.jpg', './JPEG/DSC09860.jpg', './JPEG/DSC09861.jpg', './JPEG/DSC09862.jpg',
            './JPEG/DSC09864.jpg', './JPEG/DSC09867.jpg', './JPEG/DSC09868.jpg', './JPEG/DSC09870.jpg', './JPEG/DSC09872.jpg', './JPEG/DSC09873.jpg', './JPEG/DSC09874.jpg',
            './JPEG/DSC09875.jpg', './JPEG/DSC09876.jpg', './JPEG/DSC09877.jpg', './JPEG/DSC09878.jpg', './JPEG/DSC09879.jpg', './JPEG/DSC09880.jpg', './JPEG/DSC09881.jpg',
            './JPEG/DSC09882.jpg', './JPEG/DSC09886.jpg', './JPEG/DSC09897.jpg', './JPEG/DSC09898.jpg', './JPEG/DSC09899.jpg', './JPEG/DSC09905.jpg', './JPEG/DSC09901.jpg',
            './JPEG/DSC09902.jpg', './JPEG/DSC09903.jpg', './JPEG/DSC09905.jpg', './JPEG/DSC09906.jpg', './JPEG/DSC09907.jpg', './JPEG/DSC09910.jpg', './JPEG/DSC09912.jpg',
            './JPEG/DSC09913.jpg', './JPEG/DSC09914.jpg', './JPEG/DSC09915.jpg', './JPEG/DSC09916.jpg', './JPEG/DSC09917.jpg', './JPEG/DSC09918.jpg', './JPEG/DSC09919.jpg',
            './JPEG/DSC09920.jpg', './JPEG/DSC09921.jpg', './JPEG/DSC09922.jpg', './JPEG/DSC09923.jpg', './JPEG/DSC09924.jpg', './JPEG/DSC09925.jpg', './JPEG/DSC09926.jpg',
            './JPEG/DSC09930.jpg', './JPEG/DSC09931.jpg', './JPEG/DSC09932.jpg', './JPEG/DSC09933.jpg', './JPEG/DSC09934.jpg', './JPEG/DSC09935.jpg', './JPEG/DSC09936.jpg',
            './JPEG/DSC09937.jpg', './JPEG/DSC09938.jpg', './JPEG/DSC09939.jpg', './JPEG/DSC09940.jpg', './JPEG/DSC09941.jpg', './JPEG/DSC09942.jpg', './JPEG/DSC09943.jpg',
            './JPEG/DSC09944.jpg', './JPEG/DSC09945.jpg', './JPEG/DSC09946.jpg', './JPEG/DSC09947.jpg', './JPEG/DSC09951.jpg', './JPEG/DSC09952.jpg', './JPEG/DSC09953.jpg',
            './JPEG/DSC09962.jpg', './JPEG/DSC09964.jpg', './JPEG/DSC09965.jpg', './JPEG/DSC09966.jpg', './JPEG/DSC09967.jpg', './JPEG/DSC09968.jpg', './JPEG/DSC09969.jpg',
            './JPEG/DSC09970.jpg', './JPEG/DSC09971.jpg', './JPEG/DSC09972.jpg', './JPEG/DSC09973.jpg', './JPEG/DSC09974.jpg', './JPEG/DSC09975.jpg', './JPEG/DSC09976.jpg',
            './JPEG/DSC09977.jpg', './JPEG/DSC09978.jpg', './JPEG/DSC09979.jpg', './JPEG/DSC09980.jpg', './JPEG/DSC09981.jpg', './JPEG/DSC09982.jpg', './JPEG/DSC09986.jpg',
            './JPEG/DSC09987.jpg', './JPEG/DSC09988.jpg', './JPEG/DSC09989.jpg', './JPEG/DSC09990.jpg', './JPEG/DSC09991.jpg', './JPEG/DSC09992.jpg', './JPEG/DSC09994.jpg',
            './JPEG/DSC09995.jpg', './JPEG/DSC09997.jpg', './JPEG/DSC09999.jpg', 
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
