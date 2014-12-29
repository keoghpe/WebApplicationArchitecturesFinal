App.Views.Docs = Backbone.View.extend({

    initialize: function(){

         this.appContent = $(".appContent");
         vent.on('docs:home', this.docs, this);
         vent.on('index',this.index, this);
         vent.on('test',this.test, this);
    },

    render: function (templateId) {

        var source = $(templateId).html();
        var template = Handlebars.compile(source);
        var html = template();

        this.$el.html(html);

        return this;
    },

    index: function(){
        this.getTemplate("#indexTemplate");
    },

    docs: function(){
        this.getTemplate("#docsTemplate");
        if($('.docsContent').is(':empty')){
            vent.trigger('docs:overview');
        }
    },

    test: function(){
        this.getTemplate("#testTemplate");
    },

    getTemplate: function(template){
        this.appContent.empty();
        this.appContent.append(this.render(template).el);
    }

});
