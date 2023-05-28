<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ID Capture</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>ID Capture</h1>
    
    <button id="captureButton">Capture ID</button>
    
    <video id="videoElement" style="display: none;"></video>
    <canvas id="canvasElement" style="display: none;"></canvas>


    <script>
    $(document).ready(function() {
        var videoElement = document.getElementById('videoElement');
        var canvasElement = document.getElementById('canvasElement');
        var capturedImage = null;
        var capturing = false;

        // Handle button click event
        $('#captureButton').click(function() {
            if (!capturing) {
                startCapture();
            } else {
                saveImage();
            }
        });

        // Function to start video capture
        function startCapture() {
            // Check if the browser supports the MediaDevices API
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Access the device camera
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function(stream) {
                        // Display the video stream on a video element
                        videoElement.srcObject = stream;
                        videoElement.play();
                        videoElement.style.display = 'block';
                        capturing = true;
                        $('#captureButton').text('Capture');
                    })
                    .catch(function(error) {
                        console.log('Unable to access the camera: ', error);
                    });
            } else {
                console.log('getUserMedia is not supported');
            }
        }

        // Function to save the captured image
        function saveImage() {
            // Check if an image was captured
            if (capturedImage) {
                // Perform further processing with the captured image (e.g., send it to the server)
                console.log('Saved image:', capturedImage);

                // Reset capturedImage variable and video display
                capturedImage = null;
                videoElement.srcObject = null;
                videoElement.style.display = 'none';
                canvasElement.style.display = 'none';
                capturing = false;
                $('#captureButton').text('Capture ID');
            } else {
                console.log('No image captured');
            }
        }

        // Event listener to capture photo when video frame is clicked
        videoElement.addEventListener('click', function() {
            capturePhoto();
        });

        // Function to capture photo from video stream
        function capturePhoto() {
            // Create a canvas element
            var context = canvasElement.getContext('2d');

            // Set the canvas dimensions to match the video stream
            canvasElement.width = videoElement.videoWidth;
            canvasElement.height = videoElement.videoHeight;

            // Draw the video frame onto the canvas
            context.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

            // Convert the canvas image to a data URL
            capturedImage = canvasElement.toDataURL('image/jpeg');

            // Display the captured image
            videoElement.style.display = 'none';
            canvasElement.style.display = 'block';
            canvasElement.style.margin = 'auto';
            canvasElement.style.border = '1px solid #000';
            canvasElement.style.boxShadow = '0 0 5px rgba(0, 0, 0, 0.3)';
            canvasElement.style.cursor = 'default';

            $('#captureButton').text('Save Image');
        }
    });
</script>


</body>
</html>
