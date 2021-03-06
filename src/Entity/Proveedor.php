<?php

namespace App\Entity;

use App\Repository\ProveedorRepository;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProveedorRepository::class)]
#[ORM\HasLifecycleCallbacks()]

class Proveedor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 255)]
    private $email;

    #[ORM\Column(type: 'integer')]
    private $telefono;

    #[ORM\Column(type: 'string', length: 255,)]
    private $tipo;

    #[ORM\Column(type: 'string', length: 255)]
    private $activo;

    #[ORM\Column(type: 'datetime')]
    private $CreatedAt;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $UpdatedAt;


    /* Getters and Setters */
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelefono(): ?int
    {
        return $this->telefono;
    }

    public function setTelefono(int $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): self
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function getActivo(): ?string
    {
        return $this->activo;
    }

    public function setActivo(string $activo): self
    {
        $this->activo = $activo;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->CreatedAt;
    }

    public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    {
        $this->CreatedAt = $CreatedAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->UpdatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $UpdatedAt): self
    {
        $this->UpdatedAt = $UpdatedAt;

        return $this;
    }

    /* Utilizamos la fecha y hora actuales al a??adir un nuevo registro */
     #[ORM\PrePersist]
    public function setCreatedAtValue()
    {
        $this->CreatedAt = new \DateTime();
    }

    /* Utilizamos la fecha y hora actuales al actualizar un registro */
    #[ORM\PreUpdate]
    public function onPreUpdate()
    {
        $this->UpdatedAt = new \DateTime();
    }


    /* Validaciones de registros existentes (propiedades) */ 
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addConstraint(new UniqueEntity(['fields' => 'nombre', 'message' => 'Este nombre ya est?? siendo utilitzado']));
        $metadata->addConstraint(new UniqueEntity(['fields' => 'telefono', 'message' => 'Este tel??fono ya est?? siendo utilitzado']));
        $metadata->addConstraint(new UniqueEntity(['fields' => 'email','message' => 'Este email ya est?? siendo utilitzado']));        
    }
}
