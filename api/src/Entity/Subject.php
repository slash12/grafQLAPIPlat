<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity
 * @ApiResource(
 *      normalizationContext={"groups"={"subjectList"}},
 *      denormalizationContext={"groups"={"subjectCreate"}},
 *      itemOperations={"get","put"}
 * )
 */
class Subject
{
    /**
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     * @Groups({"subjectList"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     * @Groups({"subjectList", "subjectCreate"})
     */
    public $name;
    
    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="subject", cascade={"persist", "remove"})
     * @ApiSubresource()
     */
    public $lessons;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @Assert\NotBlank(groups={"subjectCreate"})
     */
    public $user;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
