<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FuncionarioRepository")
 */
class Funcionario
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $nome_str;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Departamento", inversedBy="funcionarios")
     */
    private $departamentos;

    public function __construct()
    {
        $this->departamentos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomeStr(): ?string
    {
        return $this->nome_str;
    }

    public function setNomeStr(string $nome_str): self
    {
        $this->nome_str = $nome_str;

        return $this;
    }

    /**
     * @return Collection|Departamento[]
     */
    public function getDepartamentos(): Collection
    {
        return $this->departamentos;
    }

    public function addDepartamento(Departamento $departamento): self
    {
        if (!$this->departamentos->contains($departamento)) {
            $this->departamentos[] = $departamento;
        }

        return $this;
    }

    public function removeDepartamento(Departamento $departamento): self
    {
        if ($this->departamentos->contains($departamento)) {
            $this->departamentos->removeElement($departamento);
        }

        return $this;
    }

    public function __toString() {
        return $this->getNomeStr();
    }    
}
