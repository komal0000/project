<footer class="footer">
    <div class="container">
        <div class="row mb-5">
            @includeIf('front.pages.home.aboutus')
            @includeIf('front.pages.home.news')
            @includeIf('front.pages.home.connect')

        </div>
        <div class="row pt-5">
            <div class="col-md-12 text-center">

                <p>
                    Copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </p>

            </div>
        </div>
    </div>
</footer>

<!-- loader -->
<div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
        <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
            stroke="#eeeeee" />
        <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
            stroke-miterlimit="10" stroke="#F96D00" />
    </svg></div>
