<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
/* use Proxies\__CG__\App\Entity\Tag; */

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $title = null;

    #[ORM\Column(type: "text")]
    private ?string $description = null;

    #[ORM\Column(type: "text")]
    private ?string $image = null;

    #[Assert\NotBlank(message: "La couleur ne peut pas être vide.")]
    #[ORM\Column(type: "string", length: 7, nullable: true)]
    private string $colorBackCard = "#FFFFFF";

    #[ORM\ManyToMany(targetEntity: Tag::class, inversedBy: "projects")]
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

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
     * Set the value of tags
     */
    public function setTags($tags): self
    {
        $this->tags = $tags;

        return $this;
    }
    /**
     * @return Collection<int, Test>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeProject($this);
        }
        return $this;
    }



    /**
     * Get the value of description
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Set the value of description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the value of image
     */
    public function getImage(): ?string
    {
        return $this->image;
    }

    /**
     * Set the value of image
     */
    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get the value of color_backcard
     */
    public function getColorBackCard(): string
    {
        return $this->colorBackCard;
    }

    /**
     * Set the value of color_backcard
     */
    public function setColorBackCard(string $colorBackCard): self
    {
        $this->colorBackCard = $colorBackCard;

        return $this;
    }

   
}
