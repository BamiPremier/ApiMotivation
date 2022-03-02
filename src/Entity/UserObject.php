<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\CreateUserObjectAction;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use App\Repository\UserObjectRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ApiResource(
 *     iri="http://schema.org/UserObject",
 *     normalizationContext={
 *         "groups"={"user_object_read"}
 *     },
 *     collectionOperations={
 *         "post"={
 *             "controller"=CreateUserObjectAction::class,
 *             "deserialize"=false,
 *             "validation_groups"={"Default", "user_object_create"},
 *             "openapi_context"={
 *                 "requestBody"={
 *                     "content"={
 *                         "multipart/form-data"={
 *                             "schema"={
 *                                 "type"="object",
 *                                 "properties"={
 *                                     "file"={
 *                                         "type"="string",
 *                                         "format"="binary"
 *                                     }
 *                                 }
 *                             }
 *                         }
 *                     }
 *                 }
 *             },
 *              "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *         },
 *         "get"={
 *              "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *          }
 *     },
 *     itemOperations={
 *         "get"={
 *              "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *          },
 *         "delete"={
 *              "security"="is_granted('IS_AUTHENTICATED_ANONYMOUSLY')"
 *          }
 *     }
 * )
 * @Vich\Uploadable
 */
class UserObject
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"user_object_read", "read:user"})
     */
    private ?int $id = null;

    /**
     * @ApiProperty(iri="http://schema.org/contentUrl")
     * @Groups({"user_object_read", "read:user" })
     */
    public ?string $contentUrl = null;

    /**
     * @Assert\NotNull(groups={"user_object_create"})
     * @Vich\UploadableField(mapping="user_object", fileNameProperty="filePath")
     */
    public ?File $file = null;

    /**
     * @ORM\Column(nullable=true)
     */
    public ?string $filePath = null;
  
    public function getId(): ?int
    {
        return $this->id;
    }

}
