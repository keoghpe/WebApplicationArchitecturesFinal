new App.Router;
new App.Views.Docs;
new App.Views.Docstests;
Backbone.history.start();

$(".nav a").on("click", function(){
    $(".nav").find(".active").removeClass("active");
    $(this).parent().addClass("active");
});
