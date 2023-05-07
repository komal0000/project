@extends('admin.layout.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('admin/plugins/drophify/css/dropify.min.css') }}">
    <style>
        .col-md-3 {
            margin-bottom: 10px;
        }

        label {
            font-weight: 600;
            font-size: 1.1rem;
            /* margin-bottom: 5px; */
            color: black;
            margin-top: 5px;
        }

        .form-control,
        .tox {
            border-radius: 5px !important;
        }

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.setting.slider.index') }}">Sliders</a>
    </li>
    <li class="breadcrumb-item">
        {{$slider->title}}
    </li>
    <li class="breadcrumb-item active">
        Edit
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.setting.slider.edit',['slider'=>$slider->id]) }}" method="post" enctype="multipart/form-data" id="add-slider">

                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <label for="image">Image</label>
                        <input type="file" name="image" id="image" class="form-control photo"  data-default-file="{{asset($slider->image)}}">
                    </div>
                    {{-- <div class="col-md-3">
                        <label for="mobile_image">Mobile Image</label>
                        <input type="file" name="mobile_image" id="mobile_image" class="form-control photo"  data-default-file="{{asset($slider->image)}}">
                    </div> --}}
                    <div class="col-md-12">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control " required value="{{$slider->title}}">
                    </div>
                    <div class="col-md-12">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" name="subtitle" id="subtitle" class="form-control " required value="{{$slider->subtitle}}">
                    </div>

                </div>
                {{-- <h5 class="p-3 shadow mt-3">
                    Current Link : {{$slider->link}}  <br> Link Text : {{$slider->link_title}}
                </h5>
                <div class="py-2">
                    <input type="checkbox" value="1" name="change_link"  id="change-link" onchange="$('#btn-setting').css('display',this.checked?'block':'none');"> <label for="change-link">Change Link</label>
                </div>

                <div class="shadow mt-3" id="btn-setting" style="display: none">
                    <h5 class="p-3">Button Setting</h5>
                    <hr class="m-0">
                        <div class="p-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="link_title">Title</label>
                                        <input type="text" name="link_title" id="link_title" value="{{$slider->link_title}}" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="type">Link Type</label>
                                        <select name="type" id="type" class="form-control" >
                                            @php
                                                $i = 2;
                                            @endphp
                                            @foreach (\App\Data::pageTypes as $key => $pageType)
                                                <option value="{{ $key }}">{{ $pageType[1] }}</option>
                                            @endforeach
                                            <option value="2">Other Link</option>
                                            <option value="3">Custom Link</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="link-wrapper">

                                    <div class="form-group">
                                        <label for="links">links</label>
                                        <select name="links" id="links" class="form-control">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3" id="extra-link-wrapper">
                                    <div class="form-group">
                                        <label for="extra-links">Custom links</label>
                                        <input type="text" name="extra_links" id="extra-links" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="bg">Background</label>
                                        <input type="color" name="bg" id="bg" value="{{$slider->bg}}" class="w-100">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="fg">Font Color</label>
                                        <input type="color" name="fg" id="fg" value="{{$slider->fg}}" class="w-100">
                                    </div>
                                </div>
                            </div>
                        </div>
                </div> --}}
                <div class="py-2">
                    <button class="btn btn-primary">
                        Update Slider
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')

    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        const pages = {!! json_encode($pages) !!};
        const options = [
            @foreach (\App\Data::pageTypes as $key => $pageType)
                ["{{ route('page.type', ['type' => $key]) }}","{{ $pageType[1] }}"],
            @endforeach['{{ route('home') }}', "Home"],
        ];
        const url = "{{ route('page', ['id' => 'xxx_id']) }}";

        $(function() {
            $('.photo').dropify();
            typeChanged($('#type')[0]);
            $('#type').change(function (e) {
                e.preventDefault();
                typeChanged(this);
            });
        });

        function typeChanged(ele) {
            $('#link-wrapper').addClass('d-none');
            $('#extra-link-wrapper').addClass('d-none');
            $('#links').removeAttr('required');
            $('#extra-links').removeAttr('required');
            // e.preventDefault();
            switch ($(ele).val()) {

                case "2":
                    $('#links').attr('required', 'required');
                    $('#link-wrapper').removeClass('d-none');
                    html = '';
                    options.forEach(page => {
                        html += "<option value='" + page[0] + "'>" +
                            page[1] + "</option>"
                    });
                    $('#links').html(html);
                    break;
                case "3":
                    $('#extra-link-wrapper').removeClass('d-none');
                    $('#extra-links').attr('required', 'required');

                    break;

                default:
                    $('#links').attr('required', 'required');
                    $('#link-wrapper').removeClass('d-none');
                    let _options = pages.filter(o => o.type == $(ele).val());
                    html = '';
                    _options.forEach(page => {
                        html += "<option value='" + (url.replace('xxx_id', page.id)) + "'>" +
                            page.title + "</option>"
                    });
                    $('#links').html(html);
                    break;
            }
        }
    </script>
@endsection
