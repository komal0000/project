@php
    $data = getSetting('contact') ?? ((object)([
            'map' => '',
            'email' => '',
            'phone' => '',
            'addr' => '',
            'others' => [],

        ]));
@endphp
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <h2 class="mb-4">Leave Us A Message</h2>

                <form>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="name" placeholder="Your Name">
                                <label for="name">Your Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" placeholder="Your Email">
                                <label for="email">Your Email</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="subject" placeholder="Subject">
                                <label for="subject">Subject</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a message here" id="message"
                                    style="height: 100px"></textarea>
                                <label for="message">Message</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary py-3 px-5" type="submit">Send Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h2 class="mb-4">Contact Details</h2>
                <div class="d-flex border-bottom pb-3 mb-3">
                    <div class="flex-shrink-0 btn-square bg-primary text-white rounded-circle">
                        <i class="fa text-white fa-map-marker-alt "></i>
                    </div>
                    <div class="ms-3">
                        <h6>Our Office</h6>
                        <span>{{$data->addr}}</span>
                    </div>
                </div>
                <div class="d-flex border-bottom pb-3 mb-3">
                    <div class="flex-shrink-0 btn-square bg-primary text-white rounded-circle">
                        <i class="fa text-white fa-phone-alt "></i>
                    </div>
                    <div class="ms-3">
                        <h6>Call Us</h6>
                        <span>{{$data->phone}}</span>
                    </div>
                </div>
                <div class="d-flex pb-3 mb-3">
                    <div class="flex-shrink-0 btn-square bg-primary text-white rounded-circle">
                        <i class="fa text-white fa-envelope  "></i>
                    </div>
                    <div class="ms-3">
                        <h6>Mail Us</h6>
                        <span>{{$data->email}}</span>
                    </div>
                </div>

                <div style="min-height:250px">
                    <div class="position-relative rounded overflow-hidden h-100">
                        <iframe class="position-relative w-100 h-100"
                            src="https://maps.google.com/maps?q={{$data->map}}&t=&z=13&ie=UTF8&iwloc=&output=embed"
                            frameborder="0" style="min-height: 450px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
