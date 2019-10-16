<?php

// sučelje služi da ga neka klasa implementirati
interface ITemplate { //dodaje se I da se zna da je interface
    public function setTitle($title);
    public function getTemplate();
    public function setTemplate($template);

}

class Page implements ITemplate {

    private $title;
    private $template;

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($title) {   //mora imati istu funkciju kao interface
        $this->title = $title;
    }

    public function getTemplate(){
        return $this->template;
    }

    public function setTemplate($template){
        $this->template = $template;
    }

    public function print(){
        echo $this->template;
    }
}

$page = new Page();
$page->setTitle('PHP Interfaces');
$page->setTemplate('
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>' . $page->getTitle() . '</title>
</head>
<body>
    <h1>Interfaces</h1>
</body>
</html>');

$page->print();

?>
