<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiFilter;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;

/**
 * @ApiResource
 * @ApiFilter(SearchFilter::class, properties={"id": "exact", "title": "partial"})
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
     * @ORM\OneToMany(targetEntity=Evaluation::class, mappedBy="recipe", orphanRemoval=true)
     */
    private $evaluations;

    public function __constructEval()
    {
        $this->evaluations = new ArrayCollection();
    }
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
        $this->evaluations = new ArrayCollection();
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

    /**
     * @return Collection|Evaluation[]
     */
    public function getEvaluations(): Collection
    {
        return $this->evaluations;
    }

    public function addEvaluation(Evaluation $evaluation): self
    {
        if (!$this->evaluations->contains($evaluation)) {
            $this->evaluations[] = $evaluation;
            $evaluation->setRecipe($this);
        }

        return $this;
    }

    public function removeEvaluation(Evaluation $evaluation): self
    {
        if ($this->evaluations->removeElement($evaluation)) {
            // set the owning side to null (unless already changed)
            if ($evaluation->getRecipe() === $this) {
                $evaluation->setRecipe(null);
            }
        }

        return $this;
    }
    public function calcAverageEval(): float
    {
         $nbevaluation = 0 ;
        $totalevaluation = 0;
        $avgrecipe = 0;
        foreach ($this->evaluations as $valeur)
        {

            $totalevaluation+= $valeur->getStar();
            $nbevaluation++;
        }
         if ($nbevaluation == 0)
         {
              $avgrecipe = -1;
         }
        else
        {
            $avgrecipe = $totalevaluation / $nbevaluation ;
        }
    return $avgrecipe;
    }
}
