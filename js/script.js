$(function() {

    var tattooModel = Backbone.Model.extend({
        urlRoot: "search.php"
    });

    var tattooCollect = Backbone.Collection.extend({
        model: tattooModel,
        url: "test.php"
    });

    var myTattooCollect = new tattooCollect();

    var tattooView = Backbone.View.extend({

        el        : $(".container"),

        model: myTattooCollect,

        $imageBlock       : $('#main-block'),

        template  : _.template($("#tattoo-template").html()),

        events: {
            "click .search-button"   : "searchT",
        },

        initialize: function() {
            this.input = this.$("#searchTattoo");
            this.model.bind('add', this.render, this);
        },

        render: function () {
            console.log(this.model.toJSON()[0]);
            $(this.$imageBlock).html(this.template(this.model.toJSON()[0]));
            return this;
        },

        searchT : function() {
            //if (!this.input.val()) return;
            this.model.fetch();
        }

    });

    var view = new tattooView();



});

var myTest = {
    get: function(word){
        $.ajax({
            url:'search.php',
            data    : 'word=' + word,
            type    : 'post',
            dataType: 'json',
            success: function(json){
                $('#main-block').html('');
                template = _.template($('#tattoo-template').html());
                $('#main-block').append(template(
                    {
                        name : json.name,
                        path : json.path
                    }
                ));
                console.log(json);
            }
        })
    }
}