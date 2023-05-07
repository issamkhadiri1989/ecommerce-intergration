<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\NewsLetterSubscription;
use App\Form\Type\NewsLetterSubscriptionType;
use App\Repository\CategoryRepository;
use App\Service\NewsLetter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function homeIndex(CategoryRepository $repository, Request $request, NewsLetter $newsLetter): Response
    {
        $categories = $repository->findAll();

        $newsLetterSubscription = new NewsLetterSubscription();

        $form = $this->createForm(NewsLetterSubscriptionType::class, $newsLetterSubscription);

       /* $form = $this->createFormBuilder($newsLetterSubscription)
            ->add('subscriptionEmail', EmailType::class, [
                'label' => false,
                'attr' => [
                    'class' => 'form-control form-control-lg',
                    'placeholder' => 'Enter your email address',
                    'aria-describedby' => 'button-addon2', 
                ],
            ])
            ->add('submitSubscription', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-dark',
                ],
            ])
            ->getForm();*/

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /*$data = $form->get('subscriptionEmail')->getData();*/
            $newsLetter->subscribeToNewsLetter($newsLetterSubscription);
            // do something with $data like storing it in the database
            /*dump($newsLetterSubscription);*/
        }

        return $this->render('home/index.html.twig', [
            'categories' => $categories,
            'form' => $form->createView(),
        ]);
    }
}
