<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\Detail;
use App\Entity\SousCategorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class ProductUpdateController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request, Produit $produit): Produit
    {
        $imageFile = $request->files->get('imageFile');
        if ($imageFile) {
            // If a new image file is uploaded, update the image
            $imageName = $imageFile->getClientOriginalName();
            $imageFile->move('images/produits', $imageName);
            $produit->setImage('/images/produits/' . $imageName);
        }

        $produit->setName($request->request->get('name'));
        $produit->setPrix($request->request->get('prix'));
        $produit->setUpdatedAt(new \DateTimeImmutable());

        $categorieId = $request->request->get('categorie_id');
        if ($categorieId) {
            $categorie = $this->entityManager->getRepository(Categorie::class)->find($categorieId);
            $produit->setCategorie($categorie);
        } else {
            $produit->setCategorie(null);
        }

        $souscategorieId = $request->request->get('souscategorie_id');
        if ($souscategorieId) {
            $souscategorie = $this->entityManager->getRepository(SousCategorie::class)->find($souscategorieId);
            $produit->setSouscategorie($souscategorie);
        } else {
            $produit->setSouscategorie(null);
        }

        $details = $produit->getDetails();
        if (count($details) > 0) {
            $detail = $details[0]; // Assuming only one detail is associated with the product
        } else {
            $detail = new Detail();
            $produit->addDetail($detail);
        }

        $detail->setDescription($request->request->get('description'));
        $detail->setSize([$request->request->get('size')]);

        $detail->setStock($request->request->get('stock'));
        $detail->setStock1((int)$request->request->get('stock1'));
        $color = $request->request->get('color');
        $detail->setColor([$color]);

        $this->entityManager->persist($produit);
        $this->entityManager->persist($detail);
        $this->entityManager->flush();

        return $produit;
    }
}
