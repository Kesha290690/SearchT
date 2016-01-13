$(function() {

    var tattooModel     = Backbone.Model.extend({});

    var tattooCollect   = Backbone.Collection.extend({

        model   : tattooModel,

        url     : function(){
            return 'search.php?word=' + encodeURIComponent(this.word);
        },

        setWord : function(word) {
            this.word = word;
            return this;
        }
    });

    var tattooView      = Backbone.View.extend({

        collection  : new tattooCollect(),

        el          : $(".container"),

        $imageBlock : $('#main-block'),

        template    : _.template($("#tattoo-template").html()),

        events      : {
            "click .search-button"   : "searchT",
        },

        initialize  : function() {
            this.input = this.$("#searchTattoo");
            this.collection.bind('add', this.render, this);
        },

        render      : function () {
            var that = this;

            this.$imageBlock.html('');

            this.collection.each(function(model) {
                console.log(model);
                that.$imageBlock.append(that.template(model.toJSON()));
            });
            return this;
        },

        searchT     : function() {
            var word;

            if (word = this.input.val()) {
                this.collection.setWord(word).fetch();
            }
        }
    });

    var view = new tattooView();
});