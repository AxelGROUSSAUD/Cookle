<?php


namespace App\Tests\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\Recipe;
use App\Entity\Evaluation;

class RecipeTest extends TestCase
{

    public function testcalcAverageEval()
    {
        //Create objects recipe and evaluation
        $recipe = new Recipe();
        $evaluation = new Evaluation();
        //Test without an evaluation

        $resp = $recipe->calcAverageEval();
        $this->assertEquals(-1, $resp,"Error : incorrect value");
        //Add evaluation
        $evaluation->setStar(4);
        $recipe->addEvaluation($evaluation);
        $resp = $recipe->calcAverageEval();
        //Test with an evaluation
        $this->assertEquals(4, $resp,"Error : incorrect value");
        //Add evaluation
        $evaluation->setStar(2);
        $recipe->addEvaluation($evaluation);
        $resp = $recipe->calcAverageEval();
        //Test with two evaluations
        $this->assertEquals(2, $resp,"Error : incorrect value");
    }
}