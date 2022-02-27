<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 * @ApiResource( 
 * itemOperations={
 *          "get"={},
 *          "patch"={
 *              "denormalization_context"={
 *                  "groups"={
 *                     "create:comment"
 *                  }
 *              },
 *             },
 *          "delete"={}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:comment"
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
 *                      "create:comment"
 *                  }
 *              },
 *            
 *           
 *          }
 * 
 * })
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:comment"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     *  @Groups({"create:comment","read:comment"})
     */
    private $libelle;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="comments")
     * @Groups({"create:comment","read:comment"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Publication::class, inversedBy="comments")
     * @Groups({"create:comment","read:comment"})
     */
    private $publication;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateComment;
    public function __construct()
    {

        $this->dateComment = new \DateTime();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
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

    public function getDateComment(): ?\DateTimeInterface
    {
        return $this->dateComment;
    }

    public function setDateComment(\DateTimeInterface $dateComment): self
    {
        $this->dateComment = $dateComment;

        return $this;
    }
}
