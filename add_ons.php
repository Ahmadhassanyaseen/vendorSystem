<?php
$page = 'addOns';
require_once './config.php';
require_once './session.php';
require_once './header.php';
require_once './header_nav.php';
?>
<style>
    .f32 {
        font-size: 32px !important;
    }

    .f20 {
        font-size: 20px !important;
    }

    .f56 {
        font-size: 56px !important;
    }

    .f16 {
        font-size: 16px !important;
        padding: 8px 0px;

    }

    .secp {
        padding: 24px 15px 48px !important;
    }

    .p24 {
        padding: 24px !important;
    }

    .seeMore {
        font-size: 20px !important;
        padding: 6px 12px !important;
    }
</style>

<div class="m-0 mt-5 row w-100">
    <div class="me-auto ms-auto row w-100 p-0" style="margin-left: 3px;">
        <section class="bg-secondary pb-5 pt-4 secp">
            <div class="container  pb-4">
                <div class="text-center">
                    <h3 class="bg-info-subtle fw-bold  mb-3 mt-4 f32">Vendor System Module Add Ons</h3>
                    <p class="fst-italic fw-bold mb-4 text-dark f16">Specialized add-ons to maximize your company and vehicle exposure. Get more leads booked more often!</p>
                </div>
                <div class="align-items-center justify-content-center row">
                    <div class="col-lg-4 col-md-6 py-0">
                        <div class="text-secondary p24">
                            <div class="bg-white mb-3 p-4 pricing_items__price_info rounded shadow">
                                <h4 class="fw-bold h2 mb-0 text-primary f32">Top Level Search</h4>
                                <div class="align-items-center d-flex fw-light h5 mt-3">
                                    <span class="align-self-start currency fw-bold f20">$</span> <span class="display-4 fw-bold text-dark f56">24</span> <span class="align-self-end fw-bold term f20">/mo. Per Vehicle&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;(60 Day FREE Trial)</span>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded shadow">
                                <ul class="list-unstyled mb-4">
                                    <li class="pb-2 pt-2 text-dark-emphasis  f16">Set Your Mile Radius</li>
                                    <li class="pb-2 pt-2 text-dark-emphasis f16">Better Booking Chances</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Client Sees your vehicles first</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Show 1st on vehicle search pages</li>
                                </ul> <a href="#" class="btn btn-outline-dark d-block fs-5 fst-italic fw-semibold rounded-pill text-primary w-100 seeMore">See More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 py-0">
                        <div class="text-secondary p24">
                            <div class="bg-white mb-3 p-4 pricing_items__price_info rounded shadow">
                                <h4 class="fw-bold h2 mb-0 text-primary f32">Automated Leads</h4>
                                <div class="align-items-center d-flex fw-light h5 mt-3">
                                    <span class="align-self-start currency fw-bold f20">$</span> <span class="display-4 fw-bold text-dark f56">49</span>
                                    <span class="align-self-end fw-bold term f20">/mo. Per Account&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; (60 Day FREE Trial)</span>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded shadow">
                                <ul class="list-unstyled mb-4">
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Set your mile radius</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Be the 1st to respond</li>
                                    <li class="pb-2 pt-2 text-dark-emphasis f16">Client can book instantly</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Get local leads sent imediately.</li>
                                </ul> <a href="#" class="btn btn-outline-dark d-block fs-5 fst-italic fw-semibold rounded-pill text-primary w-100 seeMore">See More Details</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 py-0">
                        <div class="text-secondary p24">
                            <div class="bg-white mb-3 p-4 pricing_items__price_info rounded shadow">
                                <h4 class="fw-bold h2 mb-0 text-primary f32">Custom SEO Page</h4>
                                <div class="align-items-center d-flex fw-light h5 mt-3">
                                    <span class="align-self-start currency fw-bold f20">$</span> <span class="display-4 fw-bold text-dark f56">99</span>
                                    <span class="align-self-end fw-bold term f20">/ 1 Time Setup Fee Per </br> Page</span>
                                </div>
                            </div>
                            <div class="bg-white p-4 rounded shadow">
                                <ul class="list-unstyled mb-4">
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Get more direct leads</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Be seen on all search engines</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Rank #1 for maximum exposure</li>
                                    <li class="pb-2 pt-2 text-capitalize text-dark-emphasis f16">Custom vehicle page on our website</li>
                                </ul> <a href="#" class="btn btn-outline-dark d-block fs-5 fst-italic fw-semibold rounded-pill text-primary w-100 seeMore">See More Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>


<?php
require_once './footer.php';
?>