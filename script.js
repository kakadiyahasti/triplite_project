// Wait for the entire document to be loaded before running the script
document.addEventListener('DOMContentLoaded', function() {

    // --- DOM Selection Methods ---
    // Select the navigation bar
    const navBar = document.querySelector('nav');
    // Select all links within the navigation
    const navLinks = document.querySelectorAll('nav a');
    // Select the hero section on the homepage
    const heroSection = document.getElementById('background-video');

    // --- DOM Manipulation Methods ---
    // 1. Change content on the fly (Homepage)
    // Check if we are on the homepage by looking for the hero video
    if (heroSection) {
        const heroHeading = document.querySelector('.hero-content h2');
        heroHeading.textContent = "Your Adventure Starts Here!";

        const heroParagraph = document.querySelector('.hero-content p');
        heroParagraph.innerHTML = "Explore amazing places and **make memories** that last a lifetime.";
    }

    // 2. Event Listeners for interactive elements (All Pages)
    // Add a simple hover effect to navigation links
    navLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.color = '#ffcc00'; // Change text color on hover
        });
        link.addEventListener('mouseleave', function() {
            this.style.color = '#fff'; // Revert text color on mouse leave
        });
    });

    // 3. Adding and Removing Classes (Package page)
    const packageCards = document.querySelectorAll('.package-card');
    if (packageCards.length > 0) {
        packageCards.forEach(card => {
            card.addEventListener('click', function() {
                // Toggle a "selected" class to highlight the card
                this.classList.toggle('selected');
                if (this.classList.contains('selected')) {
                    console.log('Package card selected!');
                } else {
                    console.log('Package card deselected!');
                }
            });
        });
    }

    // --- DOM Creation and Appending (Reviews page) ---
    // This is a simple example. In a real project, this data would come from a database.
    const reviewList = document.getElementById('review-list');
    if (reviewList) {
        // Create a new review element
        const newReview = document.createElement('div');
        // Add classes and inner HTML
        newReview.classList.add('review-card');
        newReview.innerHTML = `
            <h3>Fantastic City Break!</h3>
            <p class="rating">⭐⭐⭐⭐⭐</p>
            <p>The Mumbai package was so much fun. The hotel was great and the sights were incredible.</p>
            <p class="reviewer">- Anjali V.</p>
        `;
        // Append the new review to the list
        reviewList.appendChild(newReview);
    }
});