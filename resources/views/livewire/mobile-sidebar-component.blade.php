<div class="mobile-header" style="border-bottom:none; ">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-lg-12">
                            <div class="multiselect-bar">
                                <ul class="header-left-options">
                               <li class="link-item open-sidebar">
                                 FILTER
                                </li>
                            </ul>
                                <h6>shop</h6>
                                <div class="multiselect-area" wire:ignore>
                                    <div class="single-select">
                                        <span>Show</span>
                                        <select class="defult-select-drowpown" id="pagewsize" name="pagewsize" wire:model="pagesize">
                                            <option selected value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                        </select>
                                    </div>
                                    <div class="single-select two">
                                        <select class="defult-select-drowpown" id="eyes-dropdown" wire:model="sorting">
                                            <option value ="default" selected="selected">Default</option>
                                            <option value="date">Sort by newness</option>
                                            <option value="price">Sort by price: low to high</option>
                                            <option value="price-desc">Sort by price: high to low</option>
                                        </select>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
        
               
            </div>
            <div class="menu-sidebar ">
                        <div class="close">
                    <i class="fa fa-xmark"></i>  
                        </div>
                    
                     <div class="col-lg-3">
                    <div class="shop-sidebar">
                         <div class="shop-widget">
                                    <h5 class="shop-widget-title">Price Range</h5>
                                    <div class="range-widget" wire:ignore>
                                        <div id="slider-rangem" class="price-filter-range" ></div>
                                        <div class="mt-25 d-flex justify-content-between gap-5">
                                              
                                            <input type="number" min="10" max="{{$max -1}}" oninput="validity.valid||(value='10');" id="min_pricem" class="price-range-field rans " />
                                            <input type="number" min="10" max="{{$max}}" oninput="validity.valid||(value={{$max}});" id="max_pricem" class="price-range-field rans" />
                                        </div>
                                    </div>
                        </div>
                        <div class="shop-widget">
                            <div class="check-box-item">
                                <h5 class="shop-widget-title">Category</h5>
                                <div class="checkbox-container">
                                    @foreach($categorys as $category)
                                    <a href="{{route('product.category',['category_slug'=>$category->slug])}}"><label class="containerss">
                                            {{$category->name}}
                                            
                                            
                                        </label></a>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <div class="check-box-item">
                                <h5 class="shop-widget-title">Brand</h5>
                                <div class="checkbox-container">
                                    @foreach($brands as $brand)
                                        <label class="containerss">
                                            {{$brand->brand_name}}
                                            <input type="checkbox"  wire:model="brandtype" value="{{$brand->id}}"  wire:click="brandseletc"/>
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>   
                   

            </div>
        </div>
        <div class="overlay"></div>
</div>


@push ('scripts')
<script src="{{asset('assets/js/jquery.nice-number.min.js')}}"></script>
<script>
    if ($('input[type="number').length) {
        $('input[type="number"]').niceNumber({ buttonDecrement: '<i class="bi bi-dash"></i>', buttonIncrement: '<i class="bi bi-plus"></i>' });
    }
</script>
<script>

$(function () {
        $("#slider-rangem").slider({
            range: true,
            orientation: "horizontal",
            min: 10,
            max: <?php echo $max ?> ,
            values: [0, <?php echo $max/2 ?>],
            step: 10,
            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $("#min_pricem").val(ui.values[0]);
                $("#max_pricem").val(ui.values[1]);
            },
        });
        $("#min_pricem").val($("#slider-rangem").slider("values", 0));
        $("#max_pricem").val($("#slider-rangem").slider("values", 1));
    });
		
        $("#min_pricem,#max_pricem").on("change", function () {
        // $("#price-range-submit").show();
        var min_price_range = $("#min_pricem").val();
        var max_price_range = $("#max_pricem").val();
        if (min_price_range > max_price_range) {
            $("#max_pricem").val(min_price_range);
        }
       // alert(min_price_range);
        @this.set('min_price',min_price_range);
         @this.set('max_price',max_price_range);
        $("#slider-rangem").slider({ values: [min_price_range, max_price_range] });
        // alert(min_price_range);
        
    });
    $("#min_pricem,#max_pricem").on("paste keyup", function () {
        $("#price-range-submit").show();
        var min_price_range = $("#min_pricem").val();
        var max_price_range = $("#max_pricem").val();
        if (min_price_range == max_price_range) {
            max_price_range = min_price_range + 10;
            $("#min_pricem").val(min_price_range);
            $("#max_pricem").val(max_price_range);
        }
        @this.set('min_price',min_price_range);
         @this.set('max_price',max_price_range);
        $("#slider-rangem").slider({ values: [min_price_range, max_price_range] });
    });
    $("#slider-rangem").on("click", function () {
        var min_price = $("#min_pricem").val();
        var max_price = $("#max_pricem").val();
        
             @this.set('min_price',min_price);
         @this.set('max_price',max_price);
            
        // $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
    });
	</script>
<script>
     $(document).on("click", ".search_overlay", function (event) {
        $(".search-content").find('.search-product').addClass('d-none');
        $("body").find('.search_overlay').remove();
        $(".header , .announcement-header").attr({ "style": "" });
        $("body").attr({ "style": "" });
    });

    $(".open-sidebar").on("click", function (event) {
        $('.menu-sidebar').addClass("show");
        $('.overlay').addClass("show");
    });
    // $(".open-sidebars").on("click", function (event) {
    //     // alert('gfd');
    //     $('.menu-sidebars').addClass("show");
    //     $('.overlays').addClass("show");
    // });
    $(".close").on("click", function (event) {
        $('.menu-sidebar').removeClass("show");
        $('.overlay').removeClass("show");
    });
    $(".overlay").on("click", function (event) {
        $('.menu-sidebar').removeClass("show");
        $('.overlay').removeClass("show");
    });
</script>

<script>
     $(document).on("click", ".search_overlay", function (event) {
        $(".search-content").find('.search-product').addClass('d-none');
        $("body").find('.search_overlay').remove();
        $(".header , .announcement-header").attr({ "style": "" });
        $("body").attr({ "style": "" });
    });

    $(".open-sidebar").on("click", function (event) {
        $('.menu-sidebar').addClass("show");
        $('.overlay').addClass("show");
    });
    // $(".open-sidebars").on("click", function (event) {
    //     // alert('gfd');
    //     $('.menu-sidebars').addClass("show");
    //     $('.overlays').addClass("show");
    // });
    $(".close").on("click", function (event) {
        $('.menu-sidebar').removeClass("show");
        $('.overlay').removeClass("show");
    });
    $(".overlay").on("click", function (event) {
        $('.menu-sidebar').removeClass("show");
        $('.overlay').removeClass("show");
    });
</script>






@endpush