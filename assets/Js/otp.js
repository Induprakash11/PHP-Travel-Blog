document.addEventListener('DOMContentLoaded', function () {
    const otpInput = document.getElementById('otp');
    const otpForm = document.getElementById('otpForm');
    const resendBtn = document.getElementById('resendBtn');
    const resendForm = document.getElementById('resendForm');
    const timerElement = document.getElementById('timer');

    // Auto-submit OTP form when 6 digits are entered
    otpInput.addEventListener('input', function () {
        if (otpInput.value.length === 6 && /^\d{6}$/.test(otpInput.value)) {
        otpForm.submit();
        }
    });

    resendForm.addEventListener('submit', function (event) {
        if (otpInput.value.length !== 6 || !/^\d{6}$/.test(otpInput.value)) {
        event.preventDefault();
        alert('Please enter a valid 6-digit OTP before resending.');
        }
    });

    // Handle resend button with 10-second limit
    let resendCooldown = 60; // Cooldown in seconds
    resendBtn.disabled = true;
    timerElement.textContent = `You can resend OTP in ${resendCooldown} seconds.`;

    const countdown = setInterval(() => {
        resendCooldown--;
        if (resendCooldown <= 0) {
            clearInterval(countdown);
            resendBtn.disabled = false;
            timerElement.textContent = 'You can resend OTP now.';
        } else {
            timerElement.textContent = `You can resend OTP in ${resendCooldown} seconds.`;
        }
    }, 1000);
});