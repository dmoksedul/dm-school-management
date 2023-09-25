// script.js
document.addEventListener("DOMContentLoaded", function () {
    const scrollToTopButton = document.getElementById("scrollToTopButton");

    // Show or hide the button based on scroll position
    window.addEventListener("scroll", () => {
        if (window.pageYOffset > 100) {
            scrollToTopButton.style.bottom = "20px";
        } else {
            scrollToTopButton.style.bottom = "100%";
        }
    });

    // Scroll smoothly to the top when the button is clicked
    scrollToTopButton.addEventListener("click", () => {
        window.scrollTo({
            top: 0,
            behavior: "smooth"
        });
    });
});
// JavaScript for Preloader
document.addEventListener("DOMContentLoaded", function () {
    // Hide the preloader when the page is fully loaded
    setTimeout(function () {
        document.querySelector(".preloader").style.display = "none";
    }, 1000); // Adjust the delay as needed (1 second in this example)
});

// navbar sticky menu
const navbar = document.querySelector('#dm_navbar_area');
const content = document.querySelector('.content');
const navbarOffsetTop = navbar.offsetTop;

function handleScroll() {
    if (window.pageYOffset >= navbarOffsetTop) {
        navbar.classList.add('sticky');
    } else {
        navbar.classList.remove('sticky');
    }
}
window.addEventListener('scroll', handleScroll);


// menu toggler
// Function to toggle the visibility of the submenu when clicking on the parent menu item
function toggleSubMenu(event) {

    // Get the parent <li> element
    const parentLi = event.target.parentElement;
  
    // Find the submenu within the parent <li>
    const submenu = parentLi.querySelector('.sub-menu');
  
    // Toggle the 'active' class to show/hide the submenu
    if (submenu) {
      submenu.classList.toggle('active');
    }
  }
  
  // Add click event listeners to each parent menu item
  const parentMenuItems = document.querySelectorAll('#dm_navbar_menu > li > a');
  parentMenuItems.forEach(item => {
    item.addEventListener('click', toggleSubMenu);
  });

  document.getElementById("dm_menu_toggler").addEventListener("click", function(){
    document.querySelector("#dm_navbar_menu").classList.toggle('dm_navbar_menu_active');
    document.getElementById("navbar_close_button").classList.add('navbar_close_button_active')
  })

  document.getElementById("navbar_close_button").addEventListener("click", function(){
    document.querySelector("#dm_navbar_menu").classList.remove('dm_navbar_menu_active');
    document.getElementById("navbar_close_button").classList.remove('navbar_close_button_active')
  })