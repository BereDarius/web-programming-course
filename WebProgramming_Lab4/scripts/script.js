$(document).ready(function() {
    let password = $("#password");
    let confirm_password = $("#confirm-password");
    let modal = $("#modal");
    let textarea = $("#main-form textarea");
    modal.hide();
    $("#submit-main").click(function() {
        if (password.val() !== confirm_password.val()) {
            alert("Passwords not matching...");
            password.val("");
            confirm_password.val("");
        } else if (password.val() === "" || confirm_password.val() === "") {
            alert("Password fields cannot be empty...");
        } else {
            modal.show();
            $("#main-form").hide();
            $("body").css("background", "gray");
            $("#main-form input").attr("disabled", "disabled").css("color", "lightgray");
            textarea.attr("disabled", "disabled");
            $("#main-form button").attr("disabled", "disabled");
            $("#main-form label").css("color", "lightgray");
        }
    });
    $("#submit-modal").click(function() {
        modal.hide();
        $("#main-form").show();
        $("body").css("background", "white");
        textarea.val(
            "Studies: " + $("#modal-form #modal-studies").val() + "\n" +
            "Hobbies: " + $("#modal-form #modal-hobbies").val() + "\n" +
            "Address: " + $("#modal-form #modal-address").val() + "\n" +
            "Gender: " + $("#modal-form input[name='gender']:checked").val()
        ).removeAttr("disabled");
        $("#main-form input").removeAttr("disabled");
        $("#main-form button").removeAttr("disabled");
        $("#main-form *").css("color", "black");
    })
});