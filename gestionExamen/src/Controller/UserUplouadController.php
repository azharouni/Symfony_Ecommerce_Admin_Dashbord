<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserUplouadController
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(Request $request): Users
    {
        $produit = new Users();

        $produit->setEmail($request->request->get('email'));
        $produit->setFname($request->request->get('fname') ?? '');
        $produit->setLname($request->request->get('lname') ?? '');
        $produit->setNumTel((int)$request->request->get('numTel') ?? '');
        $produit->setRoles((array)$request->request->get('roles') ?? '');

        $hashedPassword = $this->passwordHasher->hashPassword($produit, $request->request->get('password'));
        $produit->setPassword($hashedPassword);

        $detail = new Adresse();

        $detail->setAdresse1($request->request->get('adresse1') ?? '');
        $detail->setAdresse2($request->request->get('adresse2') ?? '');
        $detail->setPay($request->request->get('pay') ?? '');
        $detail->setCodeP((int)$request->request->get('codeP') ?? '');
        $detail->setVille($request->request->get('ville') ?? '');

        $produit->addAdresse($detail);
        $this->entityManager->persist($produit);
        $this->entityManager->persist($detail);
        $this->entityManager->flush();

        return $produit;
    }
}
