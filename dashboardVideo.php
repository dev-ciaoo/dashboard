<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
<style>
body{
    background-color: grey;
}
.dashVid{
    width: 100%;
    height: auto;
}
</style>
</head>
<body>
    <div id="backgroundVideo" onclick="this.play();arguments[0].preventDefault();" id="dashVideo">
        <video class="dashVid" src="./video/DASHBOARD.mp4" id="media-video" poster="./image/dashboard.jpg" controls></video>
    </div>
<script>

    var videoPlayer = document.getElementById('media-video');

    // Auto play, half volume.
    videoPlayer.volume = 0;

    // Play / pause.
    videoPlayer.addEventListener('click', function () {
        if (videoPlayer.paused == false) {
            videoPlayer.pause();
            videoPlayer.firstChild.nodeValue = 'Play';
        } else {
            videoPlayer.play();
            videoPlayer.firstChild.nodeValue = 'Pause';
        }
    });

</script>
</body>
</html>