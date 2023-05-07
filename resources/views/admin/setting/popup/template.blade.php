@if ($popups->count() > 0)
    @foreach ($popups as $popup)
        <div class="modal fade modals" id="pop-{{$popup->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-body" style="position: relative">
                        <button type="button" style="position: absolute;top:10px; right: 10px;" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <img  class="d-none d-md-block w-100" src="{{asset($popup->image)}}"/>
                        <img  class="d-block d-md-none w-100" src="{{asset($popup->mobile_image)}}"/>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endif
