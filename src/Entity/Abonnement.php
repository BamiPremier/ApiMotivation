<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\ExistsFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\BooleanFilter;

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
 * 
 * @ApiFilter(
 *    SearchFilter::class, 
 *    properties={ 
 *       "id": "exact",
 *      "user": "exact",
 *     
 * }
 *)
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

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="abonnes")
     * @Groups({"create:abonnemnt","read:abonnemnt"})
     */
    private $users;

    public function __construct()
    {

        $this->dateAbonnement = new \DateTime();
        $this->users = new ArrayCollection();
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

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users[] = $user;
            $user->setAbonnes($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAbonnes() === $this) {
                $user->setAbonnes(null);
            }
        }

        return $this;
    }
}
