<?php

namespace App\Entity;

use DateTime;
use JsonSerializable;

class Pessoa implements JsonSerializable
{

    /**
     *
     * @var int
     */
    private $id;

    /**
     *
     * @var string
     */
    private $nome;

    /**
     *
     * @var bool
     */
    private $ativo;

    /**
     *
     * @var DateTime
     */
    private $data_nascimento;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(?string $nome): void
    {
        $this->nome = $nome;
    }

    public function getAtivo(): ?bool
    {
        return $this->ativo;
    }

    public function setAtivo(?bool $ativo): void
    {
        $this->ativo = $ativo;
    }

    public function getDataNascimento(): ?DateTime
    {
        return $this->data_nascimento;
    }

    public function setDataNascimento(?DateTime $data_nascimento): void
    {
        $this->data_nascimento = $data_nascimento;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}
