<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 70)]
    private ?string $title = null; // "HTML", "CSS", "Symfony", "Gestion de projet"

    #[ORM\ManyToMany(inversedBy: "tags", targetEntity: Project::class)]
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
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
     * @return Collection<int, Todo>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    /**
     * Set the value of projects
     */
    public function setProjects($projects): self
    {
        $this->projects = $projects;

        return $this;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->addTag($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            $project->removeTag($this);
        }
        return $this;
    }
    public function __toString(): string
    {
        // Remplacez $this->name par la propriété que vous voulez utiliser pour représenter cette entité sous forme de chaîne.
        // Par exemple, si votre entité Skill a une propriété "name", vous pouvez utiliser $this->name.
        return $this->title;
        
    }

}
