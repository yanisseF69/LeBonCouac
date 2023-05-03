<?php

namespace App\Entity;

use App\Repository\PhotoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhotoRepository::class)]
class Photo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'photos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Announcement $idA = null;

    #[ORM\Column(type: Types::BLOB)]
    private $photo = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdA(): ?Announcement
    {
        return $this->idA;
    }

    public function setIdA(?Announcement $idA): self
    {
        $this->idA = $idA;

        return $this;
    }

    public function getPhoto()
    {
        return $this->photo;
    }

    public function setPhoto($photo): self
    {
        $this->photo = $photo;

        return $this;
    }
}
