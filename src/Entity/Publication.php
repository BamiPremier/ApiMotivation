<?php

namespace App\Entity;

use App\Repository\PublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PublicationRepository::class)
 * @ApiResource( itemOperations={
 *          "get"={},
 *          "patch"={
 *              "denormalization_context"={
 *                  "groups"={
 *                     "create:pub"
 *                  }
 *              },
 *             },
 *          "delete"={}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:pub"
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
 *                      "create:pub"
 *                  }
 *              },
 *            
 *           
 *          }
 * 
 * })
 */
class Publication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"create:pub","read:pub","read:comment","read:favory","read:like","read:partage"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:pub","read:comment","read:favory","read:like","read:partage"})
     */
    private $dateCreate;

    /**
     * @ORM\OneToMany(targetEntity=Favory::class, mappedBy="publication")
     * @Groups({"read:pub"})
     */
    private $favories;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="publication")
     * @Groups({"read:pub"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="publication")
     * @Groups({"read:pub"})
     */
    private $likes;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="publications")
     * @Groups({"create:pub", "read:pub"})
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=TypePublication::class, inversedBy="publications")
     * @Groups({"create:pub", "read:pub"})
     */
    private $typePublication;

    /**
     * @ORM\OneToMany(targetEntity=Partage::class, mappedBy="publication")
     * @Groups({"read:pub"})
     */
    private $partages;

    public function __construct()
    {
        $this->messages = new ArrayCollection();
        $this->favories = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->partages = new ArrayCollection();
        $this->dateCreate = new \DateTime();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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

    /**
     * @return Collection|Favory[]
     */
    public function getFavories(): Collection
    {
        return $this->favories;
    }

    public function addFavory(Favory $favory): self
    {
        if (!$this->favories->contains($favory)) {
            $this->favories[] = $favory;
            $favory->setPublication($this);
        }

        return $this;
    }

    public function removeFavory(Favory $favory): self
    {
        if ($this->favories->removeElement($favory)) {
            // set the owning side to null (unless already changed)
            if ($favory->getPublication() === $this) {
                $favory->setPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setPublication($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getPublication() === $this) {
                $comment->setPublication(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Like[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Like $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setPublication($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getPublication() === $this) {
                $like->setPublication(null);
            }
        }

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

    public function getTypePublication(): ?TypePublication
    {
        return $this->typePublication;
    }

    public function setTypePublication(?TypePublication $typePublication): self
    {
        $this->typePublication = $typePublication;

        return $this;
    }

    /**
     * @return Collection|Partage[]
     */
    public function getPartages(): Collection
    {
        return $this->partages;
    }

    public function addPartage(Partage $partage): self
    {
        if (!$this->partages->contains($partage)) {
            $this->partages[] = $partage;
            $partage->setPublication($this);
        }

        return $this;
    }

    public function removePartage(Partage $partage): self
    {
        if ($this->partages->removeElement($partage)) {
            // set the owning side to null (unless already changed)
            if ($partage->getPublication() === $this) {
                $partage->setPublication(null);
            }
        }

        return $this;
    }
}