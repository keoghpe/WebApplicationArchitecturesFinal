App.Models.Lecturer = Backbone.Model.extend({
    defaults: {
        id: 0,
        name: 'Dude',
    },

    urlRoot:'WebAppArchitectures/index.php/v1/lecturers',

    validate: function(attrs){
        if(!$.trim(attrs.name)){
            return 'Name cannot be blank';
        }

    }
});
