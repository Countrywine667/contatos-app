<?php

namespace Src\Controllers;

use Src\Services\ContactService;

class ContactController
{
    private $service;

    public function __construct()
    {
        $this->service = new ContactService();
    }

    public function index()
    {
        $contacts = $this->service->listContacts();
        include __DIR__ . "/../../views/contacts-list.php";
    }

    public function create()
    {
        include __DIR__ . "/../../views/contact-create.php";
    }

    public function store()
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phones = $_POST['phones']; // array

        $this->service->createContact($name, $email, $phones);

        header("Location: /");
        exit;
    }

    public function edit($id)
    {
        $contact = $this->service->getContact($id);
        include __DIR__ . "/../../views/contact-edit.php";
    }

    public function update($id)
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phones = $_POST['phones'];

        $this->service->updateContact($id, $name, $email, $phones);

        header("Location: /");
        exit;
    }

    public function delete($id)
    {
        $this->service->deleteContact($id);
        header("Location: /");
        exit;
    }
}
