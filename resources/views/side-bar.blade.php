<div class="service-sidebar mt-5 mt-lg-0">
    <!--Start Services Details Sidebar Single-->
    <div class="sidebar-widget service-sidebar-single mb-0">
        <div class="sidebar-service-list mb-30">
            <h4 class="title">More Services</h4>
            <ul>
                <li><a href="{{route('web-development')}}" class="current"><i class="far fa-arrow-right"></i><span>Web Development</span></a></li>
                <li class="current"><a href="{{route('social-media-promotions')}}"><i class="far fa-arrow-right"></i><span>Social Media Promotions</span></a></li>
                <li><a href="{{route('brand-marketing')}}"><i class="far fa-arrow-right"></i><span>Brand Marketing</span></a></li>
                <li><a href="{{route('video-ads-production')}}"><i class="far fa-arrow-right"></i><span>Video ads/production</span></a></li>
                <li><a href="{{route('graphic-design')}}"><i class="far fa-arrow-right"></i><span>Graphic design</span></a></li>
                <li><a href=""><i class="far fa-arrow-right"></i><span>Mobile Solutions</span></a></li>
                <li><a href=""><i class="far fa-arrow-right"></i><span>App Development</span></a></li>
            </ul>
        </div>
        <div class="sidebar-service-list contact-widget mb-30">
            <h4 class="title">Contact With us</h4>
            <ul class="address">
                <li>New Rajdhani Enclave, </li>
                <li>Swasthya Vihar, Delhi, 110092</li>
                <li><a href=""><span class="__cf_email__">example@gmail.com</span></a></li>
                <li><a href="tel:9873501404">+91 98735 01404</a></li>
            </ul>
        </div>
        <div class="sidebar-service-list more-serive mb-0">
            <h4 class="title">More Services</h4>
            <form id="contactForms" action="{{route('contact.submit')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mb-20">
                            <input name="name" id="name" class="form-control bg-white" type="text" placeholder="Your Name">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-20">
                            <input name="email" id="email" class="form-control bg-white" type="email" placeholder="Email Address">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="mb-0">
                            <textarea  class="form-control bg-white" name="message" id="message" rows="5" placeholder="Write a Message"></textarea>
                            <button type="submit" class="ks-btn-black blue-bg mt-3" data-loading-text="Please wait...">
                                <span>
                                    <span class="text-1">Send Message Us</span>
                                    <span class="text-2">Send Message Us</span>
                                </span>
                                <i>
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                    </svg>
                                    <svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10.0035 3.90804L1.41153 12.5L0 11.0885L8.59097 2.49651H1.01922V0.5H12V11.4808H10.0035V3.90804Z" fill="white"></path>
                                    </svg>
                                </i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End Services Details Sidebar-->
</div>