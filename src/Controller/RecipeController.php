<?php

namespace App\Controller;

use App\Action\Recipe\RemoveRecipeById;
use App\Action\Recipe\SaveRecipeByForm;
use App\Entity\Recipe;
use App\Handler\Recipe\RemoveRecipeHandler;
use App\Handler\Recipe\SaveRecipeHandler;
use App\Repository\RecipeRepository;
use Exception;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route('/new', name: 'new', methods: ['GET'])]
    public function newOrEdit(
        ?Recipe $recipe = null,
    ): Response {
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
                name: (string) $request->request->get('name'),
                diet: (string) $request->request->get('diet'),
                season: (string) $request->request->get('season'),
                url: (string) $request->request->get('url'),
                note: (string) $request->request->get('note'),
                id: (string) $request->request->get('id'),
            ));
        } catch (Exception $e) {
            $this->addFlash('danger', sprintf('Une erreur est survenue lors de la création de la recette %s', $request->request->get('name')));

            return $this->redirectToRoute('app_recipe_new');
        }

        $this->addFlash('success', sprintf('La recette %s a été créée avec succès', $recipe->getName()));

        return $this->redirectToRoute('app_recipe_index');
    }

    #[Route('/', name: 'index')]
    public function index(RecipeRepository $repository, Request $request): Response
    {
        $nbItemsPerPage = 5;
        $totalCount = $repository->count([]);
        $pageCount = (int) ceil($totalCount / $nbItemsPerPage);
        $current = 1;
        if ($request->query->has('page')) {
            $current = $request->query->getInt('page');
        }

        if ($pageCount < $current) {
            $current = $pageCount;
        }

        $pageRange = 3;
        $delta = ceil($pageRange / 2);

        if ($current - $delta > $pageCount - $pageRange) {
            $pages = range($pageCount - $pageRange + 1, $pageCount);
        } else {
            if ($current - $delta < 0) {
                $delta = $current;
            }

            $offset = $current - $delta;
            $pages = range($offset + 1, $offset + $pageRange);
        }

        $proximity = floor($pageRange / 2);

        $startPage = $current - $proximity;
        $endPage = $current + $proximity;

        if ($startPage < 1) {
            $endPage = min($endPage + (1 - $startPage), $pageCount);
            $startPage = 1;
        }

        if ($endPage > $pageCount) {
            $startPage = max($startPage - ($endPage - $pageCount), 1);
            $endPage = $pageCount;
        }

        $previous = null;
        if ($current > 1) {
            $previous = $current - 1;
        }

        $next = null;
        if ($current < $pageCount) {
            $next = $current + 1;
        }

        $recipes = $repository->findBy(
            criteria: [],
            orderBy: ['name' => 'ASC'],
            limit: $nbItemsPerPage,
            offset: max(0, $current - 1) * $nbItemsPerPage,
        );

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'pageCount' => $pageCount,
            'startPage' => $startPage,
            'current' => $current,
            'route' => 'app_recipe_index',
            'query' => [],
            'endPage' => $endPage,
            'pageParameterName' => 'page',
            'pagesInRange' => $pages,
            'previous' => $previous,
            'next' => $next,
        ]);
    }
}
