<?php

namespace App\Entity;

use App\Repository\FavoryRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

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
 * @ApiFilter(
 *    SearchFilter::class, 
 *    properties={ 
 *      "id": "exact",
 *   "user": "exact","publication": "exact",
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
