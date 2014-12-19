App.Views.Docs = Backbone.View.extend({
    //tagName: 'table',

    initialize: function(){
     vent.on('docs:home', this.docs, this);
     vent.on('docs:overview',this.docsOverview, this);
     vent.on('index',this.index, this);
     vent.on('test',this.test, this);
    },

    render: function (templateId) {



        // switch (view) {
        //     case "docs":
        //         templateId = "#docsTemplate";
        //         break;
        //     case "index":
        //         templateId = "#indexTemplate"
        //         break;
        //     case "test":
        //         templateId = "#testTemplate"
        //         break;
        //     case "overview":
        //         templateId = "#overviewTemplate"
        //         break;
        //     default:
        //         templateId = "#indexTemplate"
        // }

        var source = $(templateId).html();
        var template = Handlebars.compile(source);
        var html = template();

        this.$el.html(html);

        return this;
    },

    index: function(){
        $(".appContent").empty();
        $(".appContent").append(this.render("#indexTemplate").el);
    },

    docs: function(){
        $(".appContent").empty();
        $(".appContent").append(this.render("#docsTemplate").el);
        if($('.docsContent').is(':empty')){
            this.docsOverview();
        }
    },

    docsOverview: function(){
        if($('.appContent').is(':empty')){
            this.renderIndex();
        }
        $(".docsContent").empty();
        $(".docsContent").append(this.render("overviewTemplate").el);
    },

    test: function(){
        $(".appContent").empty();
        $(".appContent").append(this.render("#testTemplate").el);
    }
});
