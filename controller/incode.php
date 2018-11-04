<?php

//ini_set('error_reporting', 1);
//ini_set('display_errors', 1);
class inCode
{
    public function cryptAlg()     // получение "соли" (массива случайных символов)
    {
       $str = 'vz;1b[n2ma9xc5sdf4glk4jh:hg{]6!@uyt#$7*&*8()';
        $arr = str_split($str);
        shuffle($arr);
        return $arr;
    }

    public function getPass()  // получение пароля (данные не проверяются, упрощенная форма)
    {
        $get = $_GET['pass'];
        $pass = str_split($get);
        return $pass;
    }

    public function timeFunc()   // получение времени(секунд) для создания ключа шифрования
    {
    return date('s');
    }

    public function cryptFunc2()    // шифрование (добавление символов с пароля в строку со случайными символами)
    {
        $fin_item = [];
        $i = substr($this->timeFunc(), 0,1);           // номер ключа значения для замены
        $count = 0;       // количество замен
        $count_item = strlen(implode($this->getPass()));      //количество символов в пароле
        foreach ($this->cryptAlg() as $key => $item) {
            if ($key == $i && $count <= $count_item) {
                $fin_item[] = $this->getPass()[$count];
                $i += 4;
                $count++;
            } else {
                $fin_item[] = $item;
            }
        }
        $fin_item = implode('', $fin_item);
        return $fin_item;
    }

    public function onLoad()   // загрузка данных в таблицу БД
    {
        $time_code1 = str_replace(':', '', date("Y:m:d:H:i:s"));
        $string = $this->cryptFunc2();
        $count_item = strlen(implode($this->getPass()));
        require_once 'model/incode.php';
        $model= new Model();
        $model->write($string,$time_code1,$count_item);

    }
    public function link()            // формирование ссылки на пароль
    {
        require_once 'model/incode.php';
        $model= new Model();
        $link=$_SERVER['SERVER_NAME'] . "/?id=" . $model->lastId();
        return $link;
    }

}
$inCode = new inCode();
$inCode->onLoad();

?>


