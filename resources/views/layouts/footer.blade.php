            @if (Session::has('flash'))
                <flash-message :data="@json(Session::get('flash'))"></flash-message>
            @endif
        </div><!-- /#app -->

        <script>
            window.user = @json($user);
        </script>
    </body>
</html>
