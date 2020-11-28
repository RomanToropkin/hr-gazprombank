<?php


class FileUploader
{

    private $db;
    /**
     * FileUploader constructor.
     */
    public function __construct()
    {
        $this->db = DB::getInstance();
    }

    public function upload($file, $baseURL='files/')
    {
        $filePath = $file['tmp_name'];
        $errorCode = $file['error'];

        // Проверим на ошибки
        if ($errorCode !== UPLOAD_ERR_OK || !is_uploaded_file($filePath)) {

            // Массив с названиями ошибок
            $errorMessages = [
                UPLOAD_ERR_INI_SIZE => 'Размер файла превысил значение upload_max_filesize в конфигурации PHP.',
                UPLOAD_ERR_FORM_SIZE => 'Размер загружаемого файла превысил значение MAX_FILE_SIZE в HTML-форме.',
                UPLOAD_ERR_PARTIAL => 'Загружаемый файл был получен только частично.',
                UPLOAD_ERR_NO_FILE => 'Файл не был загружен.',
                UPLOAD_ERR_NO_TMP_DIR => 'Отсутствует временная папка.',
                UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск.',
                UPLOAD_ERR_EXTENSION => 'PHP-расширение остановило загрузку файла.',
            ];

            // Зададим неизвестную ошибку
            $unknownMessage = 'При загрузке файла произошла неизвестная ошибка.';

            // Если в массиве нет кода ошибки, скажем, что ошибка неизвестна
            $outputMessage = isset($errorMessages[$errorCode]) ? $errorMessages[$errorCode] : $unknownMessage;

            // Выведем название ошибки
            die($outputMessage);
        }

        // Создадим ресурс FileInfo
        $fi = finfo_open(FILEINFO_MIME_TYPE);

        // Получим MIME-тип
        $mime = (string)finfo_file($fi, $filePath);

//        // Проверим ключевое слово image (image/jpeg, image/png и т. д.)
//        if (strpos($mime, 'application') === false) die('Можно загружать только изображения.');
        $file_size = getimagesize($filePath);

        // Зададим ограничения для картинок
        $limitBytes = 1024 * 1024 * 10;
        //$limitWidth  = 1920;
        //$limitHeight = 1080;

        // Проверим нужные параметры
        if (filesize($filePath) > $limitBytes) die('Размер файла не должен превышать 10 Мбайт.');
        //if ($image[1] > $limitHeight)          die('Высота изображения не должна превышать 1080 точек.');
        //if ($image[0] > $limitWidth)           die('Ширина изображения не должна превышать 1920 точек.');


        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = $this->randHash();

        // Сгенерируем расширение файла на основе типа картинки
        $extension = $this->getExtension($file['name']);

        // Сократим .jpeg до .jpg
        //$format = str_replace('jpeg', 'jpg', $extension);

        $url = 'http://hr-gazprombank.creativityprojectcenter.ru/' . $baseURL . $name . $extension;

        // Переместим картинку с новым именем и расширением в папку /pics
        if (!move_uploaded_file($filePath, realpath($_SERVER["DOCUMENT_ROOT"]) . '/'. $baseURL . $name . $extension)) {
            die('При записи изображения на диск произошла ошибка.');
        }

        return ['url' => $url, 'path' => $baseURL . $name . $extension . ''];
    }

    private function randHash($len = 32)
    {
        return substr(md5(openssl_random_pseudo_bytes(20)), -$len);
    }

    private function getExtension($filename) {
        return '.'.substr($filename, strrpos($filename, '.') + 1);
    }
    
    public function loadFile($path, $url){
        try {
            $this->db->query("START TRANSACTION;");
            $sql = "INSERT INTO files SET path = '?s', url = '?s';";
            $this->db->query($sql, $path, $url);
            $id = $this->db->getLastInserted();
            $this->db->query("COMMIT;");
            return $id;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }

    public function loadTaskToVacancy($id_vacancy, $id_file){
        try {
            $this->db->query("START TRANSACTION;");
            $sql = "INSERT INTO vacancy_files SET id_vacancy = ?i, id_file = ?i;";
            $this->db->query($sql, $id_vacancy, $id_file);
            $this->db->query("COMMIT;");
            return 0;
        } catch (Exception $ex) {
            $this->db->query("ROLLBACK;");
            return -1;
        }
    }

}