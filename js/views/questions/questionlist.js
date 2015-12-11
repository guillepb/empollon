define([
  'jquery',
  'underscore',
  'backbone',
  'collections/questions/questions',
  'text!templates/questions/list.html'
//  'text!templates/questions/single.html'
], function($, _, Backbone, Questions, questionListTemplate){

  var QuestionList = Backbone.View.extend({
    el: '.page',
    render: function() {
      var that = this;
      var questions = new Questions();
      questions.fetch({
        success: function (questions) {

        var template = _.template($(questionListTemplate).html())
          ({questions: questions.models});

        that.$el.html(template);

        }
      })
    },
    events: {
      'click .unanswered .respuesta'  : 'disableAndEval',
      'click #morequestions'          : 'showMoreQuestions',
      'click #redofailed'             : 'redoFailedQuestions'
    },
    disableAndEval: function (e) {
      e.preventDefault();
      $(e.currentTarget).siblings().add(e.currentTarget).removeAttr('href');
      $(e.currentTarget).parents('.pregunta').removeClass('unanswered');
      if ($(e.currentTarget).attr('data-correct') == '1') {
        console.log('Yay!');
        $(e.currentTarget).addClass('list-group-item-success');
        $(e.currentTarget).parents('.pregunta').removeClass('fallada')
                                                .addClass('acertada');
      } else {
        console.log('Nay!');
        $(e.currentTarget).addClass('list-group-item-danger');
        $(e.currentTarget).siblings('[data-correct=1]').addClass('list-group-item-success');
        $(e.currentTarget).parents('.pregunta').addClass('fallada');
      }
    },
    showMoreQuestions: function (e) {
      e.preventDefault();
      $('.pregunta.hidden').slice(0,10).removeClass('hidden');
      if($('.pregunta.hidden').length == 0) {
        $("#morequestions").fadeOut();
      }
    },
    redoFailedQuestions: function (e) {
      e.preventDefault();
      $(document).scrollTop(0);
      $(".acertada").fadeOut();
      $(".fallada").addClass('unanswered').find('a')
          .removeClass('list-group-item-success list-group-item-danger')
          .attr('href','#');
    }
  });

  return QuestionList;
});
