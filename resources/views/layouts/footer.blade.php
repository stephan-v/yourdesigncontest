            @if (Session::has('flash'))
                <flash-message :data="@json(Session::get('flash'))"></flash-message>
            @endif
        </div><!-- /#app -->

        <footer class="footer mt-5">
            <div class="container">
                <div class="p-3">
                    <span class="text-muted">Example content.</span>
                </div>
            </div>
        </footer>

        <script>
            window.user = @json($user);
        </script>
    </body>
</html>
