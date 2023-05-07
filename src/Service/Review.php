<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class Review
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function saveFeedback(Product $product, int $note): void
    {
        // ... do something to the $product

        $this->manager->persist($product);
        $this->manager->flush();
    }
}
