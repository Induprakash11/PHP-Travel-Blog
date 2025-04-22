// This function is used to toggle the icon of the navbar toggler button

function toggleIcon(button) {
    const icon = button.querySelector('.navbar-toggler-ico');
    const Test = document.querySelector('.navbar-toggler-text');
    if (button.getAttribute('aria-expanded') === 'true' || button.getAttribute('aria-expanded') === true) {
        icon.innerHTML = '<i class="fa fa-times"></i>'; // Change to close icon
        button.setAttribute('aria-expanded', 'true');
    } else {
        icon.innerHTML = '<i class="fa fa-bars"></i>'; // Change to menu icon
        button.setAttribute('aria-expanded', 'false');
    }
    }

// // Dark mode switch
// const switchMode = document.getElementById('switch-mode');

// switchMode.addEventListener('change', function () {
// 	if(this.checked) {
// 		document.body.classList.add('dark');
// 	} else {
// 		document.body.classList.remove('dark');
// 	}
// })