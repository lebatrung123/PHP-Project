const dashBoard = document.querySelector(".apps .container1");
const iconBars = document.querySelector(".apps header .header-left > i");
const main = document.querySelector(".main");
const box = document.querySelector(".main .box");
const box1 = document.querySelector(".all-content .main1 .box1");
const signOut = document.querySelector(".apps .header-right i");
const signOut1 = document.querySelector(".apps .header-right1");

console.log(iconBars);

iconBars.onclick = function() {
    
    dashBoard.classList.toggle("active");
    box.classList.toggle("active");
    main.classList.toggle("active");
    box1.classList.toggle("active");
}

signOut.onclick = function() {
    signOut1.classList.toggle("active");
}