            <sweet-alert :flash-modal='@json(session("flash-modal"))'></sweet-alert>
        </div><!-- /#app -->

        <script>
            window.user = @json($user);
        </script>
    </body>
</html>
