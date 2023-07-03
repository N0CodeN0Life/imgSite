
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

const galleryVideos = document.querySelectorAll('.gallery-video');

galleryVideos.forEach(video => {
    video.addEventListener('click', () => {
        if (video.classList.contains('active')) {
            video.pause();
            video.classList.remove('active');
        } else {
            galleryVideos.forEach(vid => {
                vid.pause();
                vid.classList.remove('active');
            });
            video.play();
            video.classList.add('active');
        }
    });
});
