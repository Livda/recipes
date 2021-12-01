<?php

namespace App\Controller;

use App\Action\Recipe\RemoveRecipeById;
use App\Action\Recipe\SaveRecipeByForm;
use App\Entity\Recipe;
use App\Handler\Recipe\RemoveRecipeHandler;
use App\Handler\Recipe\SaveRecipeHandler;
use App\Repository\RecipeRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;

#[Route('/recipes', name: 'app_recipe_')]
class RecipeController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/delete/{id}', name: 'delete', methods: ['GET'])]
    public function delete(Recipe $recipe): Response
    {
        return $this->render('recipe/delete.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/delete-confirmed/{id}', name: 'delete-confirmed', methods: ['GET'])]
    public function deleteConfirmed(Recipe $recipe, RemoveRecipeHandler $handler): Response
    {
        $handler->byId(new RemoveRecipeById($recipe->getId()));

        $this->addFlash('success', sprintf('La recette %s a bien été supprimée.', $recipe->getName()));

        return $this->redirectToRoute('app_recipe_index');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/save', name: 'save')]
    public function save(Request $request, SaveRecipeHandler $handler): Response
    {
        if ($this->isCsrfTokenValid('recipe', $request->request->get('_token'))) {
            throw new BadRequestException('Invalid CSRF token provided');
        }

        try {
            $recipe = $handler->byForm(new SaveRecipeByForm(
                name: $request->request->get('name'),
                diet: $this->request->get('diet'),
                season: $this->request->get('season'),
                url: $this->request->get('url'),
            ));
        } catch (Exception $e) {
        }

        return $this->redirectToRoute('app_recipe_index');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'index')]
    public function index(RecipeRepository $repository): Response
    {
        $recipes = $repository->findBy(
            criteria: [],
            orderBy: ['name' => 'ASC'],
        );

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
        ]);
    }
}
