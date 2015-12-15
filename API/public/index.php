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
<<<<<<< HEAD
      $nuclei = Nucleus::valid()->with(['sets' => function($q){
          $q->where('is_valid','=','1');
        }])->get();
=======
      $nuclei = Nucleus::valid()->with('sets')->get();
>>>>>>> f238d7ef1f8055163826758e5386d247fd79dddf

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($nuclei);
    });

    $app->get('/:id', function ($id) use ($app) {
//      $nucleus = Nucleus::find($id);
      $ids = explode(';',$id);
      $nucleus = Nucleus::whereIn('id',$ids)->with(['sets' => function($q){
          $q->where('is_valid','=','1');
        }])->get();

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($nucleus);
    });

    $app->get('/:id/sets', function ($id) use ($app) {
      $ids = explode(';',$id);
      $sets = Set::whereHas('nucleus',function($q) use ($ids) {
        $q->whereIn('id',$ids);
      })->valid()->get();

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
//      $set = Set::find($id);
      $ids = explode(';',$id);
      $set = Set::whereIn('id',$ids)->get();

      $res = $app->response();
      $res['Content-Type'] = 'application/json';
      $res->body($set);
    });

    $app->get('/:id/questions', function ($id) use ($app) {
      $ids = explode(';',$id);
      $questions = Question::whereIn('set_id',$ids)->get();
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
