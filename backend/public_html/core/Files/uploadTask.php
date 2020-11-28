<?php

require_once 'FileUploader.php';
require_once '../../../vendor/autoload.php';
require_once '../DB.php';

echo '<form action="uploadTask.php" method="post" enctype="multipart/form-data">
  <input type="file" name="upload[]" multiple>
  <input type="text" name="id_vacancy">
  <button>Загрузить</button>    
</form>';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

$fileUploader = new FileUploader();

if (isset($_FILES['upload']) && isset($_POST['id_vacancy'])){
    foreach($_FILES['upload'] as $key => $value) {
        foreach($value as $k => $v) {
            $_FILES['upload'][$k][$key] = $v;
        }
        // Удалим старые ключи
        unset($_FILES['upload'][$key]);
    }
    $files = $_FILES['upload'];
    foreach ($files as $file){
        $res = $fileUploader->upload($file, 'files/tasks/');
        $id_file = $fileUploader->loadFile($res['path'], $res['url']);
        if ($id_file){
            $fileUploader->loadTaskToVacancy($_POST['id_vacancy'], $id_file);
        }
    }
}


