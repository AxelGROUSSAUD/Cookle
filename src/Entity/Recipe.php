<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $extrainfo;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adjustments;

    /**
     * @ORM\ManyToMany(targetEntity=Ingredient::class, inversedBy="recipes")
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=CookingHistory::class, inversedBy="recipe")
     */
    private $cookingHistory;

    /**
     * @ORM\ManyToOne(targetEntity=Evaluation::class, inversedBy="recipe")
     */
    private $evaluation;

    /**
     * @ORM\ManyToOne(targetEntity=Source::class, inversedBy="recipe")
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity=CourseType::class, inversedBy="recipe")
     */
    private $courseType;

    public function __construct()
    {
        $this->ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getExtrainfo(): ?string
    {
        return $this->extrainfo;
    }

    public function setExtrainfo(string $extrainfo): self
    {
        $this->extrainfo = $extrainfo;

        return $this;
    }

    public function getAdjustments(): ?string
    {
        return $this->adjustments;
    }

    public function setAdjustments(string $adjustments): self
    {
        $this->adjustments = $adjustments;

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        $this->ingredient->removeElement($ingredient);

        return $this;
    }

    public function getCookingHistory(): ?CookingHistory
    {
        return $this->cookingHistory;
    }

    public function setCookingHistory(?CookingHistory $cookingHistory): self
    {
        $this->cookingHistory = $cookingHistory;

        return $this;
    }

    public function getEvaluation(): ?Evaluation
    {
        return $this->evaluation;
    }

    public function setEvaluation(?Evaluation $evaluation): self
    {
        $this->evaluation = $evaluation;

        return $this;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getCourseType(): ?CourseType
    {
        return $this->courseType;
    }

    public function setCourseType(?CourseType $courseType): self
    {
        $this->courseType = $courseType;

        return $this;
    }
    public function calcAverageEval(): float{


    }
}
