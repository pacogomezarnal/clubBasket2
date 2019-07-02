<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EquipoRepository")
 */
class Equipo
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $categoria;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $sexo;

    /**
     * @ORM\Column(type="integer")
     */
    private $numjugadores;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultado", mappedBy="equipolocal")
     */
    private $resultadoslocal;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Resultado", mappedBy="equipovisitante")
     */
    private $resultadosvisitante;

    public function __construct()
    {
        $this->resultadoslocal = new ArrayCollection();
        $this->resultadosvisitante = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoria(): ?string
    {
        return $this->categoria;
    }

    public function setCategoria(string $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    public function getSexo(): ?string
    {
        return $this->sexo;
    }

    public function setSexo(string $sexo): self
    {
        $this->sexo = $sexo;

        return $this;
    }

    public function getNumjugadores(): ?int
    {
        return $this->numjugadores;
    }

    public function setNumjugadores(int $numjugadores): self
    {
        $this->numjugadores = $numjugadores;

        return $this;
    }

    /**
     * @return Collection|Resultado[]
     */
    public function getresultadoslocal(): Collection
    {
        return $this->resultadoslocal;
    }

    public function addResultado(Resultado $resultado): self
    {
        if (!$this->resultadoslocal->contains($resultado)) {
            $this->resultadoslocal[] = $resultado;
            $resultado->setEquipolocal($this);
        }

        return $this;
    }

    public function removeResultado(Resultado $resultado): self
    {
        if ($this->resultadoslocal->contains($resultado)) {
            $this->resultadoslocal->removeElement($resultado);
            // set the owning side to null (unless already changed)
            if ($resultado->getEquipolocal() === $this) {
                $resultado->setEquipolocal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Resultado[]
     */
    public function getResultadosvisitante(): Collection
    {
        return $this->resultadosvisitante;
    }

    public function addResultadosvisitante(Resultado $resultadosvisitante): self
    {
        if (!$this->resultadosvisitante->contains($resultadosvisitante)) {
            $this->resultadosvisitante[] = $resultadosvisitante;
            $resultadosvisitante->setEquipovisitante($this);
        }

        return $this;
    }

    public function removeResultadosvisitante(Resultado $resultadosvisitante): self
    {
        if ($this->resultadosvisitante->contains($resultadosvisitante)) {
            $this->resultadosvisitante->removeElement($resultadosvisitante);
            // set the owning side to null (unless already changed)
            if ($resultadosvisitante->getEquipovisitante() === $this) {
                $resultadosvisitante->setEquipovisitante(null);
            }
        }

        return $this;
    }
}
