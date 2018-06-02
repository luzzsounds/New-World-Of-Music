


<footer class="footer">
    <div class="MenuFooter col-xs-2" >

        <p class="FooterMenuLinks">
            <a href="#">Contact</a>
        </p>
        <p>NewWorldOfMusic &copy; 2018</p>
    </div>
</footer>
<script type="text/javascript">

    // Menu  button

    $(document).ready(function() {
        $(".menu-icon").on("click", function() {
            $("nav ul").toggleClass("showing");
        });
    });

    // Scroll effect

    $(window).on("scroll", function() {
        if($(window).scrollTop()) {
            $('nav').addClass('black');
        }

        else {
            $('nav').removeClass('black');
        }
    })


</script>
</body>
</html>


