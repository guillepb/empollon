// Filename: router.js
define([
  'jquery',
  'underscore',
  'backbone',
  'views/questions/questionlist'
], function($, _, Backbone,QuestionList){

  var AppRouter = Backbone.Router.extend({
    routes: {

      // Define some URL routes
      '':               'home',

      // Default
      '*actions':       'defaultAction'
    }
  });

  var initialize = function(){
    var app_router = new AppRouter;

    var questionList = new QuestionList();

    app_router.on('route:home', function(){
      questionList.render();
    });

    app_router.on('route:defaultAction', function(actions){
      // We have no matching route, lets just log what the URL was
      console.log('No route:', actions);
    });

    Backbone.history.start();
  };
  return {
    initialize: initialize
  };
});
