{{-- <header class="header header-light header-topbar header-topbar8" id="navbar-spy">
    <!-- Start .top-bar-->
    <div class="top-bar top-bar-5">
        <div class="block-left"> 
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
          
            
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            @include('partials.navigation')
            
            <div class="module-holder">
              
                <!-- Start .module-contact-->
                <div class="module-contact module-contact-2">
                    <a class="btn btn--primary btn-line btn-line-after" href="{{route('contact')}}"> 
                        <span>make appointment</span>
                        <span class="line"> <span></span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header> --}}


@php
    $settings = App\Models\SiteSetting::getSettings();
@endphp

<header class="header header-light header-topbar header-topbar8" id="navbar-spy">
    <!-- Start .top-bar-->
    <div class="top-bar top-bar-5">
        <div class="block-left"> 
        </div>
        <div class="block-right">
            <div class="top-contact">
                <!-- Emergency Contact -->
                @if($settings->emergency_phone)
                <div class="contact-infos">
                    <i class="fas fa-phone-alt"></i>
                    <div class="contact-body">
                        <a href="tel:{{ $settings->emergency_phone }}">
                            emergency line: {{ $settings->emergency_phone }}
                        </a>
                    </div>
                </div>
                @endif

                <!-- Location -->
                @if($settings->location)
                <div class="contact-infos">
                    <i class="fas fa-map-marker-alt"></i>
                    <div class="contact-body">
                        <a href="#">location: {{ strtolower($settings->location) }}</a>
                    </div>
                </div>
                @endif

                <!-- Working Hours -->
                @if($settings->working_hours)
                <div class="contact-infos">
                    <i class="fas fa-clock"></i>
                    <div class="contact-body">
                        <p>{{ $settings->working_hours }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End .top-bar-->
    
    <nav class="navbar navbar-expand-xl navbar-sticky" id="primary-menu">
   <a class="navbar-brand" href="{{ route('home') }}" style="padding: 50; height: auto;">
    @if($settings->logo)
        <img class="logo logo-dark" 
             src="{{ asset('storage/' . $settings->logo) }}" 
             alt="Logo"
             style="height: 60px; width: auto; object-fit: contain;"/>
        <img class="logo logo-mobile" 
             src="{{ asset('storage/' . $settings->logo) }}" 
             alt="Logo"
             style="height: 50px; width: auto; object-fit: contain;"/>
    @else
        <img class="logo logo-dark" 
             src="{{ asset('assets/images/logo/logo-dark.svg') }}" 
             alt="Medisch Logo"
             style="height: 60px; width: auto; object-fit: contain;"/>
        <img class="logo logo-mobile" 
             src="{{ asset('assets/images/logo/logo-mobile.svg') }}" 
             alt="Medisch Logo"
             style="height: 50px; width: auto; object-fit: contain;"/>
    @endif
</a>
        
        <div class="module-holder module-holder-phone">
            <button class="navbar-toggler collapsed" 
                    type="button" 
                    data-bs-toggle="collapse" 
                    data-bs-target="#navbarContent" 
                    aria-controls="navbarContent" 
                    aria-expanded="false" 
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        
        <div class="collapse navbar-collapse" id="navbarContent">
            @include('partials.navigation')
            
            <div class="module-holder">
                <!-- Start .module-contact-->
                <div class="module-contact module-contact-2">
                    <a class="btn btn--primary btn-line btn-line-after" 
                       href="{{ route('contact') }}"> 
                        <span>make appointment</span>
                        <span class="line"> <span></span></span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
<style>
.navbar-brand img.logo-dark {
    display: block;
}

.navbar-brand img.logo-mobile {
    display: none;
}

@media (max-width: 991px) {
    .navbar-brand img.logo-dark {
        display: none;
    }
    
    .navbar-brand img.logo-mobile {
        display: block;
    }
}
</style>