<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserUpdateController
{
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function __invoke(Request $request, Users $user): Users
    {
       // $user->setEmail($request->request->get('email'));
        $user->setFname($request->request->get('fname'));
        $user->setLname($request->request->get('lname'));
        $user->setNumTel((int)$request->request->get('numTel'));
      //  $user->setRoles((array)$request->request->get('roles'));

      $email = $request->request->get('email');
      if (!empty($email)) {
          $user->setEmail($email);
      }
      

/*
      $codeP = $request->request->get('codeP');
      if (!empty($codeP)) {
          $user->setCodeP($codeP);
      }
      
      $pay = $request->request->get('pay');
      if (!empty($pay)) {
          $user->setPay($pay);
      }


      $adresse2 = $request->request->get('adresse2');
      if (!empty($adresse2)) {
          $user->setAdresse2($adresse2);
      }*/



      
      
      
     


        $password = $request->request->get('password');
        if (!empty($password)) {
            $hashedPassword = $this->passwordHasher->hashPassword($user, $password);
            $user->setPassword($hashedPassword);
        }


       


        $addresses = $user->getAdresse();
        if (count($addresses) > 0) {
            $address = $addresses[0]; // Assuming only one address is associated with the user
        } else {
            $address = new Adresse();
            $user->addAdresse($address);
        }
        $codeP=(int)$request->request->get('codeP');
        $address->setCodeP($codeP);


        
        if (!empty($request->request->get('adresse2')))
        {
        $adresse2=$request->request->get('adresse2');
        $address->setAdresse2($adresse2);
        }
        if (!empty($request->request->get('pay')))
        {
        $pay=$request->request->get('pay');
        $address->setPay($pay);
        }





        $address->setAdresse1($request->request->get('adresse1'));
        //$address->setAdresse2($request->request->get('adresse2'));
       // $address->setPay($request->request->get('pay'));
        
        $address->setVille($request->request->get('ville'));



       


   
        $this->entityManager->persist($user);

        $this->entityManager->persist($address);
        $this->entityManager->flush();

        return $user;
    }
}
