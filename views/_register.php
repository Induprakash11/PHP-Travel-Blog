<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card my-5 shadow">
                <div class="card-header text-center">
                    <h2>Register</h2>
                </div>
                <div class="card-body">
                    <?php echo Utils::displayFlash('', 'danger'); ?>
                <form method="POST" class="card-body p-4">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input
                            type="text"
                            class="form-control"
                            id="username"
                            name="username"
                            placeholder="Enter your name"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Enter your email"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            placeholder="Enter your password"
                            required />
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="register" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <div class="mt-3">
                        <p>Already have an account ?  <a href="login">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>