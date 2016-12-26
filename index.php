<?php
require 'vendor/autoload.php';

define('AWS_KEY', 'RKAG1I1VD21A7ZD0DN84');
define('AWS_SECRET_KEY', 'cEZgXggQOFH7ns8iPDRtFJffog8XjJOfTOt2wZnR');
define('AWS_CANONICAL_ID', 'grup2');
define('AWS_CANONICAL_NAME', 'grup2');

$HOST = 'grup2-ceph-04.sisdis.ui.ac.id';

$Connection = new AmazonS3(array(
    'key' => AWS_KEY,
    'secret' => AWS_SECRET_KEY,
    'canonical_id' => AWS_CANONICAL_ID,
    'canonical_name' => AWS_CANONICAL_NAME,
));

$Connection->set_hostname($HOST);

$Connection->allow_hostname_override(false);

$Connection->enable_path_style();

$app = new \Slim\Slim();

$app->get('/', function () use ($Connection) {
    $ListResponse = $Connection->list_buckets();
    $Buckets = $ListResponse->body->Buckets->Bucket;
    foreach ($Buckets as $Bucket) {
        echo $Bucket->Name . "\t" . $Bucket->CreationDate . "\n";

    }
});

$app->get('/uploaded', function () use ($Connection) {
    $ObjectsListResponse = $Connection->list_objects('my-new-bucket');
    $Objects = $ObjectsListResponse->body->Contents;
    foreach ($Objects as $Object) {
        echo $Object->Key . "\t" . $Object->Size . "\t" . $Object->LastModified . "\n";
	echo "<br/>";
    }
});

$app->get('/create/:name', function ($name) use ($Connection) {
    $Connection->create_object('my-new-bucket', $name . '.txt', array(
        'body' => "Hello " . $name . "!",
    ));
});



$app->get('/download/:name', function ($name) use ($Connection) {
    $url = $Connection->get_object_url('my-new-bucket', $name . '.txt', '1 hour');
    $url = preg_replace("/^http:/i", "https:", $url);
    echo $url . "\n";
});

$app->post('/uploadFile', 'uploadFile');

function uploadFile(){
  $app = \Slim\Slim::getInstance();
  echo fopen($_FILES["fileToUpload"]["tmp_name"], 'r');
}

$app->run();
