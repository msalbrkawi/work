<?php


class Category
{
    public $id;
    public $name;
    public $img;
    public $discription;
    public function __construct()
    {
        settype($this->id, 'integer');
    }
}