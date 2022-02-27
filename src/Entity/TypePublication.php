<?php

namespace App\Entity;

use App\Repository\TypePublicationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TypePublicationRepository::class)
 * @ApiResource(
 * 
 * 
 * itemOperations = { 
 *  "get"
 * 
 * 
 * },collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:typepub"
 *                  }
 *              },
 * },
 * })
 */
class TypePublication
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("read:typepub","read:pub")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("read:typepub","read:pub")
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity=Publication::class, mappedBy="type_publication")
     */
    private $publications;

    public function __construct()
    {
        $this->publications = new ArrayCollection();
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
            $publication->setTypePublication($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): self
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getTypePublication() === $this) {
                $publication->setTypePublication(null);
            }
        }

        return $this;
    }
}
