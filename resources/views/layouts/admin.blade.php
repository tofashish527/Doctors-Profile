<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">

<head>
    <meta charset="utf-8">
    <title>Ecommerce Dashboard</title>
    <meta name="author" content="themesflat.com">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Theme Style -->
    <link rel="stylesheet" href="{{ asset('assets2/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets2/css/style.css') }}">

    <!-- Font -->
    <link rel="stylesheet" href="{{ asset('assets2/font/fonts.css') }}">

    <!-- Icon -->
    <link rel="stylesheet" href="{{ asset('assets2/icon/style.css') }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets2/images/favicon.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('assets2/images/favicon.png') }}">

    <style>
        .unread-count {
            display: none;
        }

        .icon-message-circle {
            font-size: 1.2rem;
        }

        .noti-item.active {
            background-color: #f8f9fa;
            border-left: 3px solid #0d6efd;
        }

        .noti-item:hover {
            background-color: #e9ecef;
        }
    /* ================= Sidebar fix ================= */
    .section-content-right {
        margin-left: 0; /* যেহেতু sidebar already fixed */
        width: 100%;
        padding: 30px;
        overflow-x: auto;
    }

    /* ================= Table font & spacing ================= */
    .product-table th {
        font-size: 24px !important;
        font-weight: 700 !important;
        padding: 15px !important;
        background-color: #f7f7f7 !important;
    }

    .product-table td {
        font-size: 24px !important;
        padding: 15px !important;
        color: #444 !important;
        vertical-align: middle !important;
    }

    .name-text {
        font-size: 24px !important;
        font-weight: 600 !important;
        color: #000 !important;
    }

    .badge-status {
        font-size: 13px !important;
        padding: 5px 10px !important;
        border-radius: 4px !important;
    }

    .tf-button {
        font-size: 24px !important;
        padding: 8px 15px !important;
        height: auto !important;
        line-height: normal !important;
    }

    .tf-button i {
        font-size: 16px !important;
    }

    .product-table-wrapper {
        overflow-x: auto !important;
        display: block !important;
        width: 100% !important;
    }

    /* ================= Main Content Fix ================= */
.main-content {
    width: 100%;
    min-height: calc(100vh - 80px); /* header height বাদ */
    display: block;
}

.content-wrapper {
    width: 100%;
    max-width: 100%;
    padding: 20px;
    box-sizing: border-box;
    overflow-x: auto;
}

/* ================= Sidebar Compatible ================= */
.section-content-right {
    margin-left: 0;
    width: calc(100% - 260px); /* sidebar width */
    margin-left: 260px;
}

/* Sidebar collapse হলে */
.layout-wrap.sidebar-collapse .section-content-right {
    width: 100%;
    margin-left: 0;
}

/* ================= Mobile Fix ================= */
@media only screen and (max-width: 991px) {
    .section-content-right {
        padding: 10px !important;
    }

    .product-table td,
    .product-table th {
        font-size: 18px !important;
    }
}



    </style>
</head>


<body class="body">

    <!-- #wrapper -->
    <div id="wrapper">
        <!-- #page -->
        <div id="page" class="">
            <!-- layout-wrap -->
            <div class="layout-wrap">
                <!-- /preload -->
                <!-- section-menu-left -->
                <div class="section-menu-left">
                    <div class="box-logo">
                        <a href="{{ url('/') }}" id="site-logo-inner">
                            <img src="" alt="Site Logo"
                                style="height:70px; width:auto;">
                        </a>

                        <div class="button-show-hide">
                            <i class="icon-menu-left"></i>
                        </div>
                    </div>
                    <div class="center">
                        <div class="center-item">
                            <div class="center-heading">Main Home</div>
                            <ul class="menu-list">
                                <li class="menu-item active">
                                    <a href="{{ route('admin.dashboard') }}">
                                        <div class="icon"><i class="icon-grid"></i></div>
                                        <div class="text">Dashboard</div>
                                    </a>
                                </li>
                            </ul>

                        </div>
                        <div class="center-item">
                            <div class="center-heading">All page</div>
                            <ul class="menu-list">
                                <li class="menu-item">
                                    <a href="" class="">
                                        <div class="icon"><i class="icon-dollar-sign"></i></div>
                                        <div class="text">Currency Settings</div>
                                    </a>
                                </li>
                                <li class="nav-item">
    <a class="nav-link {{ request()->routeIs('admin.banner.*') ? 'active' : '' }}" 
       href="{{ route('admin.banner.index') }}">
        <i class="bi bi-person-badge"></i> Doctor Profile
    </a>
