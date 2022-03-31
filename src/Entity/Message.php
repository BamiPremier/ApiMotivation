<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=MessageRepository::class)
 * @ApiResource(
 *  itemOperations={
 *          "get"={ "security"="is_granted('IS_AUTHENTICATED_FULLY')"},
 *          "patch"={
 *              "denormalization_context"={
 *                  "groups"={
 *                     "modify:message"
 *                  }
 *              }, "security"="is_granted('IS_AUTHENTICATED_FULLY')"
 *             },
 *          "delete"={ "security"="is_granted('IS_AUTHENTICATED_FULLY')"}
 *     },
 * collectionOperations = { "get" = {
 * "normalization_context"={
 *                  "groups"={
 *                      "read:message"
 *                  }
 *              },
 *  "security"="is_granted('IS_AUTHENTICATED_FULLY')"
 * 
 * 
 * 
 * },
 *    "post"={
 *              "denormalization_context"={
 *                  "groups"={
 *                      "create:message"
 *                  }
 *              },
 *            
 *            "security"="is_granted('IS_AUTHENTICATED_FULLY')"
 *          }
 * 
 * })
 */
class Message
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read:message"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"create:message","read:message", "modify:message"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"read:message"})
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="boolean")
     * @Groups({"read:message"})
     */
    private $status;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="messages")
     * @Groups({"create:message","read:message"})
     */
    private $emetteur;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="messages")
     * @Groups({"create:message","read:message"})
     */
    private $recepteur;

    

    public function __construct()
    {
        
        $this->dateCreate = new \DateTime();
        $this->status = 0;
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

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getEmetteur(): ?User
    {
        return $this->emetteur;
    }

    public function setEmetteur(?User $emetteur): self
    {
        $this->emetteur = $emetteur;

        return $this;
    }

    public function getRecepteur(): ?User
    {
        return $this->recepteur;
    }

    public function setRecepteur(?User $recepteur): self
    {
        $this->recepteur = $recepteur;

        return $this;
    }

     
    

    
}
