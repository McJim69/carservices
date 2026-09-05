<!-- Booking Start -->
    <div class="container-fluid bg-secondary booking my-5 wow fadeInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 py-5">
                    <div class="py-5">
                        <h1 class="text-white mb-4"><?php echo _CERTCAR;?></h1>
                        <p class="text-white mb-0"><?php echo _ALSOSRV;?></p>
                    </div>
                </div>
                <div class="col-lg-6" style="padding:20px">
                    <div class="bg-primary h-100 d-flex flex-column justify-content-center text-center p-5 wow zoomIn" data-wow-delay="0.6s">
                        <h1 class="text-white mb-4">Book For A Service</h1>
                        <form action="https://api.web3forms.com/submit" method="POST">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
									<input type="hidden" name="access_key" value="6e6990de-3885-4a50-b03d-38b1b15f230b">
                                    <input type="text" class="form-control border-0" name="name" placeholder="Your Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="email" name="email" class="form-control border-0" placeholder="Your Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select border-0" style="height: 55px;">
                                        <option selected>Select A Service</option>
                                        <option value="1">Home Appliance</option>
                                        <option value="2">Office Aircon</option>
                                        <option value="3">Home Aircon</option>
										<option value="4">Car Aircon</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="date" id="date1" data-target-input="nearest">
                                        <input type="text"
                                            class="form-control border-0 datetimepicker-input"
                                            placeholder="Service Date" data-target="#date1" data-toggle="datetimepicker" style="height: 55px;">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control border-0" name="message" placeholder="Special Request" required></textarea>
                                </div>
                                <div class="col-12">
									<input type="hidden" name="redirect" value="https://louiecaraircon.com/thanks.php">
                                    <button class="btn btn-secondary w-100 py-3" type="submit">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- Booking End -->