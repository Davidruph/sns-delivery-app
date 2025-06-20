 <!--**********************************
            Sidebar start
        ***********************************-->
 <div class="dlabnav">
     <div class="dlabnav-scroll">

         <ul class="metismenu" id="menu">
             <li><a class="" href="{{ route('dashboard') }}" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="IconlyHome">
                                 <g id="Home">
                                     <path id="Home_2"
                                         d="M9.13478 20.7733V17.7156C9.13478 16.9351 9.77217 16.3023 10.5584 16.3023H13.4326C13.8102 16.3023 14.1723 16.4512 14.4393 16.7163C14.7063 16.9813 14.8563 17.3408 14.8563 17.7156V20.7733C14.8539 21.0978 14.9821 21.4099 15.2124 21.6402C15.4427 21.8705 15.7561 22 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0008C21.1356 20.3588 21.5 19.487 21.5 18.5778V9.86686C21.5 9.13246 21.1721 8.43584 20.6046 7.96467L13.934 2.67587C12.7737 1.74856 11.1111 1.7785 9.98539 2.74698L3.46701 7.96467C2.87274 8.42195 2.51755 9.12064 2.5 9.86686V18.5689C2.5 20.4639 4.04738 22 5.95617 22H7.87229C8.55123 22 9.103 21.4562 9.10792 20.7822L9.13478 20.7733Z"
                                         fill="#130F26" />
                                 </g>
                             </g>
                         </svg>
                     </div>
                     <span class="nav-text">Dashboard</span>
                 </a>
             </li>

             @if (auth()->user()->getRoleNames()->first() === 'Super Admin')
                 <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                         <div class="menu-icon">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M3 6C3 4.89543 3.89543 4 5 4H9.5C9.89782 4 10.2794 4.15804 10.5607 4.43934L12.1213 6H19C20.1046 6 21 6.89543 21 8V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V6Z"
                                     fill="#763ed0" />
                                 <path d="M3 8H21V18C21 19.1046 20.1046 20 19 20H5C3.89543 20 3 19.1046 3 18V8Z"
                                     fill="#B9A8FF" opacity="0.4" />
                             </svg>

                         </div>

                         <span class="nav-text">Category</span>
                     </a>
                     <ul aria-expanded="false">
                         <li><a href="{{ route('category.index') }}">All Category</a></li>
                         <li><a href="{{ route('category.create') }}">Create Category</a></li>
                     </ul>
                 </li>
             @endif

             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M19 6H5C4.44772 6 4 6.44772 4 7V9C4 9.55228 4.44772 10 5 10H19C19.5523 10 20 9.55228 20 9V7C20 6.44772 19.5523 6 19 6Z"
                                 fill="#763ed0" />
                             <path
                                 d="M19 11H5C4.44772 11 4 11.4477 4 12V14C4 14.5523 4.44772 15 5 15H19C19.5523 15 20 14.5523 20 14V12C20 11.4477 19.5523 11 19 11Z"
                                 fill="#763ed0" />
                             <path
                                 d="M19 16H5C4.44772 16 4 16.4477 4 17V19C4 19.5523 4.44772 20 5 20H19C19.5523 20 20 19.5523 20 19V17C20 16.4477 19.5523 16 19 16Z"
                                 fill="#763ed0" />
                             <path opacity="0.4" d="M8 8H10" stroke="#B9A8FF" stroke-width="1.5"
                                 stroke-linecap="round" />
                             <path opacity="0.4" d="M8 13H10" stroke="#B9A8FF" stroke-width="1.5"
                                 stroke-linecap="round" />
                             <path opacity="0.4" d="M8 18H10" stroke="#B9A8FF" stroke-width="1.5"
                                 stroke-linecap="round" />
                             <path opacity="0.4" d="M14 8H16" stroke="#B9A8FF" stroke-width="1.5"
                                 stroke-linecap="round" />
                             <path opacity="0.4" d="M14 13H16" stroke="#B9A8FF" stroke-width="1.5"
                                 stroke-linecap="round" />
                             <path opacity="0.4" d="M14 18H16" stroke="#B9A8FF" stroke-width="1.5"
                                 stroke-linecap="round" />
                         </svg>
                     </div>

                     <span class="nav-text">Inventory</span>
                 </a>
                 <ul aria-expanded="false">
                     @if (auth()->user()->getRoleNames()->first() === 'Vendor')
                         <li><a href="{{ route('inventory.index') }}">List</a></li>
                         <li><a href="{{ route('inventory.create') }}">Create Inventory</a></li>
                     @endif
                     @if (auth()->user()->getRoleNames()->first() === 'Super Admin' ||
                             auth()->user()->getRoleNames()->first() === 'Portal Manager' ||
                             auth()->user()->getRoleNames()->first() === 'Customer Service')
                         <li><a href="{{ route('inventory.view.all') }}">All Inventory</a></li>
                     @endif
                 </ul>
             </li>

             @php
                 $allowedRoles = ['Super Admin', 'Customer Service', 'Portal Manager'];
             @endphp

             @if (in_array(auth()->user()->getRoleNames()->first(), $allowedRoles))
                 <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                         <div class="menu-icon">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path d="M16 7C16 4.79086 14.2091 3 12 3C9.79086 3 8 4.79086 8 7V10H16V7Z"
                                     fill="#763ed0" />
                                 <path
                                     d="M5 10C4.44772 10 4 10.4477 4 11V19C4 20.1046 4.89543 21 6 21H18C19.1046 21 20 20.1046 20 19V11C20 10.4477 19.5523 10 19 10H5Z"
                                     fill="#763ed0" />
                                 <path opacity="0.4"
                                     d="M12 14C13.1046 14 14 14.8954 14 16C14 17.1046 13.1046 18 12 18C10.8954 18 10 17.1046 10 16C10 14.8954 10.8954 14 12 14Z"
                                     fill="#B9A8FF" />
                                 <path opacity="0.4" d="M12 14V18" stroke="#B9A8FF" stroke-width="2"
                                     stroke-linecap="round" />
                             </svg>
                         </div>

                         <span class="nav-text">Vendors</span>
                     </a>
                     <ul aria-expanded="false">
                         <li><a href="{{ route('vendors.index') }}">Vendor List</a></li>
                         @if (auth()->user()->getRoleNames()->first() === 'Super Admin')
                             <li><a href="{{ route('vendors.create') }}">Create Vendor</a></li>
                         @endif
                     </ul>
                 </li>

                 @if (auth()->user()->getRoleNames()->first() === 'Super Admin')
                     <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                             <div class="menu-icon">
                                 <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M9.34933 14.8577C5.38553 14.8577 2 15.47 2 17.9174C2 20.3666 5.364 21 9.34933 21C13.3131 21 16.6987 20.3877 16.6987 17.9404C16.6987 15.4911 13.3347 14.8577 9.34933 14.8577Z"
                                         fill="#B9A8FF" />
                                     <path opacity="0.4"
                                         d="M9.34935 12.5248C12.049 12.5248 14.2124 10.4062 14.2124 7.76241C14.2124 5.11865 12.049 3 9.34935 3C6.65072 3 4.48633 5.11865 4.48633 7.76241C4.48633 10.4062 6.65072 12.5248 9.34935 12.5248Z"
                                         fill="#763ed0" />
                                     <path opacity="0.4"
                                         d="M16.1734 7.84875C16.1734 9.19507 15.7605 10.4513 15.0364 11.4948C14.9611 11.6021 15.0276 11.7468 15.1587 11.7698C15.3407 11.7995 15.5276 11.8177 15.7184 11.8216C17.6167 11.8704 19.3202 10.6736 19.7908 8.87118C20.4885 6.19676 18.4415 3.79543 15.8339 3.79543C15.5511 3.79543 15.2801 3.82418 15.0159 3.87688C14.9797 3.88454 14.9405 3.90179 14.921 3.93246C14.8955 3.97174 14.9141 4.02253 14.9395 4.05607C15.7233 5.13216 16.1734 6.44207 16.1734 7.84875Z"
                                         fill="#763ed0" />
                                     <path
                                         d="M21.7791 15.1693C21.4317 14.444 20.5932 13.9466 19.3172 13.7023C18.7155 13.5586 17.0853 13.3545 15.5697 13.3832C15.5472 13.3861 15.5344 13.4014 15.5325 13.411C15.5295 13.4263 15.5364 13.4493 15.5658 13.4656C16.2663 13.8048 18.9738 15.2805 18.6333 18.3928C18.6186 18.5289 18.7292 18.6439 18.8671 18.6247C19.5335 18.5318 21.2478 18.1705 21.7791 17.0475C22.0736 16.4534 22.0736 15.7635 21.7791 15.1693Z"
                                         fill="#B9A8FF" />
                                 </svg>
                             </div>

                             <span class="nav-text">Staffs</span>
                         </a>
                         <ul aria-expanded="false">
                             <li><a href="{{ route('users.index') }}">Staff List</a></li>
                             <li><a href="{{ route('users.create') }}">Create Staff</a></li>
                         </ul>
                     </li>
                 @endif
             @endif

             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="IconlyDocument">
                                 <g id="Document">
                                     <path id="Document_2" fill-rule="evenodd" clip-rule="evenodd"
                                         d="M7.81 2H16.191C19.28 2 21 3.78 21 6.83V17.16C21 20.26 19.28 22 16.191 22H7.81C4.77 22 3 20.26 3 17.16V6.83C3 3.78 4.77 2 7.81 2ZM8.08 6.66V6.65H11.069C11.5 6.65 11.85 7 11.85 7.429C11.85 7.87 11.5 8.22 11.069 8.22H8.08C7.649 8.22 7.3 7.87 7.3 7.44C7.3 7.01 7.649 6.66 8.08 6.66ZM8.08 12.74H15.92C16.35 12.74 16.7 12.39 16.7 11.96C16.7 11.53 16.35 11.179 15.92 11.179H8.08C7.649 11.179 7.3 11.53 7.3 11.96C7.3 12.39 7.649 12.74 8.08 12.74ZM8.08 17.31H15.92C16.319 17.27 16.62 16.929 16.62 16.53C16.62 16.12 16.319 15.78 15.92 15.74H8.08C7.78 15.71 7.49 15.85 7.33 16.11C7.17 16.36 7.17 16.69 7.33 16.95C7.49 17.2 7.78 17.35 8.08 17.31Z"
                                         fill="#130F26" />
                                 </g>
                             </g>
                         </svg>
                     </div>

                     <span class="nav-text">Order</span>
                 </a>
                 <ul aria-expanded="false">
                     @if (in_array(auth()->user()->getRoleNames()->first(), $allowedRoles))
                         <li><a href="{{ route('order.view.all') }}">All Orders</a></li>
                     @endif
                     @if (auth()->user()->getRoleNames()->first() === 'Vendor')
                         <li><a href="{{ route('order.index') }}">My Orders</a></li>
                         <li><a href="{{ route('order.create') }}">Create Order</a></li>
                     @endif
                 </ul>
             </li>

             @if (auth()->user()->getRoleNames()->first() === 'Super Admin')
                 <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                         <div class="menu-icon">
                             <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                 <path
                                     d="M9.34933 14.8577C5.38553 14.8577 2 15.47 2 17.9174C2 20.3666 5.364 21 9.34933 21C13.3131 21 16.6987 20.3877 16.6987 17.9404C16.6987 15.4911 13.3347 14.8577 9.34933 14.8577Z"
                                     fill="#B9A8FF" />
                                 <path opacity="0.4"
                                     d="M9.34935 12.5248C12.049 12.5248 14.2124 10.4062 14.2124 7.76241C14.2124 5.11865 12.049 3 9.34935 3C6.65072 3 4.48633 5.11865 4.48633 7.76241C4.48633 10.4062 6.65072 12.5248 9.34935 12.5248Z"
                                     fill="#763ed0" />
                                 <path opacity="0.4"
                                     d="M16.1734 7.84875C16.1734 9.19507 15.7605 10.4513 15.0364 11.4948C14.9611 11.6021 15.0276 11.7468 15.1587 11.7698C15.3407 11.7995 15.5276 11.8177 15.7184 11.8216C17.6167 11.8704 19.3202 10.6736 19.7908 8.87118C20.4885 6.19676 18.4415 3.79543 15.8339 3.79543C15.5511 3.79543 15.2801 3.82418 15.0159 3.87688C14.9797 3.88454 14.9405 3.90179 14.921 3.93246C14.8955 3.97174 14.9141 4.02253 14.9395 4.05607C15.7233 5.13216 16.1734 6.44207 16.1734 7.84875Z"
                                     fill="#763ed0" />
                                 <path
                                     d="M21.7791 15.1693C21.4317 14.444 20.5932 13.9466 19.3172 13.7023C18.7155 13.5586 17.0853 13.3545 15.5697 13.3832C15.5472 13.3861 15.5344 13.4014 15.5325 13.411C15.5295 13.4263 15.5364 13.4493 15.5658 13.4656C16.2663 13.8048 18.9738 15.2805 18.6333 18.3928C18.6186 18.5289 18.7292 18.6439 18.8671 18.6247C19.5335 18.5318 21.2478 18.1705 21.7791 17.0475C22.0736 16.4534 22.0736 15.7635 21.7791 15.1693Z"
                                     fill="#B9A8FF" />
                             </svg>

                         </div>

                         <span class="nav-text">New Signups</span>
                     </a>
                     <ul aria-expanded="false">
                         <li><a href="{{ route('users.signup_request') }}">View</a></li>
                     </ul>
                 </li>
             @endif

             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M19.14 12.936c.036-.3.06-.6.06-.936 0-.336-.024-.636-.072-.936l2.028-1.572a.453.453 0 00.108-.576l-1.92-3.312a.453.453 0 00-.552-.192l-2.388.96a7.03 7.03 0 00-1.62-.936l-.36-2.52A.45.45 0 0014.04 3h-4.08a.45.45 0 00-.444.372l-.36 2.52a6.92 6.92 0 00-1.62.936l-2.388-.96a.45.45 0 00-.552.192l-1.92 3.312a.45.45 0 00.108.576l2.028 1.572c-.048.3-.072.6-.072.936 0 .324.024.636.072.936l-2.028 1.572a.453.453 0 00-.108.576l1.92 3.312c.12.204.36.288.552.192l2.388-.96c.492.384 1.032.708 1.62.936l.36 2.52a.45.45 0 00.444.372h4.08a.45.45 0 00.444-.372l.36-2.52a7.03 7.03 0 001.62-.936l2.388.96c.192.096.432.012.552-.192l1.92-3.312a.453.453 0 00-.108-.576l-2.028-1.572zM12 15.6a3.6 3.6 0 110-7.2 3.6 3.6 0 010 7.2z"
                                 fill="#B9A8FF" />
                             <circle cx="12" cy="12" r="2.5" fill="#763ed0" opacity="0.4" />
                         </svg>

                     </div>

                     <span class="nav-text">Settings</span>
                 </a>
                 <ul aria-expanded="false">
                     @if (auth()->user()->getRoleNames()->first() === 'Super Admin')
                         <li><a href="{{ route('store.index') }}">Store Settings</a></li>
                     @endif
                     <li><a href="{{ route('profile') }}">Profile</a></li>
                     <li><a href="{{ route('profile.change-password') }}">Change Password</a></li>
                 </ul>
             </li>
             {{-- 
             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="IconlyActivity">
                                 <g id="Activity">
                                     <path id="Activity_2" fill-rule="evenodd" clip-rule="evenodd"
                                         d="M17.1799 4.41C17.1799 3.08 18.2599 2 19.5899 2C20.9199 2 21.9999 3.08 21.9999 4.41C21.9999 5.74 20.9199 6.82 19.5899 6.82C18.2599 6.82 17.1799 5.74 17.1799 4.41ZM13.3298 14.7593L16.2198 11.0303L16.1798 11.0503C16.3398 10.8303 16.3698 10.5503 16.2598 10.3003C16.1508 10.0503 15.9098 9.8803 15.6508 9.8603C15.3798 9.8303 15.1108 9.9503 14.9498 10.1703L12.5308 13.3003L9.75976 11.1203C9.58976 10.9903 9.38976 10.9393 9.18976 10.9603C8.99076 10.9903 8.81076 11.0993 8.68976 11.2593L5.73076 15.1103L5.66976 15.2003C5.49976 15.5193 5.57976 15.9293 5.87976 16.1503C6.01976 16.2403 6.16976 16.3003 6.33976 16.3003C6.57076 16.3103 6.78976 16.1893 6.92976 16.0003L9.43976 12.7693L12.2898 14.9103L12.3798 14.9693C12.6998 15.1393 13.0998 15.0603 13.3298 14.7593ZM15.4498 3.7803C15.4098 4.0303 15.3898 4.2803 15.3898 4.5303C15.3898 6.7803 17.2098 8.5993 19.4498 8.5993C19.6998 8.5993 19.9398 8.5703 20.1898 8.5303V16.5993C20.1898 19.9903 18.1898 22.0003 14.7898 22.0003H7.40076C3.99976 22.0003 1.99976 19.9903 1.99976 16.5993V9.2003C1.99976 5.8003 3.99976 3.7803 7.40076 3.7803H15.4498Z"
                                         fill="#130F26" />
                                 </g>
                             </g>
                         </svg>
                     </div>
                     <span class="nav-text">Charts</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="chart-flot.html">Flot</a></li>
                     <li><a href="chart-morris.html">Morris</a></li>
                     <li><a href="chart-chartjs.html">Chartjs</a></li>
                     <li><a href="chart-chartist.html">Chartist</a></li>
                     <li><a href="chart-sparkline.html">Sparkline</a></li>
                     <li><a href="chart-peity.html">Peity</a></li>
                 </ul>
             </li>
             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path opacity="0.4"
                                 d="M11.7759 21.8374C9.49286 20.4273 7.37056 18.7645 5.44782 16.8796C4.09044 15.5338 3.0538 13.8905 2.4171 12.0753C1.27947 8.53523 2.60374 4.48948 6.30105 3.2884C8.25256 2.67553 10.375 3.05175 12.007 4.29983C13.6396 3.05315 15.7613 2.67705 17.7129 3.2884C21.4102 4.48948 22.7434 8.53523 21.6058 12.0753C20.9742 13.8888 19.9438 15.5319 18.5928 16.8796C16.6683 18.7625 14.5463 20.4251 12.2647 21.8374L12.0159 22L11.7759 21.8374Z"
                                 fill="#B9A8FF" />
                             <path
                                 d="M12.0109 22L11.776 21.8374C9.49013 20.4274 7.36487 18.7647 5.43902 16.8796C4.0752 15.5356 3.03238 13.8922 2.39052 12.0753C1.26177 8.53523 2.58605 4.48948 6.28335 3.2884C8.23486 2.67553 10.3853 3.05204 12.0109 4.31057V22Z"
                                 fill="#B9A8FF" />
                             <path
                                 d="M18.2304 9.99922C18.0296 9.98629 17.8425 9.8859 17.7131 9.72157C17.5836 9.55723 17.5232 9.3434 17.5459 9.13016C17.5677 8.4278 17.168 7.78851 16.5517 7.53977C16.1609 7.43309 15.9243 7.00987 16.022 6.59249C16.1148 6.18182 16.4993 5.92647 16.8858 6.0189C16.9346 6.027 16.9816 6.04468 17.0244 6.07105C18.2601 6.54658 19.0601 7.82641 18.9965 9.22576C18.9944 9.43785 18.9117 9.63998 18.7673 9.78581C18.6229 9.93164 18.4291 10.0087 18.2304 9.99922Z"
                                 fill="#763ed0" />
                         </svg>
                     </div>
                     <span class="nav-text">Bootstrap</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="ui-accordion.html">Accordion</a></li>
                     <li><a href="ui-alert.html">Alert</a></li>
                     <li><a href="ui-badge.html">Badge</a></li>
                     <li><a href="ui-button.html">Button</a></li>
                     <li><a href="ui-modal.html">Modal</a></li>
                     <li><a href="ui-button-group.html">Button Group</a></li>
                     <li><a href="ui-list-group.html">List Group</a></li>
                     <li><a href="ui-card.html">Cards</a></li>
                     <li><a href="ui-carousel.html">Carousel</a></li>
                     <li><a href="ui-dropdown.html">Dropdown</a></li>
                     <li><a href="ui-popover.html">Popover</a></li>
                     <li><a href="ui-progressbar.html">Progressbar</a></li>
                     <li><a href="ui-tab.html">Tab</a></li>
                     <li><a href="ui-typography.html">Typography</a></li>
                     <li><a href="ui-pagination.html">Pagination</a></li>
                     <li><a href="ui-grid.html">Grid</a></li>

                 </ul>
             </li>
             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="IconlyFilter">
                                 <g id="Filter">
                                     <path id="Filter_2" fill-rule="evenodd" clip-rule="evenodd"
                                         d="M8.87774 6.37856C8.87774 8.24523 7.33886 9.75821 5.43887 9.75821C3.53999 9.75821 2 8.24523 2 6.37856C2 4.51298 3.53999 3 5.43887 3C7.33886 3 8.87774 4.51298 8.87774 6.37856ZM20.4933 4.89833C21.3244 4.89833 22 5.56203 22 6.37856C22 7.19618 21.3244 7.85989 20.4933 7.85989H13.9178C13.0856 7.85989 12.4101 7.19618 12.4101 6.37856C12.4101 5.56203 13.0856 4.89833 13.9178 4.89833H20.4933ZM3.50777 15.958H10.0833C10.9155 15.958 11.5911 16.6217 11.5911 17.4393C11.5911 18.2558 10.9155 18.9206 10.0833 18.9206H3.50777C2.67555 18.9206 2 18.2558 2 17.4393C2 16.6217 2.67555 15.958 3.50777 15.958ZM18.5611 20.7778C20.4611 20.7778 22 19.2648 22 17.3992C22 15.5325 20.4611 14.0196 18.5611 14.0196C16.6623 14.0196 15.1223 15.5325 15.1223 17.3992C15.1223 19.2648 16.6623 20.7778 18.5611 20.7778Z"
                                         fill="#130F26" />
                                 </g>
                             </g>
                         </svg>
                     </div>
                     <span class="nav-text">Plugins</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="uc-select2.html">Select 2</a></li>
                     <li><a href="uc-nestable.html">Nestedable</a></li>
                     <li><a href="uc-noui-slider.html">Noui Slider</a></li>
                     <li><a href="uc-sweetalert.html">Sweet Alert</a></li>
                     <li><a href="uc-toastr.html">Toastr</a></li>
                     <li><a href="map-jqvmap.html">Jqv Map</a></li>
                     <li><a href="uc-lightgallery.html">Light Gallery</a></li>
                 </ul>
             </li>
             <li><a href="widget-basic.html" class="" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path opacity="0.4"
                                 d="M16.0754 2H19.4614C20.8636 2 21.9999 3.14585 21.9999 4.55996V7.97452C21.9999 9.38864 20.8636 10.5345 19.4614 10.5345H16.0754C14.6731 10.5345 13.5369 9.38864 13.5369 7.97452V4.55996C13.5369 3.14585 14.6731 2 16.0754 2Z"
                                 fill="#763ed0" />
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M4.53852 2H7.92449C9.32676 2 10.463 3.14585 10.463 4.55996V7.97452C10.463 9.38864 9.32676 10.5345 7.92449 10.5345H4.53852C3.13626 10.5345 2 9.38864 2 7.97452V4.55996C2 3.14585 3.13626 2 4.53852 2ZM4.53852 13.4655H7.92449C9.32676 13.4655 10.463 14.6114 10.463 16.0255V19.44C10.463 20.8532 9.32676 22 7.92449 22H4.53852C3.13626 22 2 20.8532 2 19.44V16.0255C2 14.6114 3.13626 13.4655 4.53852 13.4655ZM19.4615 13.4655H16.0755C14.6732 13.4655 13.537 14.6114 13.537 16.0255V19.44C13.537 20.8532 14.6732 22 16.0755 22H19.4615C20.8637 22 22 20.8532 22 19.44V16.0255C22 14.6114 20.8637 13.4655 19.4615 13.4655Z"
                                 fill="#B9A8FF" />
                         </svg>
                     </div>
                     <span class="nav-text">Widget</span>
                 </a>
             </li>
             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="IconlyDocument">
                                 <g id="Document">
                                     <path id="Document_2" fill-rule="evenodd" clip-rule="evenodd"
                                         d="M7.81 2H16.191C19.28 2 21 3.78 21 6.83V17.16C21 20.26 19.28 22 16.191 22H7.81C4.77 22 3 20.26 3 17.16V6.83C3 3.78 4.77 2 7.81 2ZM8.08 6.66V6.65H11.069C11.5 6.65 11.85 7 11.85 7.429C11.85 7.87 11.5 8.22 11.069 8.22H8.08C7.649 8.22 7.3 7.87 7.3 7.44C7.3 7.01 7.649 6.66 8.08 6.66ZM8.08 12.74H15.92C16.35 12.74 16.7 12.39 16.7 11.96C16.7 11.53 16.35 11.179 15.92 11.179H8.08C7.649 11.179 7.3 11.53 7.3 11.96C7.3 12.39 7.649 12.74 8.08 12.74ZM8.08 17.31H15.92C16.319 17.27 16.62 16.929 16.62 16.53C16.62 16.12 16.319 15.78 15.92 15.74H8.08C7.78 15.71 7.49 15.85 7.33 16.11C7.17 16.36 7.17 16.69 7.33 16.95C7.49 17.2 7.78 17.35 8.08 17.31Z"
                                         fill="#130F26" />
                                 </g>
                             </g>
                         </svg>
                     </div>
                     <span class="nav-text">Forms</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="form-element.html">Form Elements</a></li>
                     <li><a href="form-wizard.html">Wizard</a></li>
                     <li><a href="form-ckeditor.html">CkEditor</a></li>
                     <li><a href="form-pickers.html">Pickers</a></li>
                     <li><a href="form-validation.html">Form Validate</a></li>
                 </ul>
             </li>
             <li><a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <g id="IconlySwap">
                                 <g id="Swap">
                                     <path id="Swap_2" fill-rule="evenodd" clip-rule="evenodd"
                                         d="M7.54618 3.27793C7.71236 3.39789 7.98037 3.67345 7.98037 3.67345C9.02079 4.64858 10.5879 7.07394 11.0911 8.30444C11.1016 8.30444 11.4001 9.03608 11.4118 9.38409V9.43041C11.4118 9.96371 11.1133 10.4626 10.6335 10.7179C10.4357 10.8232 9.95456 10.9211 9.72244 10.9683C9.64556 10.984 9.59599 10.9941 9.59308 10.997C8.90727 11.1016 7.85514 11.1704 6.70003 11.1704C5.48757 11.1704 4.38981 11.1016 3.71453 10.9733C3.70282 10.9733 3.08606 10.8462 2.88009 10.7642C2.58282 10.6372 2.3312 10.4044 2.17087 10.1145C2.05618 9.88294 2 9.63827 2 9.38409C2.01053 9.11685 2.18257 8.618 2.26215 8.42083C2.76539 7.12026 4.41204 4.6367 5.41852 3.68532C5.52307 3.57922 5.64206 3.46806 5.72485 3.39071C5.76902 3.34945 5.8029 3.3178 5.81877 3.30169C6.07039 3.10452 6.37936 3 6.71173 3C7.00783 3 7.30509 3.09264 7.54618 3.27793ZM18.2286 10.1618C18.2286 10.6856 17.8108 11.1096 17.2947 11.1096C16.7786 11.1096 16.3608 10.6856 16.3608 10.1618L16.1033 5.58295C16.1033 4.91543 16.637 4.375 17.2947 4.375C17.9524 4.375 18.4849 4.91543 18.4849 5.58295L18.2286 10.1618ZM21.1199 13.2356C21.4172 13.3639 21.6688 13.5955 21.8291 13.8853C21.9438 14.1169 22 14.3616 22 14.617C21.9895 14.883 21.8174 15.3831 21.7367 15.5802C21.2346 16.8797 19.5868 19.3633 18.5815 20.3158C18.4787 20.4194 18.3619 20.5284 18.2793 20.6055L18.2792 20.6055C18.2331 20.6486 18.1976 20.6817 18.1812 20.6983C17.9284 20.8955 17.6206 21 17.2894 21C16.991 21 16.6937 20.9074 16.4538 20.7209C16.2876 20.6021 16.0196 20.3265 16.0196 20.3265C14.978 19.3526 13.4121 16.926 12.9089 15.6954C12.8972 15.6954 12.5999 14.965 12.5882 14.617V14.5706C12.5882 14.0361 12.8855 13.5373 13.3665 13.2819C13.5639 13.1777 14.0435 13.0796 14.2762 13.0319L14.2762 13.0319C14.3539 13.016 14.404 13.0058 14.4069 13.0028C15.0927 12.8983 16.1449 12.8294 17.3 12.8294C18.5124 12.8294 19.6102 12.8983 20.2855 13.0265C20.296 13.0265 20.9139 13.1536 21.1199 13.2356ZM6.70553 12.8905C6.18942 12.8905 5.77161 13.3146 5.77161 13.8383L5.51414 18.4171C5.51414 19.0846 6.04781 19.625 6.70553 19.625C7.36325 19.625 7.89575 19.0846 7.89575 18.4171L7.63945 13.8383C7.63945 13.3146 7.22165 12.8905 6.70553 12.8905Z"
                                         fill="#130F26" />
                                 </g>
                             </g>
                         </svg>
                     </div>
                     <span class="nav-text">Table</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="table-bootstrap-basic.html">Bootstrap</a></li>
                     <li><a href="table-datatable-basic.html">Datatable</a></li>
                 </ul>
             </li>
             <li>
                 <a class="has-arrow " href="javascript:void()" aria-expanded="false">
                     <div class="menu-icon">
                         <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <path opacity="0.4"
                                 d="M2.00024 11.0785C2.05024 13.4165 2.19024 17.4155 2.21024 17.8565C2.28124 18.7995 2.64224 19.7525 3.20424 20.4245C3.98624 21.3675 4.94924 21.7885 6.29224 21.7885C8.14824 21.7985 10.1942 21.7985 12.1812 21.7985C14.1762 21.7985 16.1122 21.7985 17.7472 21.7885C19.0712 21.7885 20.0642 21.3565 20.8362 20.4245C21.3982 19.7525 21.7592 18.7895 21.8102 17.8565C21.8302 17.4855 21.9302 13.1445 21.9902 11.0785H2.00024Z"
                                 fill="#763ed0" />
                             <path
                                 d="M11.2455 15.3842V16.6782C11.2455 17.0922 11.5815 17.4282 11.9955 17.4282C12.4095 17.4282 12.7455 17.0922 12.7455 16.6782V15.3842C12.7455 14.9702 12.4095 14.6342 11.9955 14.6342C11.5815 14.6342 11.2455 14.9702 11.2455 15.3842Z"
                                 fill="#763ed0" />
                             <path fill-rule="evenodd" clip-rule="evenodd"
                                 d="M10.2114 14.5564C10.1114 14.9194 9.76237 15.1514 9.38437 15.1014C6.83337 14.7454 4.39537 13.8404 2.33737 12.4814C2.12637 12.3434 2.00037 12.1074 2.00037 11.8554V8.3894C2.00037 6.2894 3.71237 4.5814 5.81737 4.5814H7.78437C7.97237 3.1294 9.20237 2.0004 10.7044 2.0004H13.2864C14.7874 2.0004 16.0184 3.1294 16.2064 4.5814H18.1834C20.2824 4.5814 21.9904 6.2894 21.9904 8.3894V11.8554C21.9904 12.1074 21.8634 12.3424 21.6544 12.4814C19.5924 13.8464 17.1444 14.7554 14.5764 15.1104C14.5414 15.1154 14.5074 15.1174 14.4734 15.1174C14.1344 15.1174 13.8314 14.8884 13.7464 14.5524C13.5444 13.7564 12.8214 13.1994 11.9904 13.1994C11.1484 13.1994 10.4334 13.7444 10.2114 14.5564ZM13.2864 3.5004H10.7044C10.0314 3.5004 9.46937 3.9604 9.30137 4.5814H14.6884C14.5204 3.9604 13.9584 3.5004 13.2864 3.5004Z"
                                 fill="#B9A8FF" />
                         </svg>
                     </div>
                     <span class="nav-text">Pages</span>
                 </a>
                 <ul aria-expanded="false">
                     <li><a href="page-login.html">Login</a></li>
                     <li><a href="page-register.html">Register</a></li>
                     <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Error</a>
                         <ul aria-expanded="false">
                             <li><a href="page-error-400.html">Error 400</a></li>
                             <li><a href="page-error-403.html">Error 403</a></li>
                             <li><a href="page-error-404.html">Error 404</a></li>
                             <li><a href="page-error-500.html">Error 500</a></li>
                             <li><a href="page-error-503.html">Error 503</a></li>
                         </ul>
                     </li>
                     <li><a href="page-lock-screen.html">Lock Screen</a></li>
                     <li><a href="empty-page.html">Empty Page</a></li>
                 </ul>
             </li> --}}
         </ul>
     </div>
 </div>

 <!--**********************************
            Sidebar end
        ***********************************-->
