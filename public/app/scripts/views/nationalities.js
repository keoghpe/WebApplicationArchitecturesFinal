App.Views.Nationalities = Backbone.View.extend({

    render: function () {

        var html = template('nationalitiesTemplate')(this.collection.toJSON());

        this.$el.html(html);

        return this;
    }
});

App.Views.AddNationality = Backbone.View.extend({
    el: "#addNationality",

    events:{
        'submit': 'addNationality'
    },

    addNationality: function(e){
        e.preventDefault();

        this.collection.create({
            'description': this.$('#nationality').val()
        },
        {success: function(){
            vent.trigger('test:nationalities');
        }});
    }
});
