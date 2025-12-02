<?php

namespace Src\Services;

use Src\Repositories\ContactRepository;

class ContactService
{
    private $repository;

    public function __construct()
    {
        $this->repository = new ContactRepository();
    }

    public function listContacts()
    {
        return $this->repository->getAll();
    }

    public function getContact($id)
    {
        return $this->repository->getById($id);
    }

    public function createContact($name, $email, $phones)
    {
        if (empty($name)) {
            throw new \Exception("O nome é obrigatório.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("E-mail inválido.");
        }

        if (empty($phones)) {
            throw new \Exception("Pelo menos um telefone é necessário.");
        }

        return $this->repository->insert($name, $email, $phones);
    }

    public function updateContact($id, $name, $email, $phones)
    {
        return $this->repository->update($id, $name, $email, $phones);
    }

    public function deleteContact($id)
    {
        return $this->repository->delete($id);
    }
}
