            @if (Session::has('flash'))
                <flash-message :data="{{ json_encode(Session::get('flash')) }}"></flash-message>
            @endif
        </div><!-- /#app -->
    </body>
</html>
