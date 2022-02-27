<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\UserCreateController;

use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 * @ApiResource(itemOperations={
 *          "get"={},
 *          "patch"={
 *              "denormalization_context"={
 *                  "groups"={
 *                     "create:user"
 *                  }
 *              },
 * "controller"=UserCreateController::class
 *             },
 *          "delete"={}
 *     },
 * collectionOperations = { 
 * 
 * 
 * "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:user"
 *                  }
 *   }
 * },
 *    "post" = {
 *          "denormalization_context"={
 *                  "groups"={
 *                      "create:user"
 *                  }
 *              },
 *              "controller"=UserCreateController::class
 *              }
 * }
 * 
 * )
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     *  @Groups({"read:user","read:message","read:comment","read:favory","read:like","read:partage"})
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"create:user","read:user","read:message","read:comment","read:favory","read:like","read:partage"})
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     *  @Groups({"create:user"})
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"create:user","read:user","read:message","read:comment","read:favory","read:like","read:partage"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *  @Groups({"create:user","read:user","read:message","read:comment","read:favory","read:like","read:partage"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255,unique=true ,nullable=true)
     *  @Groups({"create:user","read:user","read:message","read:comment","read:favory","read:like","read:partage"})
     */
    private $numero;

    /**
     * @ORM\Column(type="string", length=255)
     *
     */
    private $code;

    /**
     * @ORM\Column(type="boolean")
     */
    private $status;



    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity=Favory::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $favories;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $publications;
    /**
     * @ORM\OneToMany(targetEntity=Partage::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $partages;
    /**
     * @ORM\OneToMany(targetEntity=Abonnement::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $abonnements;

    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $likes;


    /**
     * @ORM\OneToMany(targetEntity=Like::class, mappedBy="user")
     * @Groups({"read:user"})
     */
    private $saves;

    /**
     * @ORM\OneToMany(targetEntity=Message::class, mappedBy="emetteur")
     *@Groups({"read:user",})
     */
    private $messages;


    public function __construct()
    {
        $this->setCode();
        $this->setStatus(false);


        $this->comments = new ArrayCollection();
        $this->favories = new ArrayCollection();
        $this->publications = new ArrayCollection();
        $this->abonnements = new ArrayCollection();
        $this->likes = new ArrayCollection();
        $this->saves = new ArrayCollection();
        $this->partages = new ArrayCollection();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(?string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(): self
    {


        $listPossible = array(
            "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'
        );
        shuffle($listPossible);


        $this->code =   $listPossible[0] . $listPossible[1]
            . $listPossible[2] . $listPossible[3]
            . $listPossible[4] . $listPossible[5];

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

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
            $comment->setUser($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUser() === $this) {
                $comment->setUser(null);
            }
        }

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
            $favory->setUser($this);
        }

        return $this;
    }

    public function removeFavory(Favory $favory): self
    {
        if ($this->favories->removeElement($favory)) {
            // set the owning side to null (unless already changed)
            if ($favory->getUser() === $this) {
                $favory->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Publication[]
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): self
    {
        if (!$this->publications->contains($publication)) {
            $this->publications[] = $publication;
            $publication->setUser($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getUser() === $this) {
                $publication->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Abonnement[]
     */
    public function getAbonnements(): Collection
    {
        return $this->abonnements;
    }

    public function addAbonnement(Abonnement $abonnement): self
    {
        if (!$this->abonnements->contains($abonnement)) {
            $this->abonnements[] = $abonnement;
            $abonnement->setUser($this);
        }

        return $this;
    }

    public function removeAbonnement(Abonnement $abonnement): self
    {
        if ($this->abonnements->removeElement($abonnement)) {
            // set the owning side to null (unless already changed)
            if ($abonnement->getUser() === $this) {
                $abonnement->setUser(null);
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
            $like->setUser($this);
        }

        return $this;
    }

    public function removeLike(Like $like): self
    {
        if ($this->likes->removeElement($like)) {
            // set the owning side to null (unless already changed)
            if ($like->getUser() === $this) {
                $like->setUser(null);
            }
        }

        return $this;
    }


    /**
     * @return Collection|Save[]
     */
    public function getSave(): Collection
    {
        return $this->likes;
    }

    public function addSave(Save $save): self
    {
        if (!$this->saves->contains($save)) {
            $this->saves[] = $save;
            $save->setUser($this);
        }

        return $this;
    }

    public function removeSave(Save $save): self
    {
        if ($this->saves->removeElement($save)) {
            // set the owning side to null (unless already changed)
            if ($save->getUser() === $this) {
                $save->setUser(null);
            }
        }

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
            $partage->setUser($this);
        }

        return $this;
    }

    public function removePartage(Partage $partage): self
    {
        if ($this->partages->removeElement($partage)) {
            // set the owning side to null (unless already changed)
            if ($partage->getUser() === $this) {
                $partage->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Message[]
     */
    public function getMessages(): Collection
    {
        return $this->messages;
    }

    public function addMessage(Message $message): self
    {
        if (!$this->messages->contains($message)) {
            $this->messages[] = $message;
            $message->setEmetteur($this);
        }

        return $this;
    }

    public function removeMessage(Message $message): self
    {
        if ($this->messages->removeElement($message)) {
            // set the owning side to null (unless already changed)
            if ($message->getEmetteur() === $this) {
                $message->setEmetteur(null);
            }
        }

        return $this;
    }
}
