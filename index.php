<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link href="css.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Мой красивый сайт</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #333;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        h1 {
            font-size: 36px;
            margin: 0;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(270px, 1fr));
            grid-gap: 20px;
            max-width: 900px;
            margin: 30px auto;
        }

        .gallery img, .gallery video {
            width: 90%;
            height: auto;
            object-fit: cover;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .gallery img:hover{
            transform: scale(1.05) rotate(3deg);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }

        .footer {
            background-color: #333;
            padding: 20px;
            color: #fff;
            text-align: center;
        }

        .upload-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 999;
        }

        .upload-btn input {
            display: none;
        }

        .upload-btn label {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f44336;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .upload-btn label:hover {
            background-color: #ff5722;
        }

        .toggle-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .toggle-btn:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .gallery {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Моя Галерея</h1>
    </header>

    <div class="upload-btn">
        <label for="file-upload">Загрузить картинку</label>
        <input type="file" id="file-upload" accept="image/*">
        <label for="video-upload">Загрузить видео</label>
        <input type="file" id="video-upload" accept="video/*">
    </div>

    <div class="toggle-btn">Показать только картинки</div>

    <div class="gallery">
    <img src="image1.jpg" alt="Изображение 1">
    <img src="image2.jpg" alt="Изображение 2">
    <img src="image3.jpg" alt="Изображение 3">
    <img src="image4.jpg" alt="Изображение 4">
    <img src="image5.jpg" alt="Изображение 5">
    <img src="image6.jpg" alt="Изображение 6">
    <img src="image7.jpg" alt="Изображение 7">
    <img src="image8.jpg" alt="Изображение 8">
    <img src="image9.jpg" alt="Изображение 9">
    <img src="image10.jpg" alt="Изображение 10">
    <video src="video1.mp4" id="video1" class="gallery-video"></video>
    <video src="video2.mp4" id="video2" class="gallery-video"></video>
    <video src="video3.mp4" id="video3" class="gallery-video"></video>
    <video src="video4.mp4" id="video4" class="gallery-video"></video>
    <video src="video5.mp4" id="video5" class="gallery-video"></video>
</div>

    <footer class="footer">

        <p>Все права защищены &copy; 2023</p>
        
        
    </footer>

    <script>
        const fileUpload = document.getElementById('file-upload');
        const videoUpload = document.getElementById('video-upload');
        const gallery = document.querySelector('.gallery');
        const uploadBtn = document.querySelector('.upload-btn');
        const toggleBtn = document.querySelector('.toggle-btn');
        let showImagesOnly = true;

        fileUpload.addEventListener('change', (event) => {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const imageSrc = e.target.result;
                    const newImage = document.createElement('img');
                    newImage.src = imageSrc;
                    newImage.alt = `Изображение ${gallery.children.length + 1}`;
                    gallery.appendChild(newImage);
                }

                reader.readAsDataURL(file);
            }
        });

        videoUpload.addEventListener('change', (event) => {
            const files = event.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    const videoSrc = e.target.result;
                    const newVideo = document.createElement('video');
                    newVideo.src = videoSrc;
                    newVideo.alt = `Видео ${gallery.children.length + 1}`;
                    newVideo.controls = true;
                    gallery.appendChild(newVideo);
                }

                reader.readAsDataURL(file);
            }
        });

        toggleBtn.addEventListener('click', () => {
            showImagesOnly = !showImagesOnly;
            const mediaElements = gallery.querySelectorAll('img, video');
            mediaElements.forEach((element) => {
                if (showImagesOnly) {
                    if (element.tagName === 'VIDEO') {
                        element.style.display = 'none';
                    } else {
                        element.style.display = 'block';
                    }
                } else {
                    if (element.tagName === 'VIDEO') {
                        element.style.display = 'block';
                    } else {
                        element.style.display = 'none';
                    }
                }
            });

            toggleBtn.textContent = showImagesOnly ? 'Показать только картинки' : 'Показать только видео';
        });

        window.addEventListener('scroll', () => {
            const boundingRect = gallery.getBoundingClientRect();
            const galleryBottom = boundingRect.top + boundingRect.height;
            const uploadBtnTop = uploadBtn.getBoundingClientRect().top;
            const uploadBtnHeight = uploadBtn.offsetHeight;

            if (uploadBtnTop <= galleryBottom - uploadBtnHeight) {
                uploadBtn.style.position = 'fixed';
                uploadBtn.style.top = '20px';
                uploadBtn.style.right = '20px';
            } else {
                uploadBtn.style.position = 'absolute';
                uploadBtn.style.top = `${galleryBottom - uploadBtnHeight}px`;
                uploadBtn.style.right = '20px';
            }
        });
    </script>

    
    
  
</body>
</html>

</body>
</html>


<script src="https://yastatic.net/jquery/3.3.1/jquery.min.js"></script>
<script src="js.js"></script>
</body>
</html>