<div class="col-md-6 col-lg-3">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="user_profile text-center">
                <div class="user_img">
                    <img src="">
                </div>

                <div class="user_info">
                    <p class="mb-0"><b></b></p>
                    <p class="mb-0"></p>
                    <p class="mb-0"></p>
                </div>
            </div>

            <div class="user_menu mt-4">
                <ul class="list-group up_nav">
                    <li class="list-group-item"><a href="{{route('memberDashboard')}}"><i class="fa fa-th-large"></i> Dashboard</a></li>
                    <li class="list-group-item">
                        <a href="{{ route('member.profile') }}">
                            <i class="fa fa-user"></i> Profile
                        </a>
                    </li>
                    <li class="list-group-item"><a href="{{ route('member.contribution') }}"><i class="fas fa-hand-holding-heart"></i> Contribution</a></li>
                    <li class="list-group-item"><a href="{{ route('member.event_join') }}"><i class="fa fa-calendar"></i> Event Join</a></li>

                    <li class="list-group-item"><a href="" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-lock"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
