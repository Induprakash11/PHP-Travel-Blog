<div class="container" style="min-height: 80vh;">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card my-5 shadow">
                    <div class="card-header">
                        <h3>Register OTP</h3>
                    </div>
                    <div class="card-body">
                        <?php echo Utils::displayFlash('otp_error', 'danger'); ?>
                        <form method="POST" class="card-body p-4">
                            <div class="mb-3">
                                <label for="otp" class="form-label">OTP Code</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="otp"
                                    name="otp"
                                    placeholder="Enter the OTP sent to your email"
                                    required
                                />
                            </div>
                                <button type="submit" name="verify_otp" class="btn">Verify OTP</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>