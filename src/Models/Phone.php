<?php

namespace Src\Models;

class Phone
{
    public $id;
    public $contact_id;
    public $number;

    public function __construct($id = null, $contact_id = null, $number = "")
    {
        $this->id = $id;
        $this->contact_id = $contact_id;
        $this->number = $number;
    }
}
