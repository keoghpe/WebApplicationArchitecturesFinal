App.Models.Student = Backbone.Model.extend({
    defaults: {
        student_number: 'ffffffffffffffffffffffffffff',
        age: 18,
        id_nationality: 0
    },

    urlRoot:'WebAppArchitectures/index.php/v1/students',

    validate: function(attrs){

    },

    do: function() {
        console.log('Doing ' + this.get('description'));
    }
});
