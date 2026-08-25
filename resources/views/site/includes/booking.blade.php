<!-- booking-area -->
<div class="booking-area wow fadeInUp">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="booking-form padding-bottom-40">
                    <form action="{{ route('appointments.create') }}" method="GET">
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
                                    @foreach($activeServices ?? [] as $svc)
                                        <option value="{{ $svc->id }}">{{ $svc->name }}</option>
                                    @endforeach
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
