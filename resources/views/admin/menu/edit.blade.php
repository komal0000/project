<div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal-title"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update-modal-title">Update Menu Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pb-3">

                <form action="{{ route('admin.menu.edit') }}" id="update-menu" method="post">
                    @csrf
                    <input type="hidden" name="id" id="eid">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Title</label>
                                <input type="text" name="name" id="ename" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="etype" class="form-control " required>
                                    @php
                                        $i = 2;
                                    @endphp
                                    @foreach (\App\Data::pageTypes as $key => $pageType)
                                        <option value="{{ $key }}">{{ $pageType[1] }}</option>
                                    @endforeach
                                    <option value="4">Event</option>
                                    <option value="5">gallery</option>
                                    <option value="2">Other Link</option>
                                    <option value="3">Custom Link</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="elink-wrapper">

                            <div class="form-group" >
                                <label for="links">links</label>
                                <select name="links" id="elinks" class="form-control">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3" id="eextra-link-wrapper">
                            <div class="form-group" >
                                <label for="extra-links">extra-links</label>
                                <input type="text" name="extra_links" id="eextra-links" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="sn">SN</label>
                            <input type="number" name="sn" id="esn" class="form-control" value="0">
                        </div>
                        <div class=" col-md-3 d-flex align-items-end">
                            <div class="form-group">

                                <button class="btn btn-primary">
                                    Update Menu
                                </button>
                            </div>
                        </div>
                    </div>



                </form>

            </div>
        </div>
    </div>
</div>
