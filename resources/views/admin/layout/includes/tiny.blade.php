@php
    $selector=isset($selector)?$selector:".desc";
@endphp
tinymce.init({
    selector: '{{$selector}}',
    plugins: [
        '  advlist anchor autolink codesample fullscreen help image imagetools tinydrive',
        ' lists link media noneditable  preview',
        ' searchreplace table template  visualblocks wordcount '
    ],
    toolbar_mode: 'floating',
    toolbar: "fontselect formatselect fontsizeselect forecolor backcolor image  table visualblocks anchor  blocks",
    image_title: true,
    automatic_uploads: true,
    images_upload_url: "{{ route('admin.upload') }}",
    images_upload_handler: image_upload_handler_callback,
});
