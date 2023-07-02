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
