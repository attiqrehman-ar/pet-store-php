
// JavaScript for typing and deleting effect
document.addEventListener("DOMContentLoaded", function() {
    const texts = ["Parrots", "Cats", "Dogs",""];
    const colors = [
        "linear-gradient(to right, #E90074, #FF4191)", // Gradient color 1
        "linear-gradient(to left, #D8EFD3, #55AD9B)", // Gradient color 2
        "linear-gradient(to right, #ff9966, yellow)"  // Gradient color 3
    ];
    let count = 0; 
    let index = 0;
    let currentText = "";
    let letter = "";
    let isDeleting = false;
    const typingElement = document.querySelector(".typing");

    (function type() {
        if (count === texts.length) {
            count = 0;
        }
        currentText = texts[count];

        if (isDeleting) {
            letter = currentText.slice(0, --index);
        } else {
            letter = currentText.slice(0, ++index);
        }

        typingElement.textContent = letter;
        typingElement.style.backgroundImage = colors[count];
        typingElement.style.webkitBackgroundClip = "text";
        typingElement.style.webkitTextFillColor = "transparent";

        if (!isDeleting && letter.length === currentText.length) {
            setTimeout(() => isDeleting = true, 1000); // Pause before deleting
        } else if (isDeleting && letter.length === 0) {
            isDeleting = false;
            count++;
            setTimeout(type, 500); // Pause before typing next text
            return;
        }

        setTimeout(type, isDeleting ? 100 : 150); // Adjust typing and deleting speed
    })();
});


const popupScreen = document.querySelector(".popup-screen");
const popupBox = document.querySelector(".popup-box");
const closeBtn = document.querySelector(".close-btn");
const btn = document.querySelector(".btn");
function popupshow(){
    setTimeout(() => {
            popupScreen.classList.add("active");
            
        }, 50); //Popup the screen in 02 seconds after the page is loaded.
            
        closeBtn.addEventListener("click", () => {
            popupScreen.classList.remove("active"); //Close the popup screen on click the close button.
            window.location.href=".";

            //Create a cookie for a day (to expire within a day) on click the close button.
            //     document.cookie = "WebsiteName=testWebsite; max-age=" + 24 * 60 * 60; //1 day = 24 hours = 24*60*60
        });
        
        // setTimeout(() => {
            // popupScreen.classList.remove("active"); //Close the popup screen on click the close button.

        // }, 5000); //Popup the screen in 02 seconds after the page is loaded.       
     
}
function move(){
    window.location.href="./order_details.php";
}

