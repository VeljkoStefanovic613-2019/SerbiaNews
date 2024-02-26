<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Video Page</title>
    <style>
        /* CSS to adjust the size of the video */
        #video-container {
            width: 100%;
            max-width: 800px; /* Adjust the maximum width as needed */
            margin: 0 auto;
        }
        video {
            width: 100%;
            height: auto; /* This ensures the video's aspect ratio is maintained */
            display: block;
        }
    </style>
</head>
<body>
    <div id="video-container">
        <?php
        // Video file path
        $video_path = "assets/images/Red Animated Breaking News Intro Youtube.mp4";
        ?>

        <video autoplay loop muted>
            <source src="<?php echo $video_path; ?>" type="video/mp4">
            <!-- Add additional source elements for different video formats if needed -->
            Your browser does not support the video tag.
        </video>
    </div>
</body>
</html>
