<?php require_once __DIR__ . '/../controllers/load.php';
?>
<section id="contact" class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="text-center mb-4" data-aos="zoom-in">Enquire Me</h2>
            <form method="POST" enctype="multipart/form-data">
                <div data-aos="fade-right" role="alert">
                <?php Utils::displayFlash('mail send error','danger');
                Utils::displayFlash('mail send success','success');
                Utils::displayFlash('field empty error', 'warning'); ?>
                </div>

                <div class="mb-3" data-aos="fade-right" data-aos-duration="1500">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Your Name" required>
                </div>
                <div class="mb-3" data-aos="fade-left" data-aos-duration="1500">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
                <div class="mb-3" data-aos="fade-right" data-aos-duration="1500">
                    <label for="mobile" class="form-label">Mobile No</label>
                    <input type="mobile" class="form-control" name="mobile" id="mobile" placeholder="Your Mobile No" required>
                </div>
                <div class="mb-3" data-aos="fade-left" data-aos-duration="1500">
                    <label for="message" class="form-label">Message</label>
                    <textarea class="form-control" name="message" id="message" rows="3" placeholder="Your Message" required ></textarea>
                </div>
                <div>
                <button class="btn-red" type="submit" name="sendMail" data-aos="fade-up" data-aos-duration="1500">
                Send Message</button>
                </div>
            </form>
        </div>
    </div>
</section>
