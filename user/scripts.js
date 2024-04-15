// JavaScript Document

let navbar = document.querySelector('.navbar');

        document.querySelector('#menu-button').onclick = () => {
            navbar.classList.toggle('active');
			
			// searchForm.classList.remove('active');
            loginIcon.classList.remove('active');

        }


let loginIcon = document.querySelector('.user-box');

        document.querySelector('#login-icon').onclick = () => {
            loginIcon.classList.toggle('active');

			navbar.classList.remove('active');
			// searchForm.classList.remove('active');
			
        }
		
		window.onscroll = () =>{
			navbar.classList.remove('active');
			// searchForm.classList.remove('active');

		}
		

var swiper = new Swiper(".menu-slider", {
    grabCursor:true,
    loop:true,
    centeredSlides:true,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    breakpoints: {
        0: {
          slidesPerView: 1,
        },
        700: {
          slidesPerView: 2,
        },
        1000: {
          slidesPerView: 3,
        },
    },
})