document.addEventListener("DOMContentLoaded", function () {
    const eateries = document.querySelectorAll(".eatery");

    // Generate random color in hex format
    function getRandomLightColor() {
        const minBrightness = 200; // Adjust this to control the minimum brightness
        const maxColorValue = 255;
        const minColorValue = 150; // Adjust this to control the minimum color value
        const r = Math.floor(Math.random() * (maxColorValue - minColorValue) + minColorValue);
        const g = Math.floor(Math.random() * (maxColorValue - minColorValue) + minColorValue);
        const b = Math.floor(Math.random() * (maxColorValue - minColorValue) + minColorValue);

        return `rgb(${r}, ${g}, ${b})`;
    }

    // Add random background color to each eatery
    eateries.forEach((eatery, index) => {
        if (index % 2 === 0) {
            eatery.style.backgroundColor = getRandomLightColor();
        } else {
            eatery.style.backgroundColor = getRandomLightColor();
        }
        eatery.style.cursor = "pointer"; // Add pointer cursor
    });

    // Function to handle click event on eatery divs
    function handleClick(event) {
        const nameElement = event.currentTarget.querySelector('.name');
        const eateryName = nameElement.textContent.trim();
        console.log("Clicked eatery:", eateryName);

        // Set localStorage with the selected eateryName
        localStorage.setItem('hotelname', eateryName);

        // Redirect to finalhotels.php with the dynamically determined eateryName
        redirectToFinalHotels(eateryName);
    }

    // Add event listener to each eatery div
    eateries.forEach((eatery) => {
        eatery.addEventListener('click', handleClick);
    });
});

// Function to handle the redirection to finalhotels.php
function redirectToFinalHotels(eateryName) {
    // Construct the URL with the eateryName parameter
    const url = `finalhotels.php?eateryName=${encodeURIComponent(eateryName)}`;
    // Redirect the user to the finalhotels.php page
    window.location.href = url;
}
