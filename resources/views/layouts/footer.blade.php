        </div><!-- /#app -->

        <footer class="footer text-center text-md-left">
            <div class="container">
                <div class="row pt-5 pb-4">
                    <div class="col">
                        <a href="{{ route('home') }}" class="logo">YourDesignContest<span class="period">.</span></a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3 pb-3">
                        <h5>Company</h5>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('home') }}">Home</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('contact.form') }}">Contact</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pb-3">
                        <h5>Designers</h5>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('contests.index') }}">View contests</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pb-3">
                        <h5>Contest holders</h5>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('contests.create') }}">Create contest</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-md-3 pb-3">
                        <h5>Resources</h5>

                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <a href="{{ route('process') }}">How it works</a>
                            </li>

                            <li class="mb-2">
                                <a href="{{ route('faq.index') }}">FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="mb-5">

                <div class="row mb-5">
                    <div class="col-md-12 small text-center copyright">
                        <p>© YourDesignContest 2021. All rights reserved.</p>
                        <p>When you visit or interact with our sites, services or tools, we or our authorised service providers may use cookies for storing information to help provide you with a better, faster and safer experience and for marketing purposes.</p>
                    </div>
                </div>
            </div>
        </footer>

        <script>window.user = @json($user);</script>
    </body>
</html>
