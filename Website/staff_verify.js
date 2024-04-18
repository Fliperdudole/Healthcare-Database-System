// Make sure document loads before script executes
document.addEventListener("DOMContentLoaded", function() {
    // Hold form and response data
    const form = document.getElementById("form");
    const responseDiv = document.getElementById("response");

    // Create submit event
    form.addEventListener("submit", (event) => {
        // Prevents the page from reloading on submission, which
        // is the default action.
        event.preventDefault();

        // Create new XMLHTTPRequest object to send data to php file.
        const xhr = new XMLHttpRequest();

        // Open it using POST and correct php file
        xhr.open("POST", "staff_verify.php", true);
        
        // Waits until the response is recieved from the php file. 
        // This is triggered after both send executes later, and the 
        // message is recieved back ie. The operation has loaded.
        xhr.onload = () => {
            // If message moved successfully
            if (xhr.status === 200) {
                // Update div in pateint_signin with php response
                responseDiv.innerHTML = xhr.responseText;
            } else {
                console.error("Request failed:", xhr.statusText);
            }
        };

        // Create object to hold data in form
        const formData = new FormData(form);
        // Send data to php file
        xhr.send(formData);
    });
    
});

