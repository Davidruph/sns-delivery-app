@extends('layouts.dashboard')

@section('title', 'Dashboard Page')

@section('content')
    <div class="row">
        <div class="col-xl-9">
            <div class="row">
                <!----column-- -->
                <div class="col-xl-8">
                    <div class="card balance-data">
                        <div class="card-header border-0 flex-wrap">
                            <h4 class="fs-18 font-w600">
                                @if ($isVendor)
                                    My Orders Overview
                                @else
                                    Orders Overview
                                @endif
                            </h4>
                        </div>
                        <div class="card-body py-0 custome-tooltip">
                            <div id="orderStatusChart" class="reservationChart"></div>
                        </div>
                    </div>
                </div>
                <!----/column-- -->
                <!----column-- -->
                <div class="col-xl-4">
                    <div class="row">
                        <div class="col-xl-12 col-lg-4 col-md-6">
                            <div class="card Expense overflow-hidden">
                                <div class="card-body p-4 p-lg-3 p-xl-4 ">
                                    <div class="students1 one d-flex align-items-center justify-content-between ">
                                        <div class="content">
                                            <h2 class="mb-0">
                                                {{ $isVendor ? optional(Auth::user()->store)->store_currency_symbol . number_format($totalRevenue, 2) : optional(Auth::user()->store)->store_currency_symbol . $totalOrders }}
                                            </h2>
                                            <span class="mb-2 fs-14">
                                                @if ($isVendor)
                                                    Total Revenue
                                                @else
                                                    Total Orders
                                                @endif
                                            </span>
                                        </div>
                                        <div>
                                            <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                                <svg width="60" height="58" viewBox="0 0 60 58" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M39.0469 2.3125C38.3437 3.76563 38.9648 5.52344 40.418 6.22657C44.4609 8.17188 47.8828 11.1953 50.3203 14.9805C52.8164 18.8594 54.1406 23.3594 54.1406 28C54.1406 41.3125 43.3125 52.1406 30 52.1406C16.6875 52.1406 5.85937 41.3125 5.85937 28C5.85937 23.3594 7.18359 18.8594 9.66797 14.9688C12.0937 11.1836 15.5273 8.16016 19.5703 6.21485C21.0234 5.51173 21.6445 3.76563 20.9414 2.30079C20.2383 0.847664 18.4922 0.226569 17.0273 0.929694C12 3.34376 7.74609 7.09375 4.73437 11.8047C1.64062 16.6328 -1.56336e-06 22.2344 -1.31134e-06 28C-9.60967e-07 36.0156 3.11719 43.5508 8.78906 49.2109C14.4492 54.8828 21.9844 58 30 58C38.0156 58 45.5508 54.8828 51.2109 49.2109C56.8828 43.5391 60 36.0156 60 28C60 22.2344 58.3594 16.6328 55.2539 11.8047C52.2305 7.10547 47.9766 3.34375 42.9609 0.929693C41.4961 0.238287 39.75 0.84766 39.0469 2.3125V2.3125Z"
                                                        fill="#53CAFD" />
                                                    <path
                                                        d="M41.4025 26.4414C41.9767 25.8671 42.258 25.1171 42.258 24.3671C42.258 23.6171 41.9767 22.8671 41.4025 22.2929L34.0314 14.9218C32.9533 13.8437 31.5236 13.2578 30.0119 13.2578C28.5002 13.2578 27.0587 13.8554 25.9923 14.9218L18.6212 22.2929C17.4728 23.4414 17.4728 25.2929 18.6212 26.4414C19.7697 27.5898 21.6212 27.5898 22.7697 26.4414L27.0939 22.1171L27.0939 38.7695C27.0939 40.3867 28.4064 41.6992 30.0236 41.6992C31.6408 41.6992 32.9533 40.3867 32.9533 38.7695L32.9533 22.1054L37.2775 26.4296C38.4025 27.5781 40.2541 27.5781 41.4025 26.4414Z"
                                                        fill="#53CAFD" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----/column-- -->
                        <!----column-- -->
                        <div class="col-xl-12 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body p-4 p-lg-3 p-xl-4 ">
                                    <div class="students1 two d-flex align-items-center justify-content-between">
                                        <div class="content">
                                            <h2 class="mb-0">
                                                {{ $isVendor ? $orderStatusCounts->sum() : optional(Auth::user()->store)->store_currency_symbol . number_format($totalRevenue, 2) }}
                                            </h2>
                                            <span class="mb-2 fs-14">
                                                @if ($isVendor)
                                                    Total Orders
                                                @else
                                                    Total Revenue
                                                @endif
                                            </span>
                                        </div>
                                        <div class="d-inline-block position-relative donut-chart-sale">
                                            <span class="donut3"
                                                data-peity='{ "fill": ["rgba(204, 97, 255, 0.9)", "rgba(255, 255, 255, 0.1"],   "innerRadius": 30, "radius": 8}'>4/8</span>
                                            <small>38%</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!----/column-- -->
                        <!----column-- -->
                        <div class="col-xl-12 col-lg-4 col-md-12">
                            <div class="card overflow-hidden">
                                <div class="card-body p-4 p-lg-3 p-xl-4">
                                    <div class="students1 three d-flex align-items-center justify-content-between">
                                        <div class="content">
                                            <h2 class="mb-0">{{ $orderStatusCounts['Delivered'] ?? 0 }}</h2>
                                            <span class="fs-14">Delivered Orders</span>
                                        </div>
                                        <div class="newCustomers">
                                            <div class="d-inline-block position-relative donut-chart-sale mb-3">
                                                <div id="deliveredChart"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!---/-column-- -->
                    </div>
                </div>
            </div>
            <!--/row-->
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Order Status Chart
            var orderStatusOptions = {
                series: [{
                    name: "Orders",
                    data: @json(array_values($orderStatusCounts->toArray()))
                }],
                chart: {
                    height: 300,
                    type: "bar",
                    toolbar: {
                        show: false,
                    },
                },
                colors: ["#53CAFD"],
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 6,
                    curve: "smooth",
                },
                grid: {
                    borderColor: "rgba(255,255,255,0.10)",
                    strokeDashArray: 0,
                    xaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: true,
                        },
                    },
                },
                xaxis: {
                    categories: @json(array_keys($orderStatusCounts->toArray())),
                    labels: {
                        style: {
                            colors: "#fff",
                            fontSize: "13px",
                            fontFamily: "Poppins",
                            fontWeight: 400,
                        },
                    },
                },
                yaxis: {
                    labels: {
                        offsetX: -12,
                        style: {
                            colors: "#fff",
                            fontSize: "13px",
                            fontFamily: "Poppins",
                            fontWeight: 400,
                        },
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(val) {
                            return val + " orders";
                        },
                    },
                },
            };

            var orderStatusChart = new ApexCharts(
                document.querySelector("#orderStatusChart"),
                orderStatusOptions
            );
            orderStatusChart.render();

            // Delivered Orders Mini Chart
            var deliveredOptions = {
                series: [{
                    name: "Delivered",
                    data: [{{ $orderStatusCounts['Delivered'] ?? 0 }}]
                }],
                chart: {
                    type: "line",
                    height: 60,
                    width: 120,
                    toolbar: {
                        show: false
                    },
                    sparkline: {
                        enabled: true
                    },
                },
                colors: ["#E43BFF"],
                stroke: {
                    width: 6,
                    curve: "smooth",
                },
                grid: {
                    show: false
                },
                tooltip: {
                    enabled: false
                }
            };

            var deliveredChart = new ApexCharts(
                document.querySelector("#deliveredChart"),
                deliveredOptions
            );
            deliveredChart.render();
        });
    </script>
@endsection
