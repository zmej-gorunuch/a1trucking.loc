document.addEventListener('DOMContentLoaded', () => {

	const { clientWidth } = document.body;

	// Footer map scroll
	const contactMapBlock = document.querySelector('.contacts__map-block')
	if (clientWidth <= 1366 && contactMapBlock && clientWidth > 576) {
		const footer = document.querySelector('footer')
		let foterHeight = footer.clientHeight
	
		$(document).ready(function(){
			$("#sticker").sticky({
				topSpacing:0,
				bottomSpacing:foterHeight
			});
		});
	}

	// Header Fixed
	// const scrollTop = window.pageYOffset
	window.addEventListener('scroll', () => {
		const header = document.querySelector('.header')
		if (window.pageYOffset > 900) {
			header.classList.add('header--fixed')
		} else {
			header.classList.remove('header--fixed')
		}
	})

	// Mobile menu
	const mobileMenu = document.querySelector('.mobile-menu')
	const mobileMenuBtn = document.querySelector('.mobile-menu__btn')
	let menuOpen = false;
	mobileMenuBtn.addEventListener('click', () => {
		if(!menuOpen){
			mobileMenuBtn.classList.add('mobile-menu__btn--open')
			mobileMenu.classList.add('mobile-menu--open')
			mobileMenuBtn.innerText = 'Close'
			document.body.style='overflow-y: hidden'
			menuOpen = true
		} else {
			mobileMenuBtn.classList.remove('mobile-menu__btn--open')
			mobileMenu.classList.remove('mobile-menu--open')
			mobileMenuBtn.innerText = 'Menu'
			document.body.style='overflow-y: auto'
			menuOpen = false
		}
	})


	// Mobile buttons
	const circleTTFPulse = document.querySelectorAll('.circle-btn__ttf-pulse')
	const circleLogin = document.querySelectorAll('.circle__btn-login')
	const circleTTF = document.querySelectorAll('.circle__btn-ttf')
	if (circleTTFPulse || circleLogin || circleTTF) {
		if (clientWidth <= 576){
			circleTTFPulse.forEach(circleTTFPulse => {
				circleTTFPulse.r.baseVal.valueAsString = 28
				circleTTFPulse.cy.baseVal.valueAsString = 30
				circleTTFPulse.cx.baseVal.valueAsString = 30
			})
			circleLogin.forEach(circleLogin => {
				circleLogin.r.baseVal.valueAsString = 9
				circleLogin.cy.baseVal.valueAsString = 10
				circleLogin.cx.baseVal.valueAsString = 10
			})
			circleTTF.forEach(circleTTF => {
				circleTTF.r.baseVal.valueAsString = 9
				circleTTF.cy.baseVal.valueAsString = 10
				circleTTF.cx.baseVal.valueAsString = 10
			})
		} else if (clientWidth > 576 && clientWidth <= 1366) {
			circleTTFPulse.forEach(circleTTFPulse => {
				circleTTFPulse.r.baseVal.valueAsString = 24
				circleTTFPulse.cy.baseVal.valueAsString = 27
				circleTTFPulse.cx.baseVal.valueAsString = 27
			})
			circleLogin.forEach(circleLogin => {
				circleLogin.r.baseVal.valueAsString = 8
				circleLogin.cy.baseVal.valueAsString = 9
				circleLogin.cx.baseVal.valueAsString = 9
			})
			circleTTF.forEach(circleTTF => {
				circleTTF.r.baseVal.valueAsString = 8
				circleTTF.cy.baseVal.valueAsString = 9
				circleTTF.cx.baseVal.valueAsString = 9
			})
		}
	}

	
	

  // Container Width
  const container = document.querySelectorAll('.container');
  container.forEach((container) => {
    if (clientWidth >= 768) {
      container.style.maxWidth = `${clientWidth - 30}px`;
    }	else {
      container.style.maxWidth = `${clientWidth}px`;
    }
  });

  // Width columns
  const adapt = document.querySelector('.adapt');
	if(adapt){
		const adaptRow = adapt.lastElementChild.lastElementChild;
		if (clientWidth >= 1366) {
			adaptRow.firstElementChild.classList.add('col-xl-4');
			adaptRow.firstElementChild.classList.remove('col-xl-5', 'col-12');
		} else if (clientWidth < 576) {
			adaptRow.firstElementChild.classList.add('col-12', 'col-12');
			adaptRow.firstElementChild.classList.remove('col-xl-4', 'col-xl-5');
		}	else {
			adaptRow.firstElementChild.classList.add('col-xl-5', 'col-lg-6');
			adaptRow.firstElementChild.classList.remove('col-lg-4', 'col-12');
		}
	}
  

  // Forms
  const forms = function () {
    const { form } = document.forms;
    const inputName = form.username;
    const inputEmail = form.email;
    const inputUserPhone = form.userphone;
    const inputCompanyName = form.companyname;
    const formError = document.querySelectorAll('.form-error');

    form.addEventListener('submit', (form) => {
      if (inputName.value === '' || inputName.value == null) {
        inputName.nextElementSibling.innerHTML = 'This field is required';
        inputName.style = `
				border-color: #EA2F2F;
				background: #FCD8D8
				`;
      } else if (inputName.value.length > 0) {
        inputName.nextElementSibling.innerHTML = '';
        inputName.style = `
				border-color: #1968B3;
				background: #E7EEFF
				`;
      }
      if (inputEmail.value === '' || inputEmail.value == null) {
        inputEmail.nextElementSibling.innerHTML = 'This field is required';
        inputEmail.style = `
				border-color: #EA2F2F;
				background: #FCD8D8
				`;
      } else if (inputEmail.value.length > 0) {
        inputEmail.nextElementSibling.innerHTML = '';
        inputEmail.style = `
				border-color: #1968B3;
				background: #E7EEFF
				`;
      }
      if (inputUserPhone.value === '' || inputUserPhone.value == null) {
        inputUserPhone.nextElementSibling.innerHTML = 'This field is required';
        inputUserPhone.style = `
				border-color: #EA2F2F;
				background: #FCD8D8
				`;
      } else if (inputUserPhone.value.length > 0) {
        inputUserPhone.nextElementSibling.innerHTML = '';
        inputUserPhone.style = `
				border-color: #1968B3;
				background: #E7EEFF
				`;
      }
      if (inputCompanyName.value === '' || inputCompanyName.value == null) {
        inputCompanyName.nextElementSibling.innerHTML = 'This field is required';
        inputCompanyName.style = `
				border-color: #EA2F2F;
				background: #FCD8D8
				`;
      } else if (inputCompanyName.value.length > 0) {
        inputCompanyName.nextElementSibling.innerHTML = '';
        inputCompanyName.style = `
				border-color: #1968B3;
				background: #E7EEFF
				`;
      }

      formError.forEach((formError) => {
        if (formError.innerHTML.length > 0) {
          form.preventDefault();
        }
      });
    });
  };
  if (document.forms.form) {
    forms();
  }

  // Select Languages
  const select = function () {
    const selectHeader = document.querySelectorAll('.select__header');
    const selectItem = document.querySelectorAll('.select__item');

    selectHeader.forEach((item) => {
      item.addEventListener('click', selectToggle);
    });

    selectItem.forEach((item) => {
      item.addEventListener('click', selectChoose);
    });

    function selectToggle() {
      this.parentElement.classList.toggle('is-active');
    }

    function selectChoose() {
      const text = this.innerText;
      const select = this.closest('.select');
      const currentText = select.querySelector('.select__current');

      const selectBody = this.closest('.select__body');
      div = document.createElement('div'),
      selectBody.append(div);
      selectBody.lastElementChild.classList.add('select__item');
      selectBody.lastElementChild.innerHTML = currentText.innerText;

      currentText.innerText = text;
      this.remove();
      select.classList.remove('is-active');
    }
  };

  select();

  // Home Slider
		var homeSlider = new Swiper('.swiper-container', {
			loop: true,
			slidesPerView: 2,
			spaceBetween: 65,
			thumbs: {
				swiper: homeSliderArrows,
			},
			breakpoints: {
				768: {
						slidesPerView: 3,
				},
				992: {
						slidesPerView: 6,
				},
			}
		});
			
			var homeSliderArrows = new Swiper('.swiper-container-arrows', {
				loop: true,
				slidesPerView: 2,
				spaceBetween: 65,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				thumbs: {
					swiper: homeSlider,
				},
				breakpoints: {
					768: {
							slidesPerView: 3,
					},
					992: {
							slidesPerView: 6,
					}
				}
			});

  // Advantages Block
	const advantagesRow = document.querySelector('.advantages__row');
	if (advantagesRow) {
		if (clientWidth >= 768) {
			advantagesRow.lastElementChild.firstElementChild.firstElementChild.style = `
			border-right: none; border-bottom: none`;
			advantagesRow.lastElementChild.firstElementChild.firstElementChild.nextElementSibling.style = `
			border-right: none; border-bottom: none`;
			advantagesRow.lastElementChild.firstElementChild.lastElementChild.style = `
			border-bottom: none`;
			const advantagesRowSecond = advantagesRow.nextElementSibling;
			advantagesRowSecond.firstElementChild.firstElementChild.firstElementChild.style = `
			border-right: none`;
			advantagesRowSecond.firstElementChild.firstElementChild.firstElementChild.nextElementSibling.style = `
			border-right: none`;
		}
	}



  // Freight Block
	const freightRow = document.querySelector('.freight__row');
	if (freightRow) {
		if (clientWidth >= 768) {
			freightRow.firstElementChild.firstElementChild.style = `
			border-right: none; border-bottom: none`;
			freightRow.firstElementChild.firstElementChild.nextElementSibling.style = `
			border-right: none; border-bottom: none`;
			freightRow.firstElementChild.lastElementChild.style = `
			border-bottom: none`;
			const freightRowSecond = freightRow.nextElementSibling;
			freightRowSecond.firstElementChild.firstElementChild.style = `
			border-right: none`;
			freightRowSecond.firstElementChild.firstElementChild.nextElementSibling.style = `
			border-right: none`;
		}
	}

});
