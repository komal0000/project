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
        <a href="{{ route('admin.page.index', ['type' => $type]) }}">{{ $pageType[1] }}</a>
    </li>
    <li class="breadcrumb-item active">
        Add
    </li>
@endsection
@section('content')

    <div class="card shadow mb-3">
        <div class="card-body">
            <form action="{{ route('admin.page.add', ['type' => $type]) }}" method="post" enctype="multipart/form-data"
                id="add-employee">

                @csrf
                <div class="row">
                    @if ($pageType[5])

                        <div class="col-md-4">
                            <label for="photo">Feature Image</label>
                            <input type="file" required name="photo" id="photo" accept="image/*">
                        </div>
                    @endif

                    <div class="col-md-{{ $pageType[5] ? 8 : 12 }} py-2">
                        <div>
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required>
                        </div>
                        <div>
                            <label for="short_desc">Short {{ $pageType[6] }}</label>
                            <textarea name="short_desc" id="short_desc" cols="30" rows="10" class="form-control"
                                ></textarea>
                        </div>
                        @if (count($pageType[2]) > 0)
                            @foreach ($pageType[2] as $key => $descType)
                                @php
                                    $d=explode('|',$descType);
                                @endphp
                                @if(count($d)>1)
                                <label for="{{ $key }}">{{ $d[0] }}</label>
                                <input type="{{$d[1]}}" name="{{ $key }}" id="{{ $key }}" class="form-control">
                                @else
                                <div>
                                    <label for="{{ $key }}">{{ $descType }}</label>
                                    <textarea name="{{ $key }}" id="{{ $key }}" cols="30" rows="10"
                                        class="form-control desc"></textarea>
                                </div>
                                @endif
                            @endforeach
                        @else
                            <div>
                                <label for="desc">Extra {{ $pageType[6] }}</label>
                                <textarea name="desc" id="desc" cols="30" rows="10" class="desc form-control"></textarea>
                            </div>
                        @endif

                        @if ($pageType[4] != null)
                            @php
                                $data = explode('|', $pageType[4]);

                            @endphp
                            <div class="card-title">
                                <hr>
                                <div class="d-flex justify-content-between">
                                    <span>
                                        {{ $data[2] }}
                                    </span>
                                    <span>
                                        <span class="btn btn-secondary btn-sm" onclick="addDocument()">Add File/Image</span>
                                    </span>

                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="row" id="documents">

                                </div>
                            </div>
                        @endif

                        <div class="py-2">

                            <button class="btn btn-primary">Save {{ $pageType[0] }}</button>

                            <a href="{{ route('admin.page.index', ['type' => $type]) }}"
                                class=" ms-2 btn btn-danger">Cancel</a>
                        </div>



                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('script')
    <script src="https://cdn.tiny.cloud/1/4adq2v7ufdcmebl96o9o9ga7ytomlez18tqixm9cbo46i9dn/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script src="{{ asset('admin/plugins/drophify/js/dropify.min.js') }}"></script>
    <script>
        @include('admin.layout.includes.tinysupport')
        var state = false;
        @if ($pageType[4] != null)

            var did=0;

            function addDocument(params) {
            html='<div id="doc-'+did+'" class="col-md-{{ $pageType[5] ? '6' : '3' }}  mb-3"><div class="shadow p-2"><input type="hidden" name="docs[]" value="'+did+'" />'+
                    '<div><input type="file" accept="image/*,.pdf,.docx" id="doc_image_'+did+'" name="doc_image_'+did+'"required /></div>'+
                    '<div class="mt-2"><label class="w-100 d-block d-flex justify-content-between align-items-center">'+
                            '<span>File Name</span>'+
                            '<span class="btn btn-danger btn-sm" onclick="removeDoc('+did+')"> Remove</span>'+
                            '</label><input class="form-control" type="text" id="doc_name_'+did+'" name="doc_name_'+did+'"required /></div>'+'</div> </div>';
            $('#documents').append(html);
            $("#doc_image_"+did).dropify();
            did+=1;
            }
            function removeDoc(id){
            $('#doc-'+id).remove();
            }
        @endif
        $(function() {
            $('#photo').dropify();
            @include('admin.layout.includes.tiny')
        });
    </script>
@endsection
