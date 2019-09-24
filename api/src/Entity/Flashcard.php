<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;
use ApiPlatform\Core\Annotation\ApiFilter;

/**
 * @ORM\Entity
 * @ApiResource()
 * 
 */
class Flashcard
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
    public $question;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Length(max="255")
     */
    public $answer;

    /**
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="flashcards")
     * @Assert\NotBlank()
     */
    public $lesson;

    public function __construct($id = null)
    {
        $this->id = $id;
    }

    public function getId(): ?string
    {
        return $this->id;
    }
}
