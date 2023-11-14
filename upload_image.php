<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Convert image to base64
        $encodedImage = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

        // Store encoded image in the database (simulated here)

        echo 'Data URI: data:image/png;base64,' . $encodedImage;
    } else {
        echo 'Image upload failed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Image Upload</title>
</head>
<body>

    <form id="imageForm" enctype="multipart/form-data">
        <input type="file" id="imageInput" accept="image/*" />
        <button type="button" onclick="uploadImage()">Upload Image</button>
    </form>

    <!-- <script>
        function uploadImage() {
            var input = document.getElementById('imageInput');
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imageData = e.target.result;

                    // Call a function to send imageData to the server for database storage
                    sendToServer(imageData);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select an image.');
            }
        }

        function sendToServer(imageData) {
            // Use AJAX or another method to send the imageData to the server
            // For example, using Fetch API:
            fetch('upload.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ imageData: imageData }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);
                // Handle the response from the server
            })
            // .catch(error => {
            //     console.error("Error");
            // });
        }

        fetch('upload.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ imageData: imageData }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log('Server response:', data);
            // Handle the response from the server
        })
        .catch(error => {
            console.error('Fetch error:', error);
        });

        //     var imageData = 

        // fetch('upload.php', {
        //     method: 'POST',
        //     headers: {
        //         'Content-Type': 'application/json',
        //     },
        //     body: JSON.stringify({ imageData: imageData }),
        // })
        // .then(response => {
        //     if (!response.ok) {
        //         throw new Error('Network response was not ok');
        //     }
        //     return response.json();
        // })
        // .then(data => {
        //     console.log('Server response:', data);
        //     // Handle the response from the server
        // })
        // .catch(error => {
        //     console.error('Error in fetch:', error);
        //     throw error;  // Rethrow the error to propagate it further
        // });

    </script> -->


    <script>
        function uploadImage() {
            var input = document.getElementById('imageInput');
            var file = input.files[0];

            if (file) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    var imageData = e.target.result;

                    // Call a function to send imageData to the server for database storage
                    sendToServer(imageData);
                };
                reader.readAsDataURL(file);
            } else {
                alert('Please select an image.');
            }
        }

        function sendToServer(imageData) {
            // Use AJAX or another method to send the imageData to the server
            // For example, using Fetch API:
            fetch('upload.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ imageData: imageData }),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Server response:', data);
                // Handle the response from the server
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }
    </script>

</body>
</html>
