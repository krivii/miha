<!--Section: Contact v.2-->
<section class="mb-4">

    <!--Section heading-->
    <h2 class="h1-responsive font-weight-bold text-center my-4">Contact us</h2>
    <!--Section description-->
    <p class="text-center w-responsive mx-auto mb-5">Do you have any questions? Please do not hesitate to contact us directly. Our team will come back to you within
        a matter of hours to help you.</p>

    <?php if(isset($validation)) : ?>
        <div class="text-danger">
            <?= $validation->listErrors() ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <!--Grid column-->
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="contact" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <?php if (session()->get('isLoggedIn')) : ?>

                                <input value="<?= session()->get('email') ?>" type="text" id="useremail" name="useremail" class="form-control">
                                <label  for="useremail" class="">Your email</label>
                            <?php else : ?>
                                <input value="<?= isset($_POST['useremail']) ? set_value('useremail'): '' ?>" type="text" id="useremail" name="useremail" class="form-control">
                                <label  for="useremail" class="">Your email</label>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input value="<?= isset($_POST['subject']) ? set_value('subject'): '' ?>" type="text" id="subject" name="subject" class="form-control">
                            <label  for="subject" class="">Subject</label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <div class="md-form">
                            <textarea id="message" name="message" rows="2" class="form-control md-textarea"><?= isset($_POST['message']) ? set_value('message') : '' ?></textarea>

                            <label  for="message">Your message</label>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 10px" class="row">
                    <button class="btn btn-success" name="contact" type ="submit" value="submit">Send</button>
                </div>
            </form>


            <div class="status"></div>
        </div>
        <!--Grid column-->

        <!--Grid column-->
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>San Francisco, CA 94126, USA</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>+ 01 234 567 89</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>contact@mdbootstrap.com</p>
                </li>
            </ul>
        </div>
        <!--Grid column-->

    </div>

</section>
<!--Section: Contact v.2-->

