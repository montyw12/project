<footer>
    <div class="container mt-5">
        <p> &copy; Power By Php</p>
    </div>
</footer>
<script src="./../jquery-3.6.3.js"></script>
<script src="./../bootstrap.bundle.js"></script>
<script>
    $(document).ready(function() {

        // If cookie is set, scroll to the position saved in the cookie.
        if ($.cookie("scroll") !== null) {
            $(document).scrollTop($.cookie("scroll"));
        }

        // When scrolling happens....
        $(window).on("scroll", function() {

            // Set a cookie that holds the scroll position.
            $.cookie("scroll", $(document).scrollTop());

        });

    });
</script>
</body>

</html>