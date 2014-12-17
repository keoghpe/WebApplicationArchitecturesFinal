App.Models.Task = Backbone.Model.extend({
    defaults: {
        task_id: 0,
        description: 'thing',
        date: '2014-04-27',
        duration_mins: 180,
        daytime: '3pm-6pm',
        course_id: 1
    },

    urlRoot:'WebAppArchitectures/index.php/v1/tasks',

    validate: function(attrs){
        if(!$.trim(attrs.description)){
            return 'Description cannot be blank';
        }

        if(attrs.duration < 0){
            return 'Duration cannot be negative';
        }
    },

    do: function() {
        console.log('Doing ' + this.get('description'));
    }
});
