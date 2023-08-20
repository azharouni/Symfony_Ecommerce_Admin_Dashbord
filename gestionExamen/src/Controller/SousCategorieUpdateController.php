<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\SousCategorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class SousCategorieUpdateController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, SousCategorie $sousCategorie): SousCategorie
    {
        $imageFile = $request->files->get('imageFile');
        if ($imageFile) {
            // If a new image file is uploaded, update the image
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->move('images/sousCategories', $imageName);
            $sousCategorie->setImage('/images/sousCategories/' . $imageName);
        }

        $sousCategorie->setName($request->request->get('name'));
        $sousCategorie->setUpdatedAt(new \DateTimeImmutable());

        $categorieId = $request->request->get('categorie_id');
        if ($categorieId) {
            $categorie = $this->entityManager->getRepository(Categorie::class)->find($categorieId);
            $sousCategorie->setCategorie($categorie);
        } else {
            $sousCategorie->setCategorie(null);
        }

        $this->entityManager->persist($sousCategorie);
        $this->entityManager->flush();

        return $sousCategorie;
    }
}
