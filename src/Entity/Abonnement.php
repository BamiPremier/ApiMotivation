<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 * @ApiResource(collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:abonnemnt"
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
 *                      "create:abonnemnt"
 *                  }
 *              },
 *            
 *           
 *          }
 * 
 * })
 */
class Abonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:abonnemnt"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:abonnemnt"})
     */
    private $dateAbonnement;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="abonnements")
     * @Groups({"create:abonnemnt","read:abonnemnt"})
     */
    private $user;
    public function __construct()
    {

        $this->dateAbonnement = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAbonnement(): ?\DateTimeInterface
    {
        return $this->dateAbonnement;
    }

    public function setDateAbonnement(\DateTimeInterface $dateAbonnement): self
    {
        $this->dateAbonnement = $dateAbonnement;

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
