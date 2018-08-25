<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MovimentosRepository")
 */
class Movimentos
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Funcionario")
     */
    private $funcionario;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $descricao_str;

    /**
     * @ORM\Column(type="float")
     */
    private $valor_num;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFuncionario(): ?Funcionario
    {
        return $this->funcionario;
    }

    public function setFuncionario(?Funcionario $funcionario): self
    {
        $this->funcionario = $funcionario;

        return $this;
    }

    public function getDescricaoStr(): ?string
    {
        return $this->descricao_str;
    }

    public function setDescricaoStr(string $descricao_str): self
    {
        $this->descricao_str = $descricao_str;

        return $this;
    }

    public function getValorNum(): ?float
    {
        return $this->valor_num;
    }

    public function setValorNum(float $valor_num): self
    {
        $this->valor_num = $valor_num;

        return $this;
    }

    public function __toString() {
        return $this->getDescricaoStr();
    }    
}
