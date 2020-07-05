<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
</head>
<body>
<div class="form-group">
    <div class="row">
        <div class="col-sm-12  col-md-4">
            <button  id="sslczPayBtn"
            > pay with sslcommerz
            </button>
        </div>

        <div id="test"></div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://sandbox.sslcommerz.com/sslcommerz-4.1.1.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };

        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);
</script>

<script>
    $(document).on('click', '#sslczPayBtn', function (e) {
        window.sslczPayBtn('<?php echo route("sslcommerz.checkout.init-via-ajax") ?>', '', { amount:20 });
    });
</script>

</body>
</html>
