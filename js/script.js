let userBox = document.querySelector('.header .header-2 .user-box');

document.querySelector('#user-btn').onclick = () => {
   userBox.classList.toggle('active');
   navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .header-2 .navbar');

document.querySelector('#menu-btn').onclick = () => {
   navbar.classList.toggle('active');
   userBox.classList.remove('active');
}

window.onscroll = () => {
   userBox.classList.remove('active');
   navbar.classList.remove('active');

   if (window.scrollY > 60) {
      document.querySelector('.header .header-2').classList.add('active');
   } else {
      document.querySelector('.header .header-2').classList.remove('active');
   }
}

var currentDateTime = new Date();
var year = currentDateTime.getFullYear();
var month = (currentDateTime.getMonth() + 1);
var date = (currentDateTime.getDate() + 1);

if (date < 10) {
   date = '0' + date;
}
if (month < 10) {
   month = '0' + month;
}

var dateTomorrow = year + "-" + month + "-" + date;
var checkinElem = document.querySelector("#checkin-date");

// checkinElem.setAttribute("min", dateTomorrow);
// $('#checkin-date').attr('min', dateTomorrow);

