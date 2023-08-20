<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CategoriUpdateController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, Categorie $categorie, CategorieRepository $categorieRepository): Categorie
    {
        // Update the name if it is not null
        $name = $request->request->get('name');
        if ($name !== null) {
            $categorie->setName($name);
        }

        // Check if a new image file was uploaded
        if ($request->files->has('imageFile')) {
            $imageFile = $request->files->get('imageFile');
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->move('images/categorie', $imageName);
            $categorie->setImage('/images/categorie/' . $imageName);
        }
        $categorie->setUpdatedAt(new \DateTimeImmutable());
        $this->entityManager->persist($categorie);
        $this->entityManager->flush();
        return $categorie;
    }
}
