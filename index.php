<?php
require 'vendor/autoload.php';

define('AWS_KEY', 'RKAG1I1VD21A7ZD0DN84');
define('AWS_SECRET_KEY', 'cEZgXggQOFH7ns8iPDRtFJffog8XjJOfTOt2wZnR');
define('AWS_CANONICAL_ID', 'grup2');
define('AWS_CANONICAL_NAME', 'grup2');
define('HOST', 'grup2-ceph-04.sisdis.ui.ac.id');
define('BUCKET_NAME', 'my-new-bucket');

$Connection = new AmazonS3(array(
    'key' => AWS_KEY,
    'secret' => AWS_SECRET_KEY,
    'canonical_id' => AWS_CANONICAL_ID,
    'canonical_name' => AWS_CANONICAL_NAME,
));

$Connection->set_hostname(HOST);

$Connection->allow_hostname_override(false);

$Connection->enable_path_style();

$app = new \Slim\Slim();

$app->get('/', function () use ($app) {
    $app->render('home.php', array('error' => 0));
});

$app->get('/delete/:filename', function ($filename) use ($Connection, $app) {
    $status = $Connection->get_object(BUCKET_NAME, $filename);
    $status = $status->header['_info']['http_code'];
    if ($status != 404) {
        $response = $Connection->delete_object(BUCKET_NAME, $filename);
        $ObjectsListResponse = $Connection->list_objects(BUCKET_NAME);
        $Objects = $ObjectsListResponse->body->Contents;
        if ($response->isOK()) {
            $app->render('gallery.php', array('filename' => $filename, 'success' => 1, 'Objects' => $Objects, 'Copy' => 0));
        } else {
            $app->render('gallery.php', array('filename' => $filename, 'success' => 2, 'Objects' => $Objects, 'Copy' => 0));
        }
    }
});

$app->get('/copy/:filename', function ($filename) use ($Connection, $app) {
    $ListResponse = $Connection->list_buckets();
    $Buckets = $ListResponse->body->Buckets->Bucket;
    $status = $Connection->get_object(BUCKET_NAME, $filename);
    $status = $status->header['_info']['http_code'];
    if ($status != 404) {
        $app->render('copy.php', array('filename' => $filename, 'bucket_source' => BUCKET_NAME, 'Buckets' => $Buckets));
    }
});

$app->post('/copyFile', function () use ($Connection, $app) {
    $filename = $app->request->params('filename');
    $bucket_source = $app->request->params('bucket_source');
    $filename_new = $app->request->params('filename_new');
    $bucket_destination = $app->request->params('bucket_destination');
    $status = $Connection->get_object($bucket_destination, $filename_new);
    $ObjectsListResponse = $Connection->list_objects(BUCKET_NAME);
    $Objects = $ObjectsListResponse->body->Contents;
    $status = $status->header['_info']['http_code'];
    if ($status == 404) {
        $response = $Connection->copy_object(
            array( // Source
                'bucket' => $bucket_source,
                'filename' => $filename
            ),
            array( // Destination
                'bucket' => $bucket_destination,
                'filename' => $filename_new
            ),
            array( // Optional parameters
                'acl' => AmazonS3::ACL_PUBLIC
            )
        );
        if ($response->isOK()) {
            $app->render('gallery.php', array('filename' => $filename, 'success' => 0, 'Objects' => $Objects, 'Copy' => 3));
        } else {
            $app->render('gallery.php', array('filename' => $filename, 'success' => 0, 'Objects' => $Objects, 'Copy' => 4));
        }
    } else {
        $app->render('gallery.php', array('filename' => $filename, 'success' => 0, 'Objects' => $Objects, 'Copy' => 2));
    }
});

$app->post('/', function () use ($Connection, $app) {
    $filename = basename($_FILES["fileToUpload"]["name"]);
    $status = $Connection->get_object(BUCKET_NAME, $filename);
    $status = $status->header['_info']['http_code'];
    if ($status == 404) {
        $size = $_FILES["fileToUpload"]["size"];
        $file_resource = fopen($_FILES["fileToUpload"]["tmp_name"], 'r');
        $response = $Connection->create_object('my-new-bucket', $filename, array(
            'fileUpload' => $file_resource,
            'length' => $size,
            'acl' => AmazonS3::ACL_PUBLIC
        ));
        if ($response->isOK()) {
            $uploadURL = 'https://' . HOST . '/' . BUCKET_NAME . '/' . $filename;
            $app->render('success.php', array('url' => $uploadURL, 'filename' => $filename));
        } else {
            $app->render('home.php', array('error' => 1));
        }
    } else {
        $app->render('home.php', array('error' => 1));
    }
});

$app->get('/gallery', function () use ($Connection, $app) {
    $ObjectsListResponse = $Connection->list_objects(BUCKET_NAME);
    $Objects = $ObjectsListResponse->body->Contents;
    $app->render('gallery.php', array('filename' => '', 'success' => 0, 'Objects' => $Objects, 'Copy' => 1));
});

$app->run();
