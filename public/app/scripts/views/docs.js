App.Views.Docs = Backbone.View.extend({
    //tagName: 'table',

    render: function (view) {
        var templateId = "";


        switch (view) {
            case "docs":
                templateId = "#docsTemplate";
                break;
            case "index":
                templateId = "#indexTemplate"
                break;
            case "test":
                templateId = "#testTemplate"
                break;
            default:
                templateId = "#indexTemplate"
        }

        var source = $(templateId).html();
        var template = Handlebars.compile(source);
        var html = template();

        this.$el.html(html);

        return this;
    }
});
