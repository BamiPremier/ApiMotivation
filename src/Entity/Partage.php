<?php

namespace App\Entity;

use App\Repository\PartageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PartageRepository::class)
 * @ApiResource( itemOperations={
 *          "get"={ "security"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *          
 *          "delete"={ "security"="is_granted('IS_AUTHENTICATED_FULLY')"}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:partage"
 *                  }
 *              }, "security"="is_granted('IS_AUTHENTICATED_FULLY')"
 * },
 * "post"={
 *              "denormalization_context"={
 *                  "groups"={
 *                      "create:partage"
 *                  }
 *              },
 *             "security"="is_granted('IS_AUTHENTICATED_FULLY')"
 *           
 *          }
 * })
 */
class Partage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:partage"})
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="partages")
     * @Groups({"create:partage","read:partage"})
     *  */
    private $publication;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:partage"})
     */
    private $datePartage;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="partages")
     * @Groups({"create:partage","read:partage"})
     */
    private $user;


    public function __construct()
    {

        $this->datePartage = new \DateTime();
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

    public function getDatePartage(): ?\DateTimeInterface
    {
        return $this->datePartage;
    }

    public function setDatePartage(\DateTimeInterface $datePartage): self
    {
        $this->datePartage = $datePartage;

        return $this;
    }
}
