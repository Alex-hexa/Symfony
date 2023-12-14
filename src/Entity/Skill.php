<?php

namespace App\Entity;

use App\Repository\SkillRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: SkillRepository::class)]
class Skill
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $title = null; // "HTML", "CSS", "Symfony", "Gestion de projet"

    #[Assert\NotBlank(message: "Le taux ne peut pas être vide.")]
    #[ORM\Column]
    private int $rate;

    #[Assert\NotBlank(message: "La couleur ne peut pas être vide.")]
    #[ORM\Column(type:"string", length: 7, nullable: true)]
    private string $color = "red";

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the value of rate
     */
    public function getRate(): int
    {
        return $this->rate;
    }

    /**
     * Set the value of rate
     */
    public function setRate(int $rate): self
    {
        $this->rate = $rate;

        return $this;
    }

    /**
     * Get the value of color
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * Set the value of color
     */
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }
}
