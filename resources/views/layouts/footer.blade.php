            @if (Session::has('flash'))
                <flash-message :data="@json(Session::get('flash'))"></flash-message>
            @endif
        </div><!-- /#app -->

        <footer class="footer">
            <div class="container">
                <span class="text-muted">Example content.</span>
            </div>
        </footer>

        <script>
            window.user = @json($user);
        </script>
    </body>
</html>
