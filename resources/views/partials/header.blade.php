<header class="header header-light header-topbar header-topbar8" id="navbar-spy">
    <!-- Start .top-bar-->
    <div class="top-bar top-bar-5">
        <div class="block-left"> 
            <p class="headline"> 
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="18" height="18">
                <g>
                <g>
                    <g>
                    <path class="shp0" d="M10 10L8 10L8 4L10 4L10 10ZM9 14.3C8.28 14.3 7.7 13.72 7.7 13C7.7 12.28 8.28 11.7 9 11.7C9.72 11.7 10.3 12.28 10.3 13C10.3 13.72 9.72 14.3 9 14.3ZM12.73 0L5.27 0L0 5.27L0 12.73L5.27 18L12.73 18L18 12.73L18 5.27L12.73 0Z"></path>
                    </g>
                </g>
                </g>
            </svg>Express delivery and free returns within 24 hours
            </p>
        </div>
        <div class="block-right">
            <div class="top-contact">
            <div class="contact-infos"><i class="fas fa-phone-alt"></i>
                <div class="contact-body"> <a href="tel:123-456-7890">emergency line: 002 010612457410</a></div>
            </div>
            <div class="contact-infos"><i class="fas fa-map-marker-alt"></i>
                <div class="contact-body"> <a href="#">location: brooklyn, new york</a></div>
            </div>
            <div class="contact-infos"><i class="fas fa-clock"></i>
                <div class="contact-body"> 
                <p>Mon-Fri: 8am – 7pm</p>
                </div>
            </div>
            </div>
        </div>
    </div>
    <!-- End .top-bar-->
    
    <nav class="navbar navbar-expand-xl navbar-sticky" id="primary-menu">
        <a class="navbar-brand" href="">
            <img class="logo logo-dark" src="{{ asset('assets/images/logo/logo-dark.svg') }}" alt="Medisch Logo"/>
            <img class="logo logo-mobile" src="{{ asset('assets/images/logo/logo-mobile.svg') }}" alt="Medisch Logo"/>
        </a>
        
        <div class="module-holder module-holder-phone">
            <!-- Start Module Search -->
            <div class="module module-search float-left">
                <div class="module-icon search-icon"><i class="icon-search" data-hover=""></i></div>
            </div>
            
            <!-- Start .module-cart -->
            <div class="module module-cart">
                <div class="module-icon cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="title">shop cart</span>
                    <label class="module-label">2</label>
                </div>
                <div class="cart-box">  
                    <ul class="cart-overview">
                        <li> 
                            <img src="{{ asset('assets/images/shop/thumb/1.jpg') }}" alt=""/>
                            <div class="product-meta"> 
                                <h5>natural cacao powder</h5>
                                <p>$ 10.00</p>
                            </div>
                            <a class="cart-cancel" href="#"><i class="fas fa-times"></i></a>
                        </li>
                        <li> 
                            <img src="{{ asset('assets/images/shop/thumb/2.jpg') }}" alt=""/>
                            <div class="product-meta"> 
                                <h5>biotin complex</h5>
                                <p>$ 16.00</p>
                            </div>
                            <a class="cart-cancel" href="#"><i class="fas fa-times"></i></a>
                        </li>
                    </ul>
                    <span>total: <i class="total-price">$26.00</i></span>
                    <div class="cart--control"> 
                        <button class="btn">view cart</button>
                    </div>
                </div>
            </div>
            
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            @include('partials.navigation')
            
            <div class="module-holder">
                <!-- Start .module-cart -->
                <div class="module module-cart">
                    <div class="cart-box">  
                        <ul class="cart-overview">
                            <li> 
                                <img src="{{ asset('assets/images/shop/thumb/1.jpg') }}" alt=""/>
                                <div class="product-meta"> 
                                    <h5>natural cacao powder</h5>
                                    <p>$ 10.00</p>
                                </div>
                                <a class="cart-cancel" href="#"><i class="fas fa-times"></i></a>
                            </li>
                            <li> 
                                <img src="{{ asset('assets/images/shop/thumb/2.jpg') }}" alt=""/>
                                <div class="product-meta"> 
                                    <h5>biotin complex</h5>
                                    <p>$ 16.00</p>
                                </div>
                                <a class="cart-cancel" href="#"><i class="fas fa-times"></i></a>
                            </li>
                        </ul>
                        <span>total: <i class="total-price">$26.00</i></span>
                        <div class="cart--control"> 
                            <button class="btn">view cart</button>
                        </div>
                    </div>
                </div>
                
                <!-- Start Module Search -->
                <div class="module module-search float-left">
                    <div class="module-icon search-icon"><i class="icon-search" data-hover=""></i></div>
                </div>
                
                <!-- Start .module-contact-->
                <div class="module-contact module-contact-2">
                    <a class="btn btn--primary btn-line btn-line-after" href=""> 
                        <span>make appointment</span>
                        <span class="line"> <span></span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>