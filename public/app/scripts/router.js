App.Router = Backbone.Router.extend({
    routes: {
        '': 'index',
        'lecturers/:id':'lecturers',
        '*other':'default'
    },

    index: function(){
        console.log("Durkadurkastan");
    },

    lecturers: function(id){
    },

    default: function(other){
        console.log("You tried to tune into" + other);
    }
});
