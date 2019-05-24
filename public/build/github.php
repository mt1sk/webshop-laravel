<?php

ini_set('display_errors', 'on');

$path_to_php = '/usr/local/php72/bin/';
$dir = dirname(__DIR__);
$secret_key = '18b468e85ce7bc3eec1065e7219c2cbbc3a57facfd7fae135839db23b72a917e';

$request_body = file_get_contents('php://input');
$sha1 = 'sha1='.hash_hmac('sha1', $request_body, $secret_key);

if (hash_equals($sha1, $_SERVER['HTTP_X_HUB_SIGNATURE'])) {
    $request_body = json_decode($request_body);

    if ($_SERVER['HTTP_X_GITHUB_EVENT'] != 'push') {
        print 'Other event'.PHP_EOL;
        exit;
    }

    if (!isset($request_body->ref)) {
        print 'No ref'.PHP_EOL;
        exit;
    }

    $ref = explode('/', $request_body->ref);
    if (!isset($ref[2])) {
        print 'No branch'.PHP_EOL;
    }

    switch ($_GET['channel']) {
        case 'dev':
            $branch = 'dev';
            break;
        case 'production':
            $branch = 'production';
            break;
        case 'master':
            $branch = 'master';
            break;
        default:
            print 'wrong channel';
            exit;
    }

    // Если прилител хук, но пушили не в ветку которую мы "слушаем", phing запускать не нужно
    if ($ref[2] != $branch) {
        print 'Other channel'.PHP_EOL;
        exit;
    }

    exec("{$path_to_php}php {$dir}/build/bin/phing.phar -f {$dir}/build/build.xml -Dbranch=\"{$branch}\" -Dphp_path=\"{$path_to_php}\"", $output);
    print 'OK'.PHP_EOL;
    foreach ($output as $out) {
        print $out.PHP_EOL;
    }
} else {
    header('HTTP/1.1 404 Not Found');
    exit;
}
