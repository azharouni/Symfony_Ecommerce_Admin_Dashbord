<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

class CategorieResetController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/categories/{id}/reset", name="categorie_reset", methods={"PUT"})
     */
    public function resetCategorie(Request $request, int $id): Response
    {
        // Retrieve the JSON data from the request
        $data = json_decode($request->getContent(), true);

        // Find the category by its ID
        $categorie = $this->entityManager->getRepository(Categorie::class)->find($id);

        if (!$categorie) {
            // Category not found, return a JSON response with an error message
            return new JsonResponse(['message' => 'Category not found.'], Response::HTTP_NOT_FOUND);
        }

        // Update the category properties
        $categorie->setName($data['name']);
        $categorie->setImageFile($data['image']);

        // Save the changes to the database
        $this->entityManager->flush();

        // Respond with a JSON response
        return new JsonResponse(['message' => 'Category updated successfully.'], Response::HTTP_OK);
    }
}

