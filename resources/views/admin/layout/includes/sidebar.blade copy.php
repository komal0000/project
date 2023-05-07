<div class="page-sidebar">
    <div class="logo-box"><a href="#" class="logo-text">{{env('APP_NAME','')}}</a><a href="#" id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a></div>
    <div class="page-sidebar-inner slimscroll">
        <ul class="accordion-menu" id="accordion-menu">

            <li>
                <a href="{{route('admin.dashboard.index')}}">
                    <i class="material-icons">dashboard</i>
                    dashboard
                </a>

            </li>

            <li>
                <a  href="{{route('admin.assessment.index')}}" >
                    <i class="material-icons">dashboard</i>
                    Assessments
                </a>
            </li>
            <li>
                <a  href="{{route('admin.exam.index')}}" >
                    <i class="material-icons">dashboard</i>
                    Exam
                </a>
            </li>

            <li >
                <a href="#">
                    <i class="material-icons">settings</i>
                    Student
                    <i class="material-icons has-sub-menu">add</i>
                </a>
                <ul class="sub-menu">
                    <li class="sub-item">
                        <a  href="{{route('admin.student.index')}}" >List</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.student.add')}}" >Add New</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.student.attendance.index')}}" >Attendance</a>
                    </li>
                </ul>
            </li>
            <li >
                <a href="#">
                    <i class="material-icons">supervisor_account</i>
                    HR
                    <i class="material-icons has-sub-menu">add</i>
                    </a>
                <ul class="sub-menu">
                    {{-- {{-- <li class="sub-item">
                        <a  href="{{route('admin.setting.category.index')}}" >Services</a>
                    </li> --}}
                    <li class="sub-item">
                        <a  href="{{route('admin.employee.index')}}" >Employees</a>
                    </li>
                    <li class="sub-item">
                        <a href="#">Employee Assessment</a>
                    </li>
                </ul>
            </li>
            <li >
                <a href="#">
                    <i class="material-icons">settings</i>
                    Settings
                    <i class="material-icons has-sub-menu">add</i>
                </a>
                <ul class="sub-menu">
                    <li class="sub-item">
                        <a  href="{{route('admin.setting.level.index')}}" >Level</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.setting.academicyear.index')}}" >Academic Years</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.setting.caste')}}" >Caste</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.setting.religion')}}" >Religions</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.setting.category')}}" >Categories</a>
                    </li>
                </ul>
            </li>

            @foreach (\App\Data::pageTypes as $key=>$pagetype)
            <li >
                <a href="#">
                    <i class="material-icons">settings</i>
                    {{$pagetype[1]}}
                    <i class="material-icons has-sub-menu">add</i>
                </a>
                <ul class="sub-menu">
                    <li class="sub-item">
                        <a  href="{{route('admin.page.add',['type'=>$key])}}" >Add {{$pagetype[0]}}</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.page.index',['type'=>$key])}}" >List {{$pagetype[1]}}</a>
                    </li>
                  
                </ul>
            </li>
            @endforeach

        </ul>
        <br>
        <br>
    </div>
</div>
