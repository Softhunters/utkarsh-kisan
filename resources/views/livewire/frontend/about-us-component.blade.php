<div>
    @include('flash-message')
    <div class="inner-page-banner">
        {{-- <div class="breadcrumb-vec-btm">
            <img class="img-fluid" src="assets/images/bg/inner-banner-btm-vec.png" alt />
        </div> --}}
        <div class="container">
            <div class="row justify-content-center align-items-center text-center">
                <div class="col-lg-6 align-items-center">
                    <div class="banner-content">
                        <h1>About Utkarsh Kisan</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">About Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="banner-img d-lg-block d-none">
                        {{-- <div class="banner-img-bg">
                            <img class="img-fluid" src="{{asset('assets/images/bg/inner-banner-vec.png')}}" alt />
                        </div> --}}
                        <img class="img-fluid" src="{{ asset('assets/images/bg/inner-banner-img.png') }}" alt />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h1-story-area two mb-120 pt-120 ">
        <div class="container">
            <div class="row g-lg-4 gy-5">
                <div class="col-lg-6"> 
                    <div class="section-title1  ">
                        <span class="about_title"><img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}" alt />Our Story<img
                                src="{{ asset('assets/images/icon/section-vec-r1.svg') }}" alt /></span>
                        <h2>Empowering India’s Farmers. Connecting Every Home to the Farm.</h2>
                    </div>
                    <div class="story-content">
                        <p>
                            Utkarsh Kisan is a transformative agri-commerce platform built in India with a singular
                            vision — to bridge the digital divide between the farmers who grow and the consumers who
                            rely on their produce. Rooted in our nation’s agricultural heritage and powered by modern
                            technology, we aim to redefine how agricultural trade happens in India.
                        </p>
                        <div class="story-title-reviews  ">
                            <h3 class="about_title"> <span> Our Mission </span> </h3>
                            {{-- <div class="review">
                                <p>Based on <a href="#">20,921 reviews</a></p>
                                <img src="{{asset('assets/images/icon/trastpilot.svg')}}" alt />
                            </div> --}}
                        </div>
                        <p>
                            We are committed to creating a transparent, trustworthy, and equitable supply chain where
                            every farmer is respected, every buyer is protected, and every transaction is smooth. By
                            integrating digital solutions into the rural economy, Utkarsh Kisan promotes fair pricing,
                            direct market access, and technology-led growth for India’s agricultural sector.
                        </p>
                        <div class="story-title-reviews about_title">
                            <h3 class="about_title"> <span> Our Vision </span> </h3>

                        </div>
                        <p>
                            To become India’s most trusted agri-commerce brand by enabling direct-from-farm delivery of
                            fresh, verified produce to households, institutions, and businesses across the country. Our
                            vision is to

                            empower rural livelihoods while offering urban convenience, setting a benchmark for ethical
                            commerce in agriculture.
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 d-flex justify-content-lg-end justify-content-center">
                    <div class="story-img">
                        <img class="img-fluid" src="{{ asset('assets/images/bg/story-img.png') }}" alt />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h2-services-area mb-120 ">
        <div class="services-btm">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="services-img">
                            <div class="services-img-bg">
                                <img src="{{ asset('assets/images/icon/h2-work-img-bg.svg') }}" alt />
                            </div>
                            <img class="img-fluid" src="{{ asset('assets/images/bg/kisan-work.png') }}" alt />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="services-content">
                            <img src="{{ asset('assets/images/icon/section-no.svg') }}" alt />
                            <h2>How Utkarsh Kisan Works</h2>
                            <p>
                                We operate on a transparent and verified marketplace model that connects:
                            </p>
                            {{-- <p> 
                              <strong>  Buyer ↔ Utkarsh Kisan (Mediator) ↔ Seller (Farmer)  </strong>
                            </p> --}}
                            <div class="author-area">
                                <div class="author-quat">
                                    <p>
                                        <sup><img src="{{ asset('assets/images/icon/author-quat-icon.svg') }}"
                                                alt /></sup>
                                        Buyer ↔ Utkarsh Kisan (Mediator) ↔ Seller (Farmer)
                                    </p>
                                </div>
                                <div>
                                    <p> This ensures: </p>
                                </div>
                                <ul>
                                    <li> Sellers are verified, educated, and digitally enabled. </li>
                                    <li> Buyers receive genuine, quality-assured products. </li>
                                    <li> Our company manages logistics, payments, customer support, and dispute
                                        prevention through a centralized system. </li>
                                </ul>
                                <div> Every step of the process is monitored to avoid errors, overpricing, or fraud.
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="h1-choose-area mb-120 ">
        <div class="container">
            <div class="row g-lg-4 gy-5 justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title1 ">
                        <span class="about_title"><img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}" alt />Why Choose Us<img
                                src="{{ asset('assets/images/icon/section-vec-r1.svg') }}" alt /></span>
                        <h2>Why We Are Different .</h2>
                    </div>
                    <div class="choose-content">
                        {{-- <p>
                            Pellentesque maximus augue orci, quis congue purus iaculis id. Maecenas eudocl lorem quis massal molestie vulputate in sit amet diam. Cras eu odio sit amet ont tellus. Cras ut sollicitudin urna. Vivamus
                            blandit,
                        </p> --}}
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        01. Verified Farm-to-Home Model
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                    aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Only authentic farmers and vendors are listed.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        02. Fair Trade Principles
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Farmers receive the value they deserve. Buyers pay only for quality.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                        aria-expanded="false" aria-controls="collapseThree">
                                        03. Technology-Driven Transparency:
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        GPS-enabled sourcing, batch tracking, and real-time order updates.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFour"
                                        aria-expanded="false" aria-controls="collapseFour">
                                        04. Compliant by Design:
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        We operate in full alignment with the Indian Contract Act, Digital India
                                        policies, and agribusiness licensing norms.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseFive"
                                        aria-expanded="false" aria-controls="collapseFive">
                                        05. Dispute-Free System:
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Our digital process ensures clarity in pricing, delivery, and communication,
                                        reducing risk of any legal or commercial dispute.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8">
                    <div class="choose-img">
                        <div class="batch">
                            <img src="{{ asset('assets/images/icon/Vector.svg') }}" alt />
                            <span>
                                100% Safe<br />
                                Your Pet
                            </span>
                        </div>
                        <div class="choose-vector">
                            <img src="{{ asset('assets/images/icon/choose-vector1.svg') }}" alt />
                        </div>
                        <img class="img-fluid" src="{{ asset('assets/images/bg/choose-utkarsh.png') }}"
                            alt="choose-img" />
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="growth-journey-area mb-120 ">
    <div class="container">
        <div class="row g-lg-4 gy-5 align-items-center">
             <!-- Right Image -->
            <div class="col-lg-6 d-flex justify-content-center">
                <div class="growth-img">
                    <img class="img-fluid rounded " src="{{ asset('assets/images/bg/growth_image.png') }}" alt="Growth Journey Image" style="height:80% !important"/>
                </div>
            </div>
            <!-- Left Content -->
            <div class="col-lg-6">
                <div class="section-title1">
                    <span class="d-flex justify-content-start about_title">
                        <img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}" alt="vec-left" />
                        Our Growth Journey
                        <img src="{{ asset('assets/images/icon/section-vec-r1.svg') }}" alt="vec-right" />
                    </span>
                    <h2>Expanding Reach. Empowering Roots.</h2>
                </div>
                <div class="growth-content">
                    <p>
                        Launched with a focus on rural empowerment and consumer accessibility, Utkarsh Kisan is currently active across key agricultural regions and urban markets. Our expansion roadmap includes:
                    </p>
                    <ul class=" ps-3">
                        <li> PAN-India service coverage across 100+ districts</li>
                        <li> Multilingual app experience for regional outreach</li>
                        <li> Direct farmer onboarding programs in Tier 2 and Tier 3 regions</li>
                        <li> Partnerships with logistics and cooperative societies for scalable delivery</li>
                    </ul>
                </div>
            </div>

            
        </div>

        <!-- Join the Movement Section -->
        <div class="row mt-5 align-items-center">
            <div class="col-lg-12 text-center">
                <div class="section-title1">
                    <span>
                        <img src="{{ asset('assets/images/icon/section-vec-l1.svg') }}" alt="vec-left" />
                        Join the Movement
                        <img src="{{ asset('assets/images/icon/section-vec-r1.svg') }}" alt="vec-right" />
                    </span>
                    <h2>Towards Responsible Agriculture and Digital Bharat</h2>
                </div>
                <p class="mx-auto" style="max-width: 800px;">
                    Utkarsh Kisan is not just a platform — it's a movement towards responsible agriculture, inclusive commerce, and digital Bharat. Whether you're a farmer, a household, a vendor, or an institution — we welcome you to be part of a system that works for everyone.
                </p>
                <a href="#" 
                class="btn  mt-4 primary-btn1">
                    Join Us Today
                </a>
            </div>
        </div>
    </div>
</div>
 
</div>
