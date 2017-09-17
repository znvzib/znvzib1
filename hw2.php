<?php
echo '<meta charset="utf-8">';
//Отобразить в ООП пример из реального мира, фотографа который может делать фото различных объектов фотографии

interface Camera{
    //Общий интерфейс фотоаппаратов
    public function reload($type);//Перезарядка камеры
    public function focusing($type);//Фокусировка камеры
    public function click($type);//Сделать фото
}
class aCamera implements Camera {
    //Более подробная реализация класса фотокамер
    public $name;
    public $type;

    public function __construct($name,$type){
        $this->name=$name;
        $this->type=$type;
    }
    //Перезарядка камеры
    public function reload($type){
        if ($type=='mechanical'){
            echo "Передернуть затвор камеры<br>";
        }else{
            echo "Автоматическая перезарядка камеры<br>";
        }
    }
    //Фокусировка камеры
    public function focusing($type){
        if ($type=='mechanical'){
            echo "Установить фокус камеры вручную<br>";
        }else{
            echo "Автоматическая фокусировка камеры<br>";
        }
    }
    //Сделать фото
    public function click($type){
        $this->reload($type);
        $this->focusing($type);
        echo 'Кнопка спуска нажата - фотография сделана<br>';
    }

}
abstract class FotoMan{

    public $name;
    public $gender;
    public $age;
    public $photographyExperience;//Наличие опыта фотографирования
    public $fotoCamera;
    public $photoQuality;

    public function __construct($name,$gender,$age,$experience,$fCamera){
        $this->name=$name;
        $this->gender=$gender;
        $this->age=$age;
        $this->photographyExperience=$experience;
        $this->fotoCamera=$fCamera;

        if ($this->controlExperience()){
            $this->photoQuality='Качество фотографии - отличное.';
            echo 'Фотокамера соответствует опыту фотографирования. Приступайте.<br>';
        }else{
            $this->photoQuality='Качество фотографии - ужасное. Поменяйте камеру на более простую.';
            echo 'Фотокамера не соответствует опыту. Купите другую.<br>';
        }
    }

    //Функция контроля соответствия опыта и типа фотокамеры
    public function controlExperience(){
        if ($this->photographyExperience===true ||
            $this->photographyExperience===false && $this->fotoCamera->type=='mechanical')
        {
            return true;
        }else{
            return false;
        }
    }
    abstract public function doFoto();
}

$fotoCameraAuto = new aCamera('Polaroid','auto');
$fotoCameraMechanical = new aCamera('Canon','mechanical');

class newFotoMan extends FotoMan{

    public function doFoto(){
        echo $this->name.'<br>';
        echo $this->fotoCamera->name.'<br>';
        $this->fotoCamera->click($this->fotoCamera->type);
        echo $this->photoQuality . '<br><br>';
    }
}
$fotoManVasya = new newFotoMan('VASYA','Men',35,true,$fotoCameraAuto);
$fotoManVasya->doFoto();

$fotoManPetya = new newFotoMan('PETYA','Men',39,false,$fotoCameraMechanical);
$fotoManPetya->doFoto();