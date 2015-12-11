// Filename: main.js

// Require.js allows us to configure shortcut alias
// There usage will become more apparent further along in the tutorial.
require.config({
  paths: {
    jquery: '//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min',
    underscore: '//cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min',
    backbone: '//cdnjs.cloudflare.com/ajax/libs/backbone.js/1.2.3/backbone-min',
    text: '//cdnjs.cloudflare.com/ajax/libs/require-text/2.0.12/text.min',
    bootstrap: '//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min'
  },
  shim: {
      'bootstrap':{deps: ['jquery']}
  }
});

require([
  // Load our app module and pass it to our definition function
  'app',
  'bootstrap'
], function(App, _bootstrap){
  // The "app" dependency is passed in as "App"
  App.initialize();
});
