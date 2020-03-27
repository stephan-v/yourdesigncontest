            <sweet-alert :flash-modal='@json(session("flash-modal"))'></sweet-alert>
        </div><!-- /#app -->

        <footer class="footer mt-5">
            <div class="container">
                <div class="row pt-5 pb-5">
                    <div class="col-md-3">
                        <div class="text-white font-weight-bold mb-3">Company</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('home') }}" class="text-white">Home</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('contact.form') }}" class="text-white">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <div class="text-white font-weight-bold mb-3">Designers</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('contests.index') }}" class="text-white">Contests</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <div class="text-white font-weight-bold mb-3">Contest holders</div>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('contests.create') }}" class="text-white">Create contest</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3">
                        <div class="text-white font-weight-bold mb-3">Info</div>

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

        <script>
            window.user = @json($user);
        </script>
    </body>
</html>
