<?php
include 'Core/Model.php';
include 'Core/View.php';


class Controller
{
    public $Model;
    public $View;
    public function __construct()
    {
        $this->Model = new Model();
        $this->View = new View();
    }

    public function indexAction()
   {
        $this->View->index();
    }







}