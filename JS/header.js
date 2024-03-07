let card = document.querySelector(".card"); //declearing profile card element
let displayPicture = document.querySelector(".display-picture"); //declearing profile picture

displayPicture.addEventListener("click", function() { //on click on profile picture toggle hidden class from css
card.classList.toggle("hidden")})

function toggleMenu() {
    const menu = document.querySelector('.menuheader');
    menu.classList.toggle('show');
  }  