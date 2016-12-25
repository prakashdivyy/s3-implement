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

$app->get('/', function () use($Connection) {
    $ListResponse = $Connection->list_buckets();
    $Buckets = $ListResponse->body->Buckets->Bucket;
    foreach ($Buckets as $Bucket) {
        echo $Bucket->Name . "\t" . $Bucket->CreationDate . "\n";
    }
});

$app->run();