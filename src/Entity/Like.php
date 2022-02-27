<?php

namespace App\Entity;

use App\Repository\LikeRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=LikeRepository::class)
 * @ORM\Table(name="`like`")
 *  @ApiResource( itemOperations={
 *          "get"={},
 *         
 *          "delete"={}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:like"
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
 *                      "create:like"
 *                  }
 *              },
 *            
 *           
 *          }
 * 
 * })
 */
class Like
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:like"})
     */
    private $id;

    /**
     * @ORM\Column(type="datetime") 
     * @Groups({"read:like"})
     */
    private $dateLike;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="likes") 
     * @Groups({"create:like","read:like"})
     */
    private $publication;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="likes")
     * 
     * @Groups({"create:like","read:like"})
     */
    private $user;
    public function __construct()
    {

        $this->dateLike = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateLike(): ?\DateTimeInterface
    {
        return $this->dateLike;
    }

    public function setDateLike(\DateTimeInterface $dateLike): self
    {
        $this->dateLike = $dateLike;

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
