<?php
$user = Auth::user();
$date = date('Y-m-d');
$clockInTime = App\ClockInOut::where('emp_id', $user['id'])->whereDate('created_at', $date)->orderBy('id', 'DESC')->first();
$id = Auth::user()->id;
$permission = App\SidebarPermission::with(['sidebar' => function ($query) {
    $query->where('parent_id', 0)->get();
}])->where('emp_id', $id)->get()->toArray();

$notification=App\NotificationModel::where('trash',0)->orderBy('id','DESC')->get();
$i=0;
foreach($notification as $val){
    if(!in_array($id,json_decode($val->seen_by))){
         $i++;
      }
}
?>
<style>
    .profile_img {
        position: absolute;
    }

    .profile_name {
        position: relative;
        top: 1px;
        font-size: 30px;
        color: #fff;
        left: 7px;
        font-weight: bold;
        text-transform: uppercase;
    }

    .widget-profile .profile-info-widget .booking-doc-img {
        background: none !important;
    }

    .employee_list {
        display: none;
        z-index: 99999;
        position: absolute;
        background: white;
        width: 248px;
        border-radius: 30px;

    }

    .employee_list li {
        text-align: left;
        text-transform: capitalize;
    }
</style>
<header class="header">

    <!-- Top Header Section -->
    <div class="top-header-section">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-sm-3 col-6">
                    <div class="logo my-3 my-sm-0">
                        <a href="{{Session::get('logRole')==1?url('/dashboard'):url('/emp_dashboard')}}">
                            <img src="{{url('public/assets/img/logo.png')}}" alt="logo image" class="img-fluid" width="100">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-6 text-right">
                    <div class="user-block d-none d-lg-block">
                        <div class="row align-items-center">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="user-notification-block align-right d-inline-block">
                                    <div class="top-nav-search">
                                        <div>
                                            <input type="text" class="form-control search_employee" placeholder="Search here" >
                                        </div>
                                        <ul class="employee_list"></ul>
                                    </div>
                                </div>
                                <!-- User notification  123-->
                                <div class="user-notification-block align-right d-inline-block">
                                    <ul class="list-inline m-0">
                                        @if(Auth::user()->role !=1 && Request::segment(1)=='emp_dashboard'))
                                        <li class="list-inline-item">
                                            <a href="javascript:void(0)" id="{{isset($clockInTime['clock_in'])?isset($clockInTime['clock_out'])?'clock_in':'clock_out':'clock_in'}}" class="btn btn-danger menu-style text-white align-middle" >
                                                {{isset($clockInTime['clock_in'])?isset($clockInTime['clock_out'])?'Clock In':'Clock out':'Clock In'}}
                                            </a>
                                        </li>
                                        @endif
                                        <li class="list-inline-item mr-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Notification">
                                            <a href="{{url('notification')}}" class="font-23 menu-style text-white align-middle">
                                                <span class="lnr lnr-alarm"></span>
                                                <span class="badge badge-pill" style="display:{{$i !=0?'inline-block':'none'}}"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /User notification-->

                                <!-- user info-->
                                <div class="user-info align-right dropdown d-inline-block header-dropdown">
                                    <a href="javascript:void(0)" data-toggle="dropdown" class=" menu-style dropdown-toggle">
                                        <div class="user-avatar d-inline-block">
                                            @if(Auth::user()->profile_image)
                                            <img src="{{url('public/profile/'.Auth::user()->profile_image)}}" alt="user avatar" class="rounded-circle img-fluid" width="55">
                                            @else
                                            <img class="profile_img rounded-circle img-fluid" src="{{url('public/assets/img/profiles/profile.png')}}" alt="{{Auth::user()->name}}" width="70">
                                            <span class="profile_name">{{substr(Auth::user()->name, 0, 2)}}</span>
                                            @endif
                                        </div>
                                    </a>

                                    <!-- Notifications -->
                                    <div class="dropdown-menu notification-dropdown-menu shadow-lg border-0 p-3 m-0 dropdown-menu-right">
                                        <a class="dropdown-item p-2" href="{{url('your_profile')}}">
                                            <span class="media align-items-center">
                                                <span class="lnr lnr-user mr-3"></span>
                                                <span class="media-body text-truncate">
                                                    <span class="text-truncate">Profile</span>
                                                </span>
                                            </span>
                                        </a>
                                        <a class="dropdown-item p-2" href="{{url('/logout')}}">
                                            <span class="media align-items-center">
                                                <span class="lnr lnr-power-switch mr-3"></span>
                                                <span class="media-body text-truncate">
                                                    <span class="text-truncate">Logout</span>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                    <!-- Notifications -->

                                </div>
                                <!-- /User info-->

                            </div>
                        </div>
                    </div>
                    <div class="d-block d-lg-none">
                        <a href="javascript:void(0)">
                            <span class="lnr lnr-user d-block display-5 text-white" id="open_navSidebar"></span>
                        </a>

                        <!-- Offcanvas menu -->
                        <div class="offcanvas-menu" id="offcanvas_menu">
                            <span class="lnr lnr-cross float-left display-6 position-absolute t-1 l-1 text-white" id="close_navSidebar"></span>
                            <div class="user-info align-center bg-theme text-center">
                                <a href="javascript:void(0)" class="d-block menu-style text-white">
                                    <div class="user-avatar d-inline-block mr-3">
                                        @if(Auth::user()->profile_image)

                                        <img src="{{url('public/profile/'.Auth::user()->profile_image)}}" alt="user avatar" class="rounded-circle img-fluid" width="55">
                                        @else
                                        <img src="{{url('public/assets/img/profiles/profile.png')}}" alt="user avatar" class="rounded-circle img-fluid" width="55">

                                        @endif
                                    </div>
                                </a>
                            </div>

                            <hr>
                            <div class="user-menu-items px-3 m-0">
                                <div class="user-notification-block align-center">
                                <div class="top-nav-search">
                                        <div>
                                            <input type="text" class="form-control search_employee" placeholder="Search here">
                                        </div>
                                        <ul class="employee_list"></ul>
                                    </div>
                                </div>
                                <a class="px-0 pb-2 pt-0" href="{{Auth::user()->role==1?url('/dashboard'):url('emp_dashboard')}}">
                                    <span class="media align-items-center">
                                        <span class="lnr lnr-home mr-3"></span>
                                        <span class="media-body text-truncate text-left">
                                            <span class="text-truncate text-left">Dashboard</span>
                                        </span>
                                    </span>
                                </a>
                                <?php $i = 0 ?>
                                @if(!empty($permission))
                                @foreach($permission as $value)
                                @if($value['sidebar'])
                                <a class="p-2" href="{{url($value['sidebar'][0]['slug'])}}">
                                    <span class="media align-items-center">
                                        <span class=" lnr {{$value['sidebar'][0]['sidebar_class']}} mr-3"></span>
                                        <span class="media-body text-truncate text-left">
                                            <span class="text-truncate text-left">{{$value['sidebar'][0]['name']}}</span>
                                        </span>
                                    </span>
                                </a>
                                @endif
                                <?php $i++; ?>
                                @endforeach
                                @endif

                                <a class="p-2" href="{{url('logout')}}">
                                    <span class="media align-items-center">
                                        <span class="lnr lnr-power-switch mr-3"></span>
                                        <span class="media-body text-truncate text-left">
                                            <span class="text-truncate text-left">Logout</span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <!-- /Offcanvas menu -->

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Top Header Section -->

</header>

<div class="modal fade" id="view-information" role="document">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <!-- Modal body -->
            <div class="modal-body style-add-modal">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title mb-3">Employee Details</h4>
                <div class="modal_content"></div>

            </div>
        </div>
    </div>
</div>