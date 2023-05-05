<footer class="bg-dark text-light">
  <div class="container mt-3 mb-0">
    <div class="row">
      <div class="col-md-6">
        <h3 id="aboutus">About Us</h3>
        <p>This is a product management web app that helps you efficiently manage your daily use products and its transportation.</p>
      </div>
      <div class="col-md-3">
        <h3>Quick Links</h3>
        <ul class="list-unstyled">
          <li><a href="./home.php" class="text-decoration-none">Home</a></li>
          <li><a href="./products_show.php" class="text-decoration-none">Products</a></li>
          <li><a href="#aboutus" class="text-decoration-none">About us</a></li>
          <li><a href="#contact" class="text-decoration-none">Contact Us</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h3 id="contact">Contact Us</h3>
        <p>Dr S & S.S. ghandhy college</p>
        <p>Maguragate, Surat 395007</p>
        <p>Phone: (+91) 9876543210</p>
        <p>Email: contact@fyp.rf.gd</p>
      </div>
    </div>
    <hr class="border-light">
    <p class="text-center">&copy; Power by Php and MySQL.</p>
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