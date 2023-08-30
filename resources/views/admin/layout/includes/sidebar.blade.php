<div class="page-sidebar">
    <div class="logo-box"><a href="#" class="logo-text">{{ env('APP_NAME', '') }}</a><a href="#"
            id="sidebar-close"><i class="material-icons">close</i></a> <a href="#" id="sidebar-state"><i
                class="material-icons">adjust</i><i class="material-icons compact-sidebar-icon">panorama_fish_eye</i></a>
    </div>
    <div class="page-sidebar-inner slimscroll">
        <ul class="accordion-menu" id="accordion-menu">

            <li>
                <a href="{{ route('admin.dashboard.index') }}">
                    <i class="material-icons">dashboard</i>
                    dashboard
                </a>

            </li>

            <li>
                <a href="{{ route('admin.setting.gallery.type.index') }}">
                    <i class="material-icons">collections</i>
                    Gallery
                </a>

            </li>
            {{-- <li>
                <a href="{{route('admin.download.type.index')}}">
                    <i class="material-icons">download</i>
                    Downloads
                </a>
            </li> --}}
            <li>
                <a href="{{ route('admin.team.type.index') }}">
                    <i class="material-icons">people</i>
                    Teams
                </a>
            </li>
            {{-- <li>
                <a href="{{ route('admin.story.index') }}">
                    <i class="material-icons">story</i>
                    Story
                </a>
            </li> --}}

            <li>
                <a href="{{ route('admin.service.type.index') }}">
                    <i class="material-icons">gavel</i>
                    Services
                </a>
            </li>
            @foreach (\App\Data::pageTypes as $key => $pagetype)
                <li>
                    <a href="#">
                        <i class="material-icons">space_dashboard</i>
                        {{ $pagetype[1] }}
                        <i class="material-icons has-sub-menu">add</i>
                    </a>
                    <ul class="sub-menu">
                        <li class="sub-item">
                            <a href="{{ route('admin.page.add', ['type' => $key]) }}">Add {{ $pagetype[0] }}</a>
                        </li>
                        <li class="sub-item">
                            <a href="{{ route('admin.page.index', ['type' => $key]) }}">List {{ $pagetype[1] }}</a>
                        </li>

                    </ul>
                </li>
            @endforeach
            {{-- <li >
                <a href="#">
                    <i class="material-icons">event</i>
                    Events
                    <i class="material-icons has-sub-menu">add</i>
                </a>
                <ul class="sub-menu">
                    <li class="sub-item">
                        <a  href="{{route('admin.event.add')}}" >Add Event</a>
                    </li>
                    <li class="sub-item">
                        <a  href="{{route('admin.event.index')}}" >List Events</a>
                    </li>

                </ul>
            </li> --}}
            <li>
                <a href="#">
                    <i class="material-icons">settings</i>
                    Front Setting
                    <i class="material-icons has-sub-menu">add</i>
                </a>
                <ul class="sub-menu">
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.meta') }}">Sharing</a>
                    </li>
                    {{-- <li class="sub-item">
                        <a  href="{{route('admin.setting.homepage')}}" >HomePage</a>
                    </li> --}}
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.contact') }}">Contact</a>
                    </li>
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.story.index') }}">Story</a>
                    </li> --}}
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.faq.index') }}">Faqs</a>
                    </li> --}}
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'top']) }}">Header</a>
                    </li> --}}
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.menu.index') }}">Menus</a>
                    </li> --}}
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.slider.index') }}">sliders</a>
                    </li>
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'homeabout']) }}">Home About</a>
                    </li> --}}
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'homefacts']) }}">Home Facts</a>
                    </li> --}}
                    {{-- <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'homefeature']) }}">Home Features</a>
                    </li> --}}
                    {{-- <li class="sub-item">
                        <a  href="{{route('admin.setting.footer.index')}}" >Footer</a>
                    </li> --}}
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.popup.index') }}">Popups</a>
                    </li>
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'headerimage']) }}">HeaderImage</a>
                    </li>
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'intro']) }}">Intro</a>
                    </li>
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'connect']) }}">Connect</a>
                    </li>
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'aboutus']) }}">About us</a>
                    </li>
                    <li class="sub-item">
                        <a href="{{ route('admin.setting.index', ['type' => 'copy']) }}">Copyright</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <br>
    </div>
</div>
