<footer>
    <div class="container mt-5">
        <p> &copy; Power By Php</p>
    </div>
</footer>
<script src="./../jquery-3.6.3.js"></script>
<script src="./../bootstrap.bundle.js"></script>
<script>
    function navBarToggle() {
        var x = document.getElementById("demo");
        if (x.className.indexOf("w3-show") == -1) {
            x.className += " w3-show";
        } else {
            x.className = x.className.replace(" w3-show", "");
        }
    }
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