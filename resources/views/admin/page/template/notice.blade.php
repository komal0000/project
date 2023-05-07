<div class="top-section">
    <h3 class="p-3">
        <div>
            Recent Notices
        </div>
    </h3>
    <div class="notice-wapper">
        @foreach ($notices as $notice)

        <div style="border:1px solid #DEE2FB;border-radius:5px;margin:5px 15px 10px 15px;padding:15px;">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="notice-title">
                    {{$notice->title}}
                </h5>

            </div>
            <div class="row ">
                <span class="col-md-6 d-none d-md-block">
                    <small>
                        <b>
                            {{makeDate($notice->created_at)}}
                        </b>
                    </small>
                    {{-- <a class="notice-links" href="ds">Download  Fils<i class="bi bi-cloud-arrow-down ms-2"></i></a> --}}
                </span>
                <span class="col-md-6 text-end">
                    <a class="notice-links" href="{{route('page',['id'=>$notice->id])}}">View Detail <i
                            class="bi bi-arrow-right-circle-fill ms-2"></i></a>
                </span>
            </div>
        </div>
        @endforeach
    </div>
    <div class="py-3 text-center">
        <a href="{{route('page.type',['type'=>'not'])}}" class="btn btn-primary">View All Notices</a>
    </div>
</div>
