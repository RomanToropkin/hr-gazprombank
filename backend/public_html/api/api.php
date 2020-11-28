<?php


/**
 * Created by PhpStorm.
 */

header('Access-Control-Allow-Origin: *'); // ПОТОМ УБРАТЬ!!!!
header('Access-Control-Allow-Headers: *');
require_once './TestApi.php';

$Api = new API();
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $postdata = file_get_contents('php://input');
    $data = json_decode($postdata, true);
} else {
    $data = $_SERVER['QUERY_STRING'];
    $data = parse($data);
}

function parse($s)
{
    $res = array();
    foreach (explode('&',$s) as $tmp)
    {
        $tmp2 = explode('=',$tmp);
        $key = $tmp2[0];
        $tmp2[1] = urldecode($tmp2[1]);
        unset ($tmp2[0]);
        if (stristr($key,'[]')) {
            $arr_key = str_replace('[]','',$key);
            if(!array_key_exists($arr_key,$res))
                $res[$arr_key]=array();
            array_push($res[$arr_key],$tmp2[1]);
        } else {
            $res[$key] = implode('=', $tmp2);
        }
    }
    return $res;
}

if (isset($data['type'])){
    $method = $data['type'];
    if (method_exists($Api, $method)){
        $drar = $Api->$method($data);
        header('Content-type: application/json');
        echo json_encode($drar, JSON_UNESCAPED_UNICODE);
    } else {
        print_r('Такого метода не существует!');
    }
} else {
    print_r('Не задан метод!');
}

?>
