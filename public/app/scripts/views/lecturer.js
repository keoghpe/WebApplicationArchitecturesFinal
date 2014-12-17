App.Views.Lecturer = Backbone.View.extend({

    //tagName: 'tr',

    //template: template('lecturerTemplate'),

    initialize: function(){
        this.model.on('change', this.render, this);
        this.model.on('destroy', this.remove, this);
    },

    events: {
        'click .edit': 'editTask',
        'click .delete': 'destroy'
    },

    editTask: function () {
        var newTaskDescription = prompt(
            'What would you like to change the text to?',
            this.model.get('description'));

            this.model.set('description', newTaskDescription);
        },

        destroy: function(){
            this.model.destroy();
        },

        remove: function(){
            this.$el.remove();
        },

        render: function () {

            this.$el.html(template(this.model.toJSON()));
            return this;
        }

    });
