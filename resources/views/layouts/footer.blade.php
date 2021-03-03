            <sweet-alert :flash-modal='@json(session("flash-modal"))'></sweet-alert>
        </div><!-- /#app -->

        <footer class="footer text-center text-md-left">
            <div class="container">
                <div class="row pt-5 pb-4">
                    <div class="col">
                        <a href="{{ route('home') }}" class="logo">YourDesignContest<span class="period">.</span></a>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-md-3 pb-3">
                        <div class="text-white font-weight-bold mb-2">Company</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('home') }}" class="text-white">Home</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('contact.form') }}" class="text-white">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pb-3">
                        <div class="text-white font-weight-bold mb-2">Designers</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('contests.index') }}" class="text-white">Contests</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pb-3">
                        <div class="text-white font-weight-bold mb-2">Contest holders</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('contests.create') }}" class="text-white">Create contest</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pb-3">
                        <div class="text-white font-weight-bold mb-2">Info</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('process') }}" class="text-white">How it works</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('faq.index') }}" class="text-white">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>

        <script>window.user = @json($user);</script>
    </body>
</html>
