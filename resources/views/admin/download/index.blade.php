@extends('admin.layout.app')
@section('css')
    <style>
        .col-md-3 {
            /* margin-bottom: 10px; */
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

        .single-download {
            height: 40px;
            display: flex;
            align-items: center;
            border: 1px solid #cccccc;
        }

        .single-download .type {
            background: #007ACC;
            width: 100px;
            color: white;
            height: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .single-download .title {
            height: 100%;
            display: inline-flex;
            align-items: center;
            padding: 0px 20px;
            font-size: 1.1rem;
            font-weight: 600;
            width: calc(100% - 100px);

        }

        .del {
            width: 100px;
            height: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

    </style>
@endsection
@section('page-option')
@endsection
@section('s-title')
    <li class="breadcrumb-item ">
        Download Types
    </li>
    <li class="breadcrumb-item active">
        {{ $type->name }}
    </li>
@endsection
@section('content')
    <div class="shadow mb-4">
        <div class="card-body">
            <form id="add-form" action="{{ route('admin.download.add') }}" method="post">
                @csrf
                <div class="row">
                    <input type="hidden" name="download_type_id" value="{{ $type->id }}">
                    <div class="col-md-6">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" required>
                    </div>
                    <div class="col-md-6">
                        <label for="file">file</label>
                        <input type="file" name="file" id="file" class="form-control" required>
                    </div>
                    <div class="py-2 col-12">
                        <button class="btn btn-primary">Add Download</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="shadow mb-4">
        <div class="card-body" id="downloads">
            @foreach ($type->downloads as $download)
                <div class="single-download" id="download-{{ $download->id }}">

                    <div class="title">
                        <a href="{{ asset($download->file) }}">
                            {{ $download->title }}
                        </a>
                    </div>
                    <span onclick="del({{ $download->id }},event)" href="#" class="del bg-danger">
                        Del
                    </span>
                </div>
            @endforeach
        </div>
    </div>






@endsection
@section('script')

    <script>
        const delurl = "{{ route('admin.download.del', ['download' => 'xxx_id']) }}";
        $(document).ready(function() {
            $('#add-form').submit(function(e) {
                e.preventDefault();
                axios.post(this.action, (new FormData(this)))
                    .then((res) => {
                        let html = '<div class="single-download" id="download-' + res.data.id + '">' +
                            '<div class="title">' +
                            '<a href="/' + res.data.file + '">' +
                            res.data.title +
                            '</a>' +
                            '</div>' +
                            '<a onclick="del(' + res.data.id +
                            ',event)"  href="#" class="del bg-danger">' +
                            'Del' +
                            '</a>' +
                            '</div>';
                        $('#downloads').append(html);
                        this.reset();
                        toastr.success('Donload Added Sucessfully');
                    })
                    .catch((err) => {

                    });
            });
        });

        function del(id, e) {
            e.preventDefault();
            if (prompt('Type yes to delete')=='yes') {

                url = delurl.replace('xxx_id', id);
                axios.get(url)
                    .then((res) => {
                        $('#download-' + res.data.id).remove();
                        toastr.success('Download Deleted Sucessfully');
                    })
                    .catch((err) => {

                    });
            }
        }
    </script>

@endsection
