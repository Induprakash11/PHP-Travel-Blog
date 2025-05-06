document.addEventListener('DOMContentLoaded', function () {
    const otpInput = document.getElementById('otp');
    const verifyBtn = document.getElementById('verifyBtn');
    const resendBtn = document.getElementById('resendBtn');
    const resendForm = document.getElementById('resendForm');
    const timerElement = document.getElementById('timer');

    // Auto-submit OTP form when 6 digits are entered
    otpInput.addEventListener('input', function () {
        if (otpInput.value.length === 6 && /^\d{6}$/.test(otpInput.value)) {
        verifyBtn.click();
        }
    });

    resendForm.addEventListener('submit', function (event) {
        if (otpInput.value.length !== 6 || !/^\d{6}$/.test(otpInput.value)) {
        event.preventDefault();
        alert('Please enter a valid 6-digit OTP before resending.');
        }
    });

    // Handle resend button with 60-second limit by hiding and showing
    let resendCooldown = 60; 
    resendBtn.style.display = 'none'; 
    timerElement.style.display = 'block'; 
    timerElement.textContent = `You can resend OTP in ${resendCooldown} seconds.`;

    const countdown = setInterval(() => {
        resendCooldown--;
        if (resendCooldown <= 0) {
            clearInterval(countdown);
            resendBtn.style.display = 'inline-block'; 
            timerElement.style.display = 'none'; 
        } else {
            timerElement.textContent = `You can resend OTP in ${resendCooldown} seconds.`;
        }
    }, 1000);
});