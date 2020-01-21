<?php declare(strict_types=1);

namespace Acme;

use function Siler\array_get;
use function Siler\Swoole\{cors, http, json, request};

require_once __DIR__ . '/../vendor/autoload.php';

$handler = function () {
    cors();

    $file = array_get(request()->files, 'file');
    $result = move_uploaded_file($file['tmp_name'], __DIR__ . '/../var/' . $file['name']);

    json(['result' => $result]);
};

http($handler, 3000)->start();

