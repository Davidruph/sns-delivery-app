<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Delivery App')</title>
    @auth
        <meta name="user-id" content="{{ auth()->id() }}">
    @endauth
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Set userId first -->
    <script>
        window.userId = {{ auth()->id() }};
    </script>

    @vite(['resources/js/app.js'])

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="">
    <meta name="author" content="">
    <meta name="robots" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/jquery-autocomplete/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="inner">
            <span>Loading </span>
            <div class="loading">
            </div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <div class="animation">
            <span class="circle one"></span>
            <span class="circle two"></span>
            <span class="circle three"></span>
            <span class="circle four"></span>
            <span class="line-1 ">
                <svg width="1920" height="450" viewBox="0 0 1920 450" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.3"
                        d="M0 155L95.4613 293.923C106.459 309.928 131.116 305.943 136.512 287.289L209.86 33.7127C215.892 12.8576 244.803 11.2033 253.175 31.2341L344.838 250.546C352.224 268.217 376.708 269.648 386.102 252.958L519.839 15.3693C529.061 -1.01332 552.975 -0.0134089 560.797 17.0818L716.503 357.389C724.454 374.766 748.899 375.43 757.782 358.51L902.518 82.8223C911.524 65.6685 936.406 66.653 944.028 84.4648L1093.06 432.731C1101.14 451.601 1128.01 451.247 1135.58 432.172L1291.33 39.9854C1298.27 22.5135 1322.1 20.2931 1332.14 36.1824L1473.74 260.126C1482.47 273.922 1502.38 274.494 1511.88 261.221L1667.88 43.3025C1678.17 28.9257 1700.16 31.0533 1707.5 47.1365L1844.91 348.06C1853.69 367.287 1881.58 365.486 1887.81 345.29L1970 79"
                        stroke="url(#paint0_linear_332_3757)" stroke-opacity="0.4" stroke-width="6"
                        stroke-linecap="round" />
                    <defs>
                        <linearGradient id="paint0_linear_332_3757" x1="1946.24" y1="352.062" x2="-1.52124"
                            y2="345.607" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#6E4AFF" />
                            <stop offset="0.479167" stop-color="#E43BFF" />
                            <stop offset="1" stop-color="#6E4AFF" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>
            <span class="line-2">
                <svg width="1920" height="459" viewBox="0 0 1920 459" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0 89L103.191 296.201C112.034 313.958 137.703 312.941 145.114 294.54L224.847 96.5574C232.264 78.141 257.962 77.1423 266.786 94.9275L352.649 267.995C360.863 284.553 384.264 285.148 393.31 269.03L516.226 50.0159C525.164 34.0902 548.205 34.4325 556.666 50.6167L713.497 350.608C721.71 366.318 743.86 367.222 753.326 352.234L901.462 117.684C911.188 102.286 934.102 103.763 941.771 120.282L1091.14 442.062C1099.38 459.816 1124.62 459.817 1132.86 442.064L1303.17 75.2544C1310.64 59.1685 1332.73 57.2308 1342.89 71.7713L1469.94 253.703C1479.15 266.893 1498.71 266.794 1507.78 253.511L1671.82 13.4627C1681.74 -1.05968 1703.63 0.478486 1711.42 16.2459L1844.42 285.267C1853.64 303.905 1880.89 301.723 1887.02 281.857L1970 13"
                        stroke="url(#paint0_linear_332_3758)" stroke-opacity="0.4" stroke-width="6"
                        stroke-linecap="round" />
                    <defs>
                        <linearGradient id="paint0_linear_332_3758" x1="1946.24" y1="286.062" x2="-1.52105"
                            y2="279.607" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#6E4AFF" />
                            <stop offset="0.479167" stop-color="#E43BFF" />
                            <stop offset="1" stop-color="#6E4AFF" />
                        </linearGradient>
                    </defs>
                </svg>
            </span>

        </div>

        @include('layouts.partials.header')
        @include('layouts.partials.sidebar')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">

                @yield('content')
                {{-- @include('layouts.partials.footer') --}}
            </div>
        </div>


        <!--**********************************
    Content body end
***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->
    <audio id="notification-sound" src="{{ asset('/sound.mp3') }}" preload="auto"></audio>

    <script src="{{ asset('vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-nice-select/js/jquery.nice-select.min.js') }}"></script>
    <!-- Apex Chart -->
    <script src="{{ asset('vendor/apexchart/apexchart.js') }}"></script>
    <!-- Chart piety plugin files -->
    <script src="{{ asset('vendor/peity/jquery.peity.min.js') }}"></script>
    <!-- Chartist -->
    <script src="{{ asset('vendor/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-autocomplete/jquery-ui.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard-1.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/dlabnav-init.js') }}"></script>
    <script src="js/demo.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const productContainer = document.getElementById('product-container');

            productContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('add-row')) {
                    const currentRow = e.target.closest('.product-row');
                    const newRow = currentRow.cloneNode(true);

                    // Clear values in cloned inputs
                    newRow.querySelectorAll('input, select').forEach(input => input.value = '');

                    // Change "Add" button to "Remove"
                    const addButton = newRow.querySelector('.add-row');
                    addButton.textContent = 'Remove';
                    addButton.classList.remove('btn-success');
                    addButton.classList.add('btn-danger');
                    addButton.classList.remove('add-row');
                    addButton.classList.add('remove-row');

                    productContainer.appendChild(newRow);
                }

                if (e.target.classList.contains('remove-row')) {
                    e.target.closest('.product-row').remove();
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.userId) {
                Echo.private(`App.Models.User.${window.userId}`)
                    .listen('.order_message', (notification) => {
                        console.log('New order notification:', notification);

                        const ul = document.querySelector('.timeline');
                        if (!ul) {
                            console.warn('Timeline element not found');
                            return;
                        }

                        const li = document.createElement('li');

                        li.innerHTML = `
                    <a href="${notification.link}" style="text-decoration: none; color: inherit; cursor: pointer;">
                        <div class="timeline-panel">
                            <div class="media me-2 media-primary">
                                <i class="fa fa-shopping-cart"></i>
                            </div>
                            <div class="media-body">
                                <h6 class="mb-0">${notification.title}</h6>
                                <small class="d-block">${notification.message}</small>
                                <small class="text-muted">${notification.time}</small>
                            </div>
                        </div>
                    </a>
                `;
                        ul.prepend(li);

                        // Play notification sound
                        const sound = document.getElementById('notification-sound');
                        if (sound) {
                            sound.play().catch(e => {
                                // Handle play error, often due to user interaction required in browsers
                                console.warn('Notification sound play failed:', e);
                            });
                        }
                    });
            }
        });
    </script>
</body>

</html>
