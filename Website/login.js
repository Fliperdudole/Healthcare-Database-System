document.getElementById("continueBtn").addEventListener("click", function() {
    // Fade out the button
    document.getElementById("continueBtn").classList.add("fade-out");

    // Hide the button after a delay
    setTimeout(function() {
        document.getElementById("continueBtn").style.display = "none";
        
        // Fade in the new buttons
        document.getElementById("staffSignInBtn").style.display = "block";
        document.getElementById("staffSignInBtn").classList.add("fade-in");

        document.getElementById("patientSignInBtn").style.display = "block";
        document.getElementById("patientSignInBtn").classList.add("fade-in");
    }, 1000); // Adjust this delay to match the duration of the fade-out animation
});

// Function to handle the fading out of buttons and logo, and redirection
function fadeOutAndRedirect(url) {
    // Fade out the buttons and logo
    document.getElementById("staffSignInBtn").classList.add("fade-out");
    document.getElementById("patientSignInBtn").classList.add("fade-out");
    document.querySelector("img").classList.add("fade-out");
    
    // Redirect after a delay
    setTimeout(function() {
        window.location.href = url; // Redirect to the specified URL
    }, 1000); // Adjust this delay to match the duration of the fade-out animation
}

// Click event listener for the Staff Sign In button
document.getElementById("staffSignInBtn").addEventListener("click", function() {
    fadeOutAndRedirect("staff_signin.html"); // Redirect to the Staff Sign In page
});

// Click event listener for the Patient Sign In button
document.getElementById("patientSignInBtn").addEventListener("click", function() {
    fadeOutAndRedirect("patient_signin.html"); // Redirect to the Patient Sign In page
});
