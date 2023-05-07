<div class="col-md-6 col-lg-4">
    <div class="block-23">
        <h3 class="heading-section">Get Connected</h3>
        <ul>
            <li>
                <a target="_blank" href="https://www.google.com/maps/search/?api=1&query={{urlencode($curdata['address'])}}">
                    <span class="icon icon-map-marker"></span>
                    <span class="text">{{ $curdata['address'] }}</span>
                </a>
            </li>
            <li>
                <a target="_blank" href="tel:{{ $curdata['phonno'] }}">
                    <span class="icon icon-phone"></span>
                    <span class="text">{{ $curdata['phonno'] }}</span>
                </a>
            </li>
            <li>
                <a target="_blank" href="mailto:{{ $curdata['email'] }}">
                    <span class="icon icon-envelope"></span>
                    <span class="text">{{ $curdata['email'] }}</span>
                </a>
            </li>
        </ul>
    </div>
</div>
