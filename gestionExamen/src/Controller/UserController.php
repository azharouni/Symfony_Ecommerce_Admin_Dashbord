<?php

namespace App\Controller;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_') ]
class UserController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {
    }

    #[Route('/users/{id}', methods: ['DELETE','HEAD'])]
    public function DeleteUser($id) : JsonResponse  {
        $userExist = $this->manager->getRepository( Users::class)->findOneById( $id );
        if ( $userExist ) {
            $this->manager->remove( $userExist );
            $this->manager->flush();
            return new JsonResponse(
                [ 
                    'status'  => true,
                    'message' => 'utilisateur supprimé !',
                ],
                200
            );
        } else {
            return new JsonResponse(
                [ 
                    'status'  => false,
                    'message' => 'utilisateur non trouvé !',
                ],
                500
            );
        }
    }

}
