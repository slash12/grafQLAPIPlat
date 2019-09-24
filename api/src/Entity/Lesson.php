<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiSubresource;

/**
 * @ORM\Entity
 * @ApiResource(
 *      normalizationContext={"groups"={"lessonList"}},
 *      denormalizationContext={"groups"={"lessonCreate"}},
 *      itemOperations={"get","put"}
 * )
 */
class Lesson
{
    /**
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    public $name;

    /**
     * @ORM\OneToMany(targetEntity="Flashcard", mappedBy="lesson", cascade={"persist", "remove"})
     * @ApiSubresource()
     */
    public $flashcards;

    /**
     * @ORM\ManyToOne(targetEntity="Subject", inversedBy="lessons")
     * @Assert\NotBlank()
     */
    public $subject;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
