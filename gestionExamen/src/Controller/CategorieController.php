<?php

namespace App\Controller;

use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api', name: 'api_') ]
class CategorieController extends AbstractController
{
        public function __construct(
            private EntityManagerInterface $manager,
        ) {
        }
    
        #[Route('/categories/{id}', methods: ['DELETE','DELETE_CATEGORIE'])]
        public function DeleteCategorie($id) : JsonResponse  {
            $categorie = $this->manager->getRepository( Categorie::class)->findOneById( $id );
            if ( $categorie ) {
                $this->manager->remove( $categorie );
                $this->manager->flush();
                return new JsonResponse(
                    [ 
                        'status'  => true,
                        'message' => 'Categorie supprimé !',
                    ],
                    200
                );
            } else {
                return new JsonResponse(
                    [ 
                        'status'  => false,
                        'message' => 'Categorie non trouvé !',
                    ],
                    500
                );
            }
        }
    
    







}
