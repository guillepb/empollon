// Filename: collections/questions.js
define([
  'underscore',
  'backbone'
], function(_, Backbone){
  var Questions = Backbone.Collection.extend({
    url: 'API/public/questions'
  });

  return Questions;
});