</li>
                                {{-- <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="contactDropdown"
       role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-geo-alt-fill"></i> Contact Settings
    </a>

    <ul class="dropdown-menu" aria-labelledby="contactDropdown">

        <li>
            <a class="dropdown-item"
               href="{{ route('admin.contact-info.index') }}">
                <i class="bi bi-list-ul me-1"></i> Contact Info List
            </a>
        </li>

        <li>
            <a class="dropdown-item"
               href="{{ route('admin.contact-info.create') }}">
                <i class="bi bi-plus-circle me-1"></i> Add Contact Info
            </a>
        </li>

    </ul>
</li> --}}

<li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Contact Settings</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.contact-info.create') }}" class="">
                                                <div class="text">Add Contact-info</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="{{ route('admin.contact-info.index') }}" class="">
                                                <div class="text">Contact-info List</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>


                                {{-- <li class="nav-item">
    <a class="nav-link" href="{{ route('admin.contact-info.index') }}">
        <i class="bi bi-geo-alt-fill"></i> Contact Settings
    </a>
</li> --}}

                            </ul>
                                /* {{-- <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-layers"></i></div>
                                        <div class="text">Category</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="" class="">
                                                <div class="text">Category list</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="menu-item has-children">
                                    <a href="javascript:void(0);" class="menu-item-button">
                                        <div class="icon"><i class="icon-file-plus"></i></div>
                                        <div class="text">Order</div>
                                    </a>
                                    <ul class="sub-menu">
                                        <li class="sub-menu-item">
                                            <a href="" class="">
                                                <div class="text">All Orders</div>
                                            </a>
                                        </li>
                                        <li class="sub-menu-item">
                                            <a href="" class="">
                                                <div class="text">Pending Orders</div>
                                            </a>
                                        </li>
                                    </ul>
                                </li> */

                                <li class="menu-item">
                                    <a href=""
                                        class="">
                                        <div class="icon"><i class="icon-message-square"></i></div>
                                        <div class="text">Contact Messages</div>
                                        {{-- @php
                                            $unreadCount = \App\Models\ContactMessage::getUnreadCount();
                                        @endphp
                                        @if ($unreadCount > 0)
                                            <span class="badge bg-danger ms-auto">{{ $unreadCount }}</span>
                                        @endif 
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section-menu-left -->
                <!-- section-content-right -->
                <div class="section-content-right" id="page-content-wrapper" style="width: 100%">
                    <!-- header-dashboard -->
                    <div class="header-dashboard">
                        <div class="wrap">
                            <div class="header-left">
                                <a href="{{ url('/') }}" id="site-logo-inner">
                                    <img id="logo_header_mobile"
                                        src="" alt="Site Logo"
                                        style="height:70px; width:auto;">
                                </a>

                                <div class="button-show-hide">
                                    <i class="icon-menu-left"></i>
                                </div>
                                <form class="form-search flex-grow">
                                    <fieldset class="name">
                                        <input type="text" placeholder="Search here..." class="show-search"
                                            name="name" tabindex="2" value="" aria-required="true"
                                            required="">
                                    </fieldset>
                                    <div class="button-submit">
                                        <button class="" type="submit"><i class="icon-search"></i></button>
                                    </div>
                                    <div class="box-content-search" id="box-content-search">
                                        <ul class="mb-24">
                                            <li class="mb-14">
                                                <div class="body-title">Top selling product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/17.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Dog Food
                                                                    Rachael Ray Nutrish®</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/18.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Natural
                                                                    Dog Food Healthy Dog Food</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="images/products/19.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Freshpet
                                                                    Healthy Dog Food and Cat</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                        <ul class="">
                                            <li class="mb-14">
                                                <div class="body-title">Order product</div>
                                            </li>
                                            <li class="mb-14">
                                                <div class="divider"></div>
                                            </li>
                                            <li>
                                                <ul>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/20.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Sojos
                                                                    Crunchy Natural Grain Free...</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/21.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Kristin
                                                                    Watson</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14 mb-10">
                                                        <div class="image no-bg">
                                                            <img src="images/products/22.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega
                                                                    Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mb-10">
                                                        <div class="divider"></div>
                                                    </li>
                                                    <li class="product-item gap14">
                                                        <div class="image no-bg">
                                                            <img src="images/products/23.png" alt="">
                                                        </div>
                                                        <div class="flex items-center justify-between gap20 flex-grow">
                                                            <div class="name">
                                                                <a href="product-list.html" class="body-text">Mega
                                                                    Pumpkin Bone</a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </form>
                            </div>
                            <div class="header-grid">

                                <div class="popup-wrap noti type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny">1</span>
                                                <i class="icon-bell"></i>
                                            </span>
                                        </button>
                                    </div>
                                </div>


                                <!-- Messages Notification Dropdown -->
                                <div class="popup-wrap message type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-item">
                                                <span class="text-tiny unread-count">0</span>
                                                <i class="icon-message-square"></i>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton2">
                                            <li>
                                                <h6>Contact Messages</h6>
                                            </li>
                                            <div id="notificationList">
                                                <li class="text-center py-3">
                                                    <span class="text-muted">Loading...</span>
                                                </li>
                                            </div>
                                            <li>
                                                <a href=""
                                                    class="tf-button w-full">View all</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="header-item button-zoom-maximize">
                                    <div class="">
                                        <i class="icon-maximize"></i>
                                    </div>
                                </div>
                                <div class="popup-wrap user type-header">
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="header-user wg-user">
                                                <span class="image">
                                                    <img src="{{ asset('assets2/images/avatar/user-1.png') }}"
                                                        alt="avatar">
                                                </span>
                                                <span class="flex flex-column">
                                                    {{-- <span class="body-title mb-2">{{ auth()->user()->name }}</span> 
                                                    <span class="text-tiny">{{ auth()->user()->email }}</span>--}}
                                                </span>
                                            </span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end has-content"
                                            aria-labelledby="dropdownMenuButton3">
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-user"></i>
                                                    </div>
                                                    <div class="body-title-2">Account</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-mail"></i>
                                                    </div>
                                                    <div class="body-title-2">Inbox</div>
                                                    <div class="number">27</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-file-text"></i>
                                                    </div>
                                                    <div class="body-title-2">Taskboard</div>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-settings"></i>
                                                    </div>
                                                    <div class="body-title-2">Settings</div>
                                                </a>
                                            </li>

                                            <li>
                                                <a href="#" class="user-item">
                                                    <div class="icon">
                                                        <i class="icon-headphones"></i>
                                                    </div>
                                                    <div class="body-title-2">Support</div>
                                                </a>
                                            </li>
                                            <li>
                                                <form method="POST" action="{{ route('admin.logout') }}">
                                                    @csrf
                                                    <button type="submit" class="user-item"
                                                        style="background: none; border: none; padding: 0; width: 100%; text-align: left;">
                                                        <div class="icon">
                                                            <i class="icon-log-out"></i>
                                                        </div>
                                                        <div class="body-title-2">Log out</div>
                                                    </button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /header-dashboard -->
                   <main class="main-content">
    <div class="content-wrapper">
        @yield('content')
    </div>
</main>

                </div>
                <!-- /section-content-right -->

            </div>
            <!-- /layout-wrap -->
        </div>
        <!-- /#page -->
    </div>
    <!-- /#wrapper -->

    <!-- Javascriassets2/pt -->
    <script src="{{ asset('assets2/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets2/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets2/js/zoom.js') }}"></script>

    <script src="{{ asset('assets2/js/apexcharts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-1.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-2.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-3.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-4.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-5.js') }}"></script>
    <script src="{{ asset('assets2/js/apexcharts/line-chart-6.js') }}"></script>

    {{-- <script src="{{ asset('assets2/js/switcher.js') }}"></script> --}}
    <script src="{{ asset('assets2/js/theme-settings.js') }}"></script>
    <script src="{{ asset('assets2/js/main.js') }}"></script>
    <!-- Notification Script -->
    <script>


        // Helper function to format time
        function formatTime(dateString) {
            const date = new Date(dateString);
            const now = new Date();
            const diffInSeconds = Math.floor((now - date) / 1000);

            if (diffInSeconds < 60) {
                return 'Just now';
            } else if (diffInSeconds < 3600) {
                const minutes = Math.floor(diffInSeconds / 60);
                return minutes + ' min ago';
            } else if (diffInSeconds < 86400) {
                const hours = Math.floor(diffInSeconds / 3600);
                return hours + ' hour' + (hours > 1 ? 's' : '') + ' ago';
            } else {
                return date.toLocaleDateString('en-US', {
                    month: 'short',
                    day: 'numeric'
                });
            }
        }

        // Helper function to truncate text
        function truncateText(text, length) {
            if (text.length > length) {
                return text.substring(0, length) + '...';
            }
            return text;
        }

        // Load notifications on page load
        $(document).ready(function() {
            loadUnreadMessages();

            // Reload notifications every 30 seconds
            setInterval(function() {
                loadUnreadMessages();
            }, 30000); // 30 seconds
        });

        // Reload notifications when dropdown is opened
        $(document).on('click', '#dropdownMenuButton2', function() {
            loadUnreadMessages();
        });
    </script>



</body>

</html>