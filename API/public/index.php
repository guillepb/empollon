<?php
// Autoload our dependencies with Composer
require '../vendor/autoload.php';
require '../app/config/dbconfig.php';

 error_reporting(E_ALL);
 ini_set('display_errors', '1');

// Create Slim app
$app = new \Slim\Slim();

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => $db_host,
    'database'  => $db_dbname,
    'username'  => $db_username,
    'password'  => $db_password,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$capsule->bootEloquent();

$app->get('/', function () use ($app) {
  echo "API de Empoll&oacute;n";

});

$app->group('/nucleus', function () use ($app) {

    $app->get('/', function () use ($app) {
      $nuclei = Nucleus::valid()->get();

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($nuclei);
    });

    $app->get('/:id', function ($id) use ($app) {
      $nucleus = Nucleus::find($id);

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($nucleus);
    });

    $app->get('/:id/sets', function ($id) use ($app) {

      $sets = Nucleus::find($id)->sets()->valid()->get();

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($sets);
    });

});

$app->group('/set(s)', function () use ($app) {

    $app->get('/', function () use ($app) {
      $sets = Set::valid()->get();

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($sets);
    });

    $app->get('/:id', function ($id) use ($app) {
      $set = Set::find($id);

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($set);
    });

    $app->get('/:id/questions', function ($id) use ($app) {
      $questions = Set::find($id)->questions;
      $questions->load('answers');

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($questions);
    });
});

$app->group('/question(s)', function () use ($app) {

    $app->get('/', function () use ($app) {
      $questions = Question::with('answers')->get();

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($questions);
    });

    $app->get('/:id', function ($id) use ($app) {
      $question = Question::with('answers')->find($id);

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($question);
    });

    $app->get('/:id/answers', function ($id) use ($app) {
      $answers = Question::find($id)->answers;

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($answers);
    });


});

$app->run();

?>
