<?php

namespace App\Entity;

use App\Repository\SaveRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=SaveRepository::class)
 * @ORM\Table(name="`Save`")
 *  @ApiResource( itemOperations={
 *          "get"={},
 *         
 *          "delete"={}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:Save"
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
 *                      "create:Save"
 *                  }
 *              },
 *            
 *           
 *          }
 * 
 * })
 */
class Save
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:Save"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime") 
     * @Groups({"read:Save"})
     */
    private $dateSave;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="Saves") 
     * @Groups({"create:Save","read:Save"})
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="Saves")
     * 
     * @Groups({"create:Save","read:Save"})
     */
    private $user;
    public function __construct()
    {

        $this->dateSave = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateSave(): ?\DateTimeInterface
    {
        return $this->dateSave;
    }

    public function setDateSave(\DateTimeInterface $dateSave): self
    {
        $this->dateSave = $dateSave;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
