<div class="col-lg-12 d-flex justify-content-between">
    <div class="contact-number">
        <a href="tel:{{$setting->phone}}"><img src="{{asset('assets/images/icon/support2.svg')}}" alt="" /> {{$setting->phone}}</a>
    </div>
    <div class="opening-time text-center search-bar-input">
        <!-- <p>Free Shipping On Shipment of $80 Or More</p> -->
        <form action="" >
        <div class="search-bar">
            <input type="text" name="search"  placeholder="Search anything here..." />
        </div>
        </form>
    </div>
    <div class="social-area">
        <ul>
            <li>
                <a href="{{$setting->facebook}}" target="_blank"><i class="bx bxl-facebook"></i></a>
            </li>
            <li>
                <a href="{{$setting->twiter}}"><i class="bx bxl-twitter"></i></a>
            </li>
            <li>
                <a href="{{$setting->pinterest}}"><i class="bx bxl-pinterest-alt"></i></a>
            </li>
            <li>
                <a href="{{$setting->instagram}}"><i class="bx bxl-instagram"></i></a>
            </li>
        </ul>
    </div>
</div>