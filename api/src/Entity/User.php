<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity()
 * @ORM\Table(name="`user`")
 * @UniqueEntity("email")
 * @ApiResource(
 *      normalizationContext={"groups"={"userList"}},
 *      denormalizationContext={"groups"={"userCreate"}},
 *      validationGroups="userCreate",
 *      itemOperations={
 *         "get",
 *         "put",
 *         "changePassword"={
 *              "method"="PUT",
 *              "path"="/users/{id}/change-password",
 *              "denormalization_context"={"groups"={"userChangePassword"}},
 *              "validation_groups"={"userChangePassword"},
 *              "swagger_context"={
 *                  "summary" = "Change user password"
 *              }
 *          }
 *      }
 * )
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="string", length=36)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(groups={"userCreate"})
     * @Assert\Length(max="255", groups={"userCreate"})
     */
    public $name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email(groups={"userCreate"})
     * @Assert\NotBlank(groups={"userCreate"})
     * @Assert\Length(max="255", groups={"userCreate"})
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=64)
     */
    public $password;

    /**
     * @ORM\Column(type="json_array")
     */
    public $roles;

    /**
     * @Assert\NotBlank(groups={"userCreate", "userChangePassword"})
     * @Assert\Length(min="8", max="255", groups={"userCreate", "userChangePassword"})
     * @Groups({"userCreate", "userChangePassword"})
     */
    public $plainPassword;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->name;
    }

    public function eraseCredentials()
    {
        $this->plainPassword = null;
    }
}
