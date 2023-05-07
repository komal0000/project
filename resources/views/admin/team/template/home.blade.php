<div class="top-section">
    <h3 class="py-3">Board Members</h3>
    <div class="notice-wapper">
        <div class="row">

            @foreach ($mainTeams as $team)

            <div class="col-md-6 px-1 mb-3">
                <div class="card">
                    <img src="{{asset($team->image)}}"
                        alt="" class="w-100">
                    <div class="p-2">
                        <b class="single-line d-block">
                            {{$team->name}}
                        </b>
                        {{$team->designation}}
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</div>
