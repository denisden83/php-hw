<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="./js/vendors.min.js"></script>
<!--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->
    <script>
        $(function () {
            $(".show").on("click", "a", function (e) {
                e.preventDefault();
                var url = "./ajaxadminprocess.php?client_id=" + $(this).data("id") +
                        "&client_name=" + $(this).data("name");
                $.ajax({
                    url: encodeURI(url)
                }).done(function (data) {
                    $(".show").html(data);
                });
            });
//            $("body").on("click", "#back", function (e) {
//                e.preventDefault();
//                $.ajax({
//                    url: "./ajaxadminprocess.php"
//                }).done(function (data) {
//                    $(".show").html(data);
//                });
//            });
        });
    </script>
</head>
<body>
<div class="show">
    <?php
    require_once('ajaxadminprocess.php');
    ?>
</div>

</body>
</html>