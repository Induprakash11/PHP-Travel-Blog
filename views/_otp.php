<div class="container-otp" style="min-height: 80vh; display: flex; justify-content: center; align-items: center; flex-direction: column;">
    <h2 class="mb-4">Verify Your Identity</h2>
    <p class="text-muted mb-4">Please enter the OTP sent to your registered email or phone number.</p>
    <form method="POST" style="width: 100%; max-width: 400px;">
        <?php Utils::displayFlash('otp_error','danger'); ?>
        <?php Utils::displayFlash('otpUser_error', 'danger'); ?>
        <?php Utils::displayFlash('otp error', 'danger'); ?>
        <?php Utils::displayFlash('Invalid_otp', 'danger'); ?>   
        <?php Utils::displayFlash('otp_success', 'success'); ?>
        <?php Utils::displayFlash('email_error', 'danger'); ?>
        <?php Utils::displayFlash('register otp veification', 'success'); ?>
        <?php Utils::displayFlash('otp resend success', 'success'); ?>
        <?php Utils::displayFlash('otp resend error', 'danger'); ?>
        <div class="form-group">
            <label for="otp">Enter OTP</label>
            <input type="text" id="otp" name="otp" class="form-control text-center" maxlength="6" pattern="\d{6}" placeholder="6-digit OTP" required>
            <small class="form-text text-muted">OTP is valid for 10 minutes.</small>
        </div>
        <button type="submit" name="verify_otp" class="btn btn-primary btn-block mt-3">Verify OTP</button>
    </form>
    <form method="POST" class="mt-3" style="width: 100%; max-width: 400px;">
        <button type="submit" name="resend_otp" class="btn btn-secondary btn-block">Resend OTP</button>
    </form>
    <div class="mt-4">
        <p class="text-muted">Having trouble? <a href="contact_support.php">Contact Support</a></p>
    </div>
</div>
