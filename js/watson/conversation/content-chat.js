jQuery(document).ready(function() {
    $("#button").click(function () {
        $("#button").css("display", "none");
        $("#close").css("display", "block");
        $("#flip-body").css("display", "none");
        $("#box").slideToggle();
    });
    $("#back").click(function () {
        $("#back").css("display", "none");
        $("#close").css("display", "block");
        $("#flip-body").css("display", "none");
        $("#box").slideToggle();
    });
    $("#close").click(function () {
        $("#close").css("display", "none");
        $("#button").css("display", "block");
        $("#back").css("display", "block");
        $("#flip-body").css("display", "block");
        $("#box").slideToggle();
    });
});