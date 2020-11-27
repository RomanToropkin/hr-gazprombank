<?php

$param = [
    'test'=>'hello world'
];
$jsonparam= base64_encode(json_encode($param, JSON_UNESCAPED_UNICODE));
$command = "python3 test.py $jsonparam";
print_r($command);
exec($command, $output, $res_code);
print_r($output);
print_r("\n");
print_r($res_code);