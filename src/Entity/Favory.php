<?php

namespace App\Entity;

use App\Repository\FavoryRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=FavoryRepository::class)
 * @ApiResource( itemOperations={
 *          "get"={}, 
 *          "delete"={}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:favory"
 *                  }
 *              },
 * 
 * 
 * 
 * 
 * },
 *    "post"={
 *              "denormalization_context"={
 *                  "groups"={
 *                      "create:favory"
 *                  }
 *              },
 *            
 *           
 *          }
 * 
 * })
 */
class Favory
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:favory"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="favories")
     * @Groups({"create:favory","read:favory"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="favories")
      * @Groups({"create:favory","read:favory"})
     */
    private $publication;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreate;
    public function __construct()
    {

        $this->dateCreate = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getPublication(): ?Publication
    {
        return $this->publication;
    }

    public function setPublication(?Publication $publication): self
    {
        $this->publication = $publication;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeInterface
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeInterface $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }
}
