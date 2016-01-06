$(function() {

    var tattooModel = Backbone.Model.extend({
        urlRoot: "../search.php",
    });

    var tattooCollect = Backbone.Collection.extend({
        model: tattooModel,
        url: "search.php/Write/getAll",
    });

    var myTattooCollect = new tattooCollect();

    var startRouter = Backbone.Router.extend({
        routes: {
            "title/:title" : "title"
        },

        title: function(title) {
            var views = new tattooView({model:myTattooCollect});
        }
    });

    var tattooView = Backbone.View.extend({

        el        : $("#main-block"),

        template  : _.template($("#tattoo-template").html()),

        events: {

        },

        initialize: function() {
            this.model.fetch();
            this.model.bind('add', this.render, this);
        },

        render: function () {
            console.log(this.model.toJSON());
            $(this.el).html(this.template(this.model.toJSON()));
            return this;
        }
    });

    var view = new tattooView({model:myTattooCollect});

    Backbone.history.start();

});

var myTest = {
    get: function(){
        $.ajax({
            url:'search.php/Write/getAll',
            type    : 'GET',
            dataType: 'json',
            success: function(json){
                console.log('test');
                console.log(json)
            }
        })
    },
    getF: function(){
        console.log('test');
    }
}


function compire(a,b) {
	if(a < b) {
		var c = b - a;
		console.log("yes" + "  " + c);
	} else {
		var c = a - b;
		console.log("no" + "  " + c);
	}
}

compire(0,022, 0,171);