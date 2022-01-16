///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FADE MENU - HAMBURGUER
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

let mobileMenu = document.getElementById("mobile-menu");

let hamburguer = document.getElementById("hamburguer");

let clonedHamburguer = hamburguer.cloneNode(true);
clonedHamburguer.style.opacity = "0.7";


function displayMobileMenu(){

    window.scrollTo({ top: 0, behavior: 'smooth' })

    mobileMenu.insertBefore(clonedHamburguer, mobileMenu.firstChild);
    mobileMenu.style.visibility = "visible";

    document.querySelector('.fade-menu').classList.remove('fadeOut');

    document.querySelector('.fade-menu').classList.toggle('fadeIn');

    
    document.querySelector("main").style.opacity = "0.4";
    document.querySelector("main").style.pointerEvents = "none";

    document.querySelector("nav").style.opacity = "0.4";
    document.querySelector("nav").style.pointerEvents = "none";

    document.body.style.overflow = "hidden";

    

}

function hideMobileMenu(){

    document.querySelector('.fade-menu').classList.remove('fadeIn');

    document.querySelector('.fade-menu').classList.toggle('fadeOut');
    

   
    
    mobileMenu.style.visibility = "hidden";


    
    document.querySelector("main").style.opacity = "1";
    document.querySelector("main").style.pointerEvents = "all";

    document.querySelector("nav").style.opacity = "1";
    document.querySelector("nav").style.pointerEvents = "all";

    document.body.style.overflow = "scroll";
    
}


//Set the mobile menu to hide when an external part is clicked/swiped
document.addEventListener("click",function(event) { 
    var target = event.target;
    if(target !== mobileMenu && target !== hamburguer && !mobileMenu.contains(target) || target === clonedHamburguer) {
        hideMobileMenu();
    }        
  });


//Set the hamburguer logo to open the mobile menu onclick
hamburguer.addEventListener("click", displayMobileMenu);


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FADE MENU ITEMS: HIDE AND SHOW MAIN SECTIONS
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

let serviceStatusButton = document.getElementById("service-status-button");
let mediaBoardButton = document.getElementById("media-board-button");
let feedButton = document.getElementById("feed-button");

let serviceStatus = document.getElementById("left-section"); 
let mediaBoard =  document.getElementById("centered-section"); 
let feed = document.getElementById("right-section"); 

serviceStatusButton.onclick = function (){
    serviceStatus.style.display = "block";
    mediaBoard.style.display = "none";
    feed.style.display = "none";
}

mediaBoardButton.onclick = function (){
    serviceStatus.style.display = "none";
    mediaBoard.style.display = "block";
    feed.style.display = "none";
}

feedButton.onclick = function (){
    serviceStatus.style.display = "none";
    mediaBoard.style.display = "none";
    feed.style.display = "block";
}

window.onresize = function(){
    if(window.screen.width > "600"){
        serviceStatus.style.display = "block";
        mediaBoard.style.display = "block";
        feed.style.display = "block";
    }
}

