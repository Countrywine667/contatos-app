<?php

namespace Src\Models;

class Contact
{
    public $id;
    public $name;
    public $email;
    public $phones = [];

    public function __construct($id = null, $name = "", $email = "")
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}
