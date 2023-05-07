@php
    $data =
        getSetting('contact') ??
        ((object) [
            'map' => '',
            'email' => '',
            'phone' => '',
            'addr' => '',
            'others' => [],
        ]);
@endphp

    <div class="position-relative rounded overflow-hidden">
        <iframe class="position-relative" style="height: 500px; width: 500px"
            src="https://maps.google.com/maps?q={{ $data->map }}&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0"
            style="min-height: 230px; border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    </div>

