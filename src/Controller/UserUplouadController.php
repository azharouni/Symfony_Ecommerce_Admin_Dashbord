<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserUplouadController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(Request $request): Users
{
    $produit = new Users();

    $produit->setEmail($request->request->get('email'));
    $produit->setFname($request->request->get('fname'));
    $produit->setLname($request->request->get('lname'));
    $produit->setNumTel((int)$request->request->get('numTel'));
    $produit->setPassword($request->request->get('password'));

    $detail = new Adresse();
    $detail->setAdresse1($request->request->get('adresse1'));
    $detail->setAdresse2($request->request->get('adresse2'));
    $detail->setPay($request->request->get('pay'));
    $detail->setCodeP((int)$request->request->get('codeP'));
    $detail->setVille($request->request->get('ville'));

    $produit->addAdresse($detail);

    $this->entityManager->persist($produit);
    $this->entityManager->persist($detail);
    $this->entityManager->flush();

    return $produit;
}

 
}