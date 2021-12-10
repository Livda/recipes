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
    #[Route('/{id}/delete', name: 'delete', methods: ['GET'])]
    public function delete(Recipe $recipe): Response
    {
        return $this->render('recipe/delete.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/delete-confirmed', name: 'delete-confirmed', methods: ['GET'])]
    public function deleteConfirmed(Recipe $recipe, RemoveRecipeHandler $handler): Response
    {
        /** @var int $id */
        $id = $recipe->getId();
        $handler->byId(new RemoveRecipeById($id));

        $this->addFlash('success', sprintf('La recette %s a bien été supprimée.', $recipe->getName()));

        return $this->redirectToRoute('app_recipe_index');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/{id}/edit', name: 'edit', methods: ['GET'])]
    public function edit(Recipe $recipe): Response
    {
        return $this->redirectToRoute('app_recipe_index');
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/save', name: 'save')]
    public function save(Request $request, SaveRecipeHandler $handler): Response
    {
        if ($this->isCsrfTokenValid('recipe', (string) $request->request->get('_token'))) {
            throw new BadRequestException('Invalid CSRF token provided');
        }

        try {
            $recipe = $handler->byForm(new SaveRecipeByForm(
                name: $request->request->get('name'),
                diet: $request->request->get('diet'),
                season: $request->request->get('season'),
                url: $request->request->get('url'),
            ));
        } catch (Exception $e) {
        }

        return $this->redirectToRoute('app_recipe_index');
    }

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
