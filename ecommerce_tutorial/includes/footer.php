</div><br><br>
<footer class="text-center col-md-12" id="footer">&copy; Copyright 2013-2015 Hydee's Boutique</footer>
<script>
    function detailsmodal(id) {
        var data = {
            "id" : id
        }
        jQuery.ajax({
            url: '/codebag/ecommerce_tutorial/includes/detailsmodal.php',
            method: "post",
            data: data,
            success: function (data) {
                jQuery('body').append(data);
                jQuery('#details-modal').modal('toggle')
            },
            error: function (err) {
                console.log(err);
                alert("Something went wrong!!!");

            }
        })
    }
</script>
</body>
</html>