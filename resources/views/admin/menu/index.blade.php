@extends('admin.layout.app')
@section('css')
    <style>
        .form-control {
            border-radius: 5px;
        }

        .normal-menu,
        .header-menu {
            margin-bottom: 10px;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);

        }

        .normal-menu {
            padding: 10px;
        }

        .header-menu input {
            width: 250px;
        }

        .normal-menu {
            display: flex;

        }

        .normal-menu .input-title {
            width: 250px;
        }

        .normal-menu .input-link {
            flex-grow: 1;
        }

        .normal-menu .input-title {}

        .header-menu .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;

        }

        .header-menu .btn,
        .normal-menu .btn {
            height: 30px;
            width: 30px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
            padding: 0px;
        }

        .sn{
            width:50px !important;
        }
    </style>
@endsection
@section('page-option')
    <button class="btn btn-primary" onclick="initAdd(0)">New Menu</button>
    <button class="btn btn-success" onclick="rebuild()">Rebuild</button>
@endsection
@section('s-title')


@endsection
@section('content')

    <div class="shadow ">
        <div class="card-body" id="menu-holder">

        </div>
    </div>

    @include('admin.menu.add')
    @include('admin.menu.edit')



    <div id="header-menu-template" class="d-none">
        <div class="header-menu " id="header-menu-xxx_id">
            <div class="header  ">
                <input type="text" value="xxx_name" id="item-title-xxx_id">
                <input type="hidden" value="xxx_link" id="item-link-xxx_id">
                <span>
                    <input type="number"  class="sn" value="xxx_sn" id="sn-xxx_id">
                    <button class="btn"><i class="material-icons" onclick="del(xxx_id)"> delete </i></button>
                    <button class="btn"><i class="material-icons" onclick="updateHeader(xxx_id)"> save
                        </i></button>
                    <button class="btn"><i class="material-icons" onclick="initAdd(xxx_id)"> add </i></button>
                </span>
            </div>
            <hr>
            <div class="childs p-3" id="childs-xxx_id">

            </div>
        </div>
    </div>

    <div id="normal-menu-template" class="d-none">
        <div class="normal-menu" id="normal-menu-xxx_id">
            <input type="text" id="input-title-xxx_id" class="input-title" value="xxx_name">
            <input type="text" id="input-link-xxx_id" class="input-link" value="xxx_link">
            <input type="number" id="input-sn-xxx_id" class="input-sn sn" value="xxx_sn">
            <span class="btn-group">
                <button class="btn"><i class="material-icons" onclick="del(xxx_id)"> delete </i></button>
                <button class="btn"><i class="material-icons" onclick="initEdit(xxx_id)"> edit </i></button>
            </span>
        </div>
    </div>
