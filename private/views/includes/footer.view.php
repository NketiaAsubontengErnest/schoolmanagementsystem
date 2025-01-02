<script>
    const dropdownSearch = document.getElementById('dropdownSearch');
    const dropdownMenu = document.getElementById('dropdownMenu');
    const selectedStudent = document.getElementById('selectedStudent');
    const dropdownItems = dropdownMenu.querySelectorAll('.dropdown-item');

    // Show dropdown when input is focused
    dropdownSearch.addEventListener('focus', () => {
        dropdownMenu.classList.remove('hidden');
    });

    // Filter dropdown items
    function filterStudents() {
        const filter = dropdownSearch.value.toLowerCase();
        dropdownItems.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(filter) ? '' : 'none';
        });
    }

    // Handle dropdown item click
    dropdownItems.forEach(item => {
        item.addEventListener('click', () => {
            const value = item.getAttribute('data-value');
            const text = item.textContent;

            // Update the input and hidden field
            dropdownSearch.value = text;
            selectedStudent.value = value;

            // Hide the dropdown menu
            dropdownMenu.classList.add('hidden');
        });
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', (event) => {
        if (!dropdownSearch.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.add('hidden');
        }
    });
</script>
<script>
    let video;
    let stream;
    let isCameraOpen = false;

    function toggleCamera() {
        const imageDisplay = document.getElementById('imageDisplay');
        const toggleButton = document.getElementById('toggleButton');

        if (!isCameraOpen) {
            // Open the camera
            if (!video) {
                video = document.createElement('video');
                video.style.width = '200px'; // Width for portrait mode
                video.style.height = '250px'; // Height for passport photo
                video.autoplay = true;
                video.style.objectFit = 'cover'; // Optional: ensure video fills the element
            }

            // Replace the imageDisplay with the video feed
            imageDisplay.replaceWith(video);
            toggleButton.textContent = 'Take Picture'; // Change button text to "Take Picture"
            console.log("Camera opened, ready to take picture");

            // Access user's webcam
            navigator.mediaDevices.getUserMedia({
                    video: true
                })
                .then(camStream => {
                    stream = camStream;
                    video.srcObject = stream;
                    isCameraOpen = true; // Update the state
                })
                .catch(err => {
                    alert('Unable to access the camera. Please check your browser settings.');
                    console.error(err);
                    toggleButton.textContent = 'Open Camera'; // Reset button text if access fails
                });
        } else {
            // Capture the image
            const canvas = document.createElement('canvas');
            canvas.width = 600; // Width for passport photo (600px)
            canvas.height = 750; // Height for passport photo (750px)
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            // Stop video stream after capturing the image
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }

            const dataURL = canvas.toDataURL('image/jpg');
            const imageDisplay = document.createElement('img');
            imageDisplay.id = 'imageDisplay';
            imageDisplay.src = dataURL;
            imageDisplay.className = 'border border-primary rounded mb-2';
            imageDisplay.style.width = '200px'; // Display size for the captured image
            imageDisplay.style.height = '250px'; // Display size for the captured image
            imageDisplay.alt = 'User Image';

            // Replace video with the captured image
            video.replaceWith(imageDisplay);
            toggleButton.textContent = 'Open Camera'; // Reset button text to "Open Camera"
            isCameraOpen = false; // Reset the state

            console.log("Image captured, ready to open camera again");

            // Optionally, set the data URL to a hidden input for form submission
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'capturedImage';
            hiddenInput.value = dataURL;
            document.querySelector('form').appendChild(hiddenInput);
        }
    }

    function readURL(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('imageDisplay').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    // Function to read and display the image
    function readURL(input) {
        if (input.files && input.files[0]) {
            var theFile = input.files[0];
            var reader = new FileReader();

            reader.onload = function(e) {
                // Set the src attribute of the image display element
                document.getElementById('imageDisplay').src = e.target.result;
            }

            if (theFile.type === 'image/jpeg' || theFile.type === 'image/png') {
                if (theFile.size < 3000000) { // Check if file size is less than 3MB
                    reader.readAsDataURL(theFile); // Read the file

                    // Display file info
                    document.querySelector(".file_info").textContent = 'File Uploaded: ' + theFile.name + ", Size: " + (theFile.size / 1000000).toFixed(2) + "MB";

                    if (theFile.name !== '') {
                        document.querySelector('#title').disabled = false;
                        document.querySelector('#sel_img').textContent = '';
                    }

                } else {
                    input.value = ""; // Clear the input file element
                    alert('Image size too big, it must be less than 3.0 MB');
                }
            } else {
                input.value = ""; // Clear the input file element
                alert('Select only image files');
            }
        }
    }
</script>
</div>
</div>
<footer class="footer">
    <script src="<?= ASSETS ?>/js/flush_arlert.js"></script>
    <?php if (isset($_SESSION['messsage'])) : ?>
        <script>
            swal({
                title: "<?= $_SESSION['status_headen'] ?>",
                text: "<?= $_SESSION['messsage'] ?>",
                icon: "<?= $_SESSION['status_code'] ?>",
                button: "OK, THANKS!",
            });
            <?php
            unset($_SESSION['messsage']);
            unset($_SESSION['status_code']);
            unset($_SESSION['status_headen']);
            ?>
        </script>
    <?php endif; ?>
</footer>
</body>

</html>