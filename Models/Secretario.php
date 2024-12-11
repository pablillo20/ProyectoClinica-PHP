<?php
namespace Models;

class Secretario {
    public function __construct(private string $nombre, private string $email, private string $password, private int $id = 0) {}

    public function getId(): int {
        return $this->id;
    }

    public function getNombre(): string {
        return $this->nombre;
    }

    public function getEmail(): string {
        return $this->email;
    }

    public function getPassword(): string {
        return $this->password;
    }
}
?>