@endsection
@section('script')
    <script>
        const url = "{{ route('page', ['id' => 'xxx_id']) }}";
        const galleryurl = "{{ route('gallery', ['id' => 'xxx_id']) }}";
        const teamurl = "{{ route('team', ['id' => 'xxx_id']) }}";
        const pages = {!! json_encode($pages) !!};
        const galleries = {!! json_encode($galleries) !!};
        const teams = {!! json_encode($teams) !!};
        const menus = {!! json_encode($menus) !!};
        const header_menu_template = $('#header-menu-template').html();
        const normal_menu_template = $('#normal-menu-template').html();
        const options = [
            @foreach (\App\Data::pageTypes as $key => $pageType)
                ["{{ route('page.type', ['type' => $key]) }}","{{ $pageType[1] }}"],
            @endforeach
            ['{{ route('home') }}', "Home"],
            ['{{ route('gallery.type') }}', "Galleries"],
            ['{{ route('downloads') }}', "Downloads"],
            ['{{ route('team.type') }}', "Teams"],
            ['{{ route('contact') }}', "Contact"],
            ['{{ route('faq') }}', "FAQ"],
        ]
        $(function() {
            let arr = [];
            let h = "";
            menus.forEach(menu => {
                if (menu.is_header == 1) {
                    if (menu.childs != null) {
                        menu.childs.split(',').forEach(sub => {
                            const subarr = sub.split('|');
                            arr.push({
                                parent_id: menu.id,
                                id: subarr[0],
                                name: subarr[1],
                                link: subarr[2],
                                sn: subarr[3],
                            })
                        });
                    }
                    h += template(header_menu_template, menu);
                } else {
                    h += template(normal_menu_template, menu);

                }
            });
            $('#menu-holder').html(h);

            arr.forEach(submenu => {
                h = template(normal_menu_template, submenu);
                $('#childs-' + submenu.parent_id).append(h);

            });


            $('#link-wrapper').addClass('d-none');
            $('#extra-link-wrapper').addClass('d-none');


            $('#type').change(function(e) {
                typeChanged(this);
            });
            $('#etype').change(function(e) {
                etypeChanged(this);
            });

            $('#add-menu').submit(function(e) {
                e.preventDefault();
                axios.post(this.action, (new FormData(this)))
                    .then((res) => {
                        const menu = res.data;
                        let h = '';
                        if (menu.is_header == 1) {
                            h = template(header_menu_template, menu);
                        } else {
                            h = template(normal_menu_template, menu);

                        }
                        if (menu.parent_id != null) {
                            $('#childs-' + menu.parent_id).append(h);

                        } else {
                            $('#menu-holder').append(h);
                        }
                        $('#add-modal').modal('hide');
                        toastr.success("Menu Added");

                    })
                    .catch((err) => {
                        toastr.error("Error Occured");
                    });
            });
            $('#update-menu').submit(function(e) {
                e.preventDefault();
                axios.post(this.action, (new FormData(this)))
                    .then((res) => {
                        const menu = res.data;
                        let h = '';
                        h = template(normal_menu_template, menu);
                        $("#normal-menu-" + menu.id).replaceWith(h);
                        $('#update-modal').modal('hide');
                        toastr.success("Menu Updated");
                    })
                    .catch((err) => {
                        toastr.error("Error Occured");
                    });
            });
        });

        function updateHeader(id) {
            axios.post("{{ route('admin.menu.edit') }}", {
                    "id": id,
                    "name": $('#item-title-' + id).val(),
                    "sn": $('#sn-' + id).val(),
                    "type": 1
                })
                .then((res) => {
                    toastr.success("Menu Updated");
                })
                .catch((err) => {
                    toastr.error("Error Occured");
                })
        }

        function del(id) {
            if (prompt("Enter YES to Delete MenuItem").toLowerCase() == "yes") {

                axios.post("{{ route('admin.menu.del') }}", {
                        "id": id
                    })
                    .then((res) => {
                        toastr.success("Menu Deleted");
                        $('#header-menu-' + id).remove();
                        $('#normal-menu-' + id).remove();
                    })
                    .catch((err) => {
                        toastr.error(err.response.data.message);
                    })
            }
        }

        function initAdd(id) {
            $('#parent_id').val(id);
            $('#type option[value="1"]').remove();

            if (id == 0) {
                $('#type').prepend('<option value="1">Header</option>');
                $('#type').val("1");
            } else {
                typeChanged($('#type')[0]);

            }
            $('#add-modal').modal('show');
        }

        function typeChanged(ele) {
            $('#link-wrapper').addClass('d-none');
            $('#extra-link-wrapper').addClass('d-none');
            $('#links').removeAttr('required');
            $('#extra-links').removeAttr('required');
            // e.preventDefault();
            switch ($(ele).val()) {
                case "1":

                    break;
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
                case "6":
                    $('#links').attr('required', 'required');
                    $('#link-wrapper').removeClass('d-none');
                    html = '';
                    teams.forEach(page => {
                        html += "<option value='" + (teamurl.replace('xxx_id', page.id)) + "'>" +
                            page.name + "</option>"
                    });
                    $('#links').html(html);
                    break;
                case "5":
                    $('#links').attr('required', 'required');
                    $('#link-wrapper').removeClass('d-none');
                    html = '';
                    galleries.forEach(page => {
                        html += "<option value='" + (galleryurl.replace('xxx_id', page.id)) + "'>" +
                            page.name + "</option>"
                    });
                    $('#links').html(html);
                    break;
                case "4":
                    $('#links').attr('required', 'required');
                    $('#link-wrapper').removeClass('d-none');
                    html = '';
                    events.forEach(page => {
                        html += "<option value='" + (eventurl.replace('xxx_id', page.id)) + "'>" +
                            page.title + "</option>"
                    });
                    $('#links').html(html);
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

        function etypeChanged(ele) {
            $('#elink-wrapper').addClass('d-none');
            $('#eextra-link-wrapper').addClass('d-none');
            $('#elinks').removeAttr('required');
            $('#eextra-links').removeAttr('required');
            // e.preventDefault();
            switch ($(ele).val()) {

                case "2":
                    $('#elinks').attr('required', 'required');
                    $('#elink-wrapper').removeClass('d-none');
                    html = '';
                    options.forEach(page => {
                        html += "<option value='" + page[0] + "'>" +
                            page[1] + "</option>"
                    });
                    $('#elinks').html(html);
                    break;
                case "3":
                    $('#eextra-link-wrapper').removeClass('d-none');
                    $('#eextra-links').attr('required', 'required');

                    break;
                case "6":
                    $('#elinks').attr('required', 'required');
                    $('#elink-wrapper').removeClass('d-none');
                    html = '';
                    teams.forEach(page => {
                        html += "<option value='" + (teamurl.replace('xxx_id', page.id)) + "'>" +
                            page.name + "</option>"
                    });
                    $('#elinks').html(html);
                    break;
                case "5":
                    $('#elinks').attr('required', 'required');
                    $('#elink-wrapper').removeClass('d-none');
                    html = '';
                    galleries.forEach(page => {
                        html += "<option value='" + (galleryurl.replace('xxx_id', page.id)) + "'>" +
                            page.name + "</option>"
                    });
                    $('#elinks').html(html);
                    break;
                case "4":
                    $('#elinks').attr('required', 'required');
                    $('#elink-wrapper').removeClass('d-none');
                    html = '';
                    events.forEach(page => {
                        html += "<option value='" + (eventurl.replace('xxx_id', page.id)) + "'>" +
                            page.title + "</option>"
                    });
                    $('#elinks').html(html);
                    break;
                default:
                    $('#elinks').attr('required', 'required');
                    $('#elink-wrapper').removeClass('d-none');
                    let _options = pages.filter(o => o.type == $(ele).val());
                    html = '';
                    _options.forEach(page => {
                        html += "<option value='" + (url.replace('xxx_id', page.id)) + "'>" +
                            page.title + "</option>"
                    });
                    $('#elinks').html(html);
                    break;
            }
        }


        function rebuild() {
            axios.get("{{route('admin.menu.render')}}");
        }
        function initEdit(id) {
            etypeChanged($('#etype')[0]);
            $('#eid').val(id);
            $('#ename').val($('#input-title-' + id).val());
            $('#esn').val($('#input-sn-' + id).val());
            $('#update-modal').modal('show');
        }
    </script>
@endsection
