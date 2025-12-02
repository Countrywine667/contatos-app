<?php

namespace Src\Repositories;

use Src\Config\Database;

class ContactRepository
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    public function getAll()
    {
        $query = $this->db->query("SELECT * FROM contacts");
        return $query->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM contacts WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$id]);
        $contact = $stmt->fetch(\PDO::FETCH_ASSOC);

        if (!$contact) return null;

        // Buscar telefones
        $sqlPhones = "SELECT * FROM phones WHERE contact_id = ?";
        $stmtPhones = $this->db->prepare($sqlPhones);
        $stmtPhones->execute([$id]);
        $phones = $stmtPhones->fetchAll(\PDO::FETCH_ASSOC);

        $contact['phones'] = $phones;

        return $contact;
    }

    public function insert($name, $email, $phones)
    {
        $sql = "INSERT INTO contacts (name, email) VALUES (?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $email]);

        $contactId = $this->db->lastInsertId();

        foreach ($phones as $phone) {
            $sqlPhone = "INSERT INTO phones (contact_id, number) VALUES (?, ?)";
            $stmtPhone = $this->db->prepare($sqlPhone);
            $stmtPhone->execute([$contactId, $phone]);
        }

        return $contactId;
    }

    public function update($id, $name, $email, $phones)
    {
        $sql = "UPDATE contacts SET name = ?, email = ? WHERE id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$name, $email, $id]);

        // apagar telefones antigos
        $delete = $this->db->prepare("DELETE FROM phones WHERE contact_id = ?");
        $delete->execute([$id]);

        // inserir novos
        foreach ($phones as $phone) {
            $sqlPhone = "INSERT INTO phones (contact_id, number) VALUES (?, ?)";
            $stmtPhone = $this->db->prepare($sqlPhone);
            $stmtPhone->execute([$id, $phone]);
        }

        return true;
    }

    public function delete($id)
    {
        $this->db->prepare("DELETE FROM phones WHERE contact_id = ?")->execute([$id]);
        $this->db->prepare("DELETE FROM contacts WHERE id = ?")->execute([$id]);
        return true;
    }
}
