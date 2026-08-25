<!-- booking-area -->
<div class="booking-area wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="booking-form padding-bottom-40">
                    <form action="send_mail.php" method="POST">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="input-wrapper">
                                    <input class="form-item2" type="text" name="name" placeholder="Full Name" required>
                                    <span class="icon"><i class="icofont-ui-user"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-wrapper">
                                    <input class="form-item2" type="tel" name="phone" placeholder="Phone No" required>
                                    <span class="icon"><i class="icofont-phone"></i></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <select class="form-item2 input-wrapper" name="service" required>
                                    <option value="">Select service</option>
                                    <option value="Diagnostic Services">Diagnostic Services</option>
                                    <option value="Products">Products</option>
                                    <option value="Repair">Repair</option>
                                </select>
                            </div>
                            <div class="col-lg-3">
                                <button class="btn2" type="submit">Booking Now</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>