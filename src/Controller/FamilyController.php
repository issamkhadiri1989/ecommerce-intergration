<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamilyController extends AbstractController
{
    #[Route('/family/{id}', name: 'app_family')]
    public function index(Category $category): Response
    {
        return $this->render('family/index.html.twig', [
            'category' => $category,
        ]);
    }
}
