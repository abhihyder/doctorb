<div class="scrollbar-inner">
    <!-- Brand -->
    <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
            <!-- <img src="../assets/img/brand/blue.png" class="navbar-brand-img" alt="..."> -->
            <div class="row">
                <div class="col-2">
                    <div class="d-xl-none">
                        <div class="pr-3 sidenav-toggler sidenav-toggler" data-action="sidenav-pin"
                             data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10 pull-left">
                    <h4>Doctor Bazar</h4>
                </div>
            </div>
        </a>
    </div>
    <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Nav items -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}" href="{{url('home')}}">
                        <i class="ni ni-tv-2 text-primary"></i>
                        <span class="nav-link-text">Dashboard </span>
                    </a>
                </li>


                @if(Auth::user()->user_type == 1)

                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'chamber' ? 'active' : '' }}"href="{{route('chamber.index')}}">
                        <i class="ni ni-planet text-orange"></i>
                        <span class="nav-link-text">Chamber</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'agent' ? 'active' : '' }}"href="{{route('agent.index')}}">
                        <i class="ni ni-pin-3 text-primary"></i>
                        <span class="nav-link-text">Agent</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'organization' ? 'active' : '' }}"href="{{route('organization.index')}}">
                        <i class="ni ni-single-02 text-yellow"></i>
                        <span class="nav-link-text">Organization</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'doctor' ? 'active' : '' }}"href="{{route('doctor.index')}}">
                        <i class="ni ni-bullet-list-67 text-default"></i>
                        <span class="nav-link-text">Doctor</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'doctor_assistantdoctor_assistant' ? 'active' : '' }}"href="{{route('doctor_assistant.index')}}">
                        <i class="ni ni-key-25 text-info"></i>
                        <span class="nav-link-text">Doctor Assistant</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'booking' ? 'active' : '' }}"href="{{route('booking.index')}}">
                        <i class="ni ni-circle-08 text-pink"></i>
                        <span class="nav-link-text">Booking</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link {{ Request::segment(1) == 'patient' ? 'active' : '' }}"href="{{route('patient.index')}}">
                        <i class="ni ni-send text-dark"></i>
                        <span class="nav-link-text">Patient</span>
                    </a>
                </li>

                @endif

                @if(Auth::user()->user_type == '2x201')

                    <li class="nav-item">
                        <a  class="nav-link {{ Request::segment(1) == 'doctor-patient' ? 'active' : '' }}"href="{{url('/doctor-patient')}}">
                            <i class="ni ni-send text-dark"></i>
                            <span class="nav-link-text">Patient</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link {{ Request::segment(1) == 'chamber-panel' ? 'active' : '' }}"href="{{url('/chamber-panel/index')}}">
                            <i class="ni ni-circle-08 text-pink"></i>
                            <span class="nav-link-text">Chamber</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link {{ Request::segment(1) == 'operation-schedule' ? 'active' : '' }}"href="{{url('/operation-schedule')}}">
                            <i class="ni ni-circle-08 text-pink"></i>
                            <span class="nav-link-text">Operation Schedule</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link {{ Request::segment(1) == 'doctor-coins' ? 'active' : '' }}"href="{{url('/doctor-coins')}}">
                            <i class="ni ni-circle-08 text-pink"></i>
                            <span class="nav-link-text">Coins</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a  class="nav-link {{ Request::segment(1) == 'doctor-coins' ? 'active' : '' }}"href="{{url('/doctor-coins')}}">
                            <i class="ni ni-circle-08 text-dark"></i>
                            <span class="nav-link-text">Account</span>
                        </a>
                    </li>


                 @endif

                {{--For Organization --}}

                @if(Auth::user()->user_type == 3)

                    <li class="nav-item">
                        <a  class="nav-link {{ Request::segment(1) == 'organization-list' ? 'active' : '' }}"href="{{url('/doctor-patient')}}">
                            <i class="ni ni-send text-dark"></i>
                            <span class="nav-link-text">Patient</span>
                        </a>
                    </li>

                 @endif


            </ul>

        </div>
    </div>
</div>
