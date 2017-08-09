$(function () {
    $("#order-form").on("submit", function (e) {
        e.preventDefault();
        var form = $(this),
            formData = form.serialize();
        $.ajax({
            url: "./formprocess.php",
            method: "POST",
            data: formData
        }).done(function(data){
            alert(data);
        });
    })
});