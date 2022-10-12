<?php

namespace App\Controller;

use App\Entity\Category;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{

    #[Route('/category', name: 'index_category')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $categories = $doctrine->getRepository(Category::class)->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories
        ]);

    }

    #[Route('/create_category', name: 'create_category')]
    public function create(): Response
    {

        return $this->render('category/create.html.twig', [
            'controller_name' => 'CategoryController'
        ]);

    }

    #[Route('/store_category', name: 'store_category')]
    public function store(ManagerRegistry $doctrine): Response
    {

        if(!isset($_POST)) {
            $error = 'Ошибка запроса';
            $this->render('category/create.html.twig', [
                'error' => $error
            ]);
        }

        $name = $_POST['name'];
        $created_at = new \DateTime();

        $category = new Category();
        $category->setName($name);
        $category->setCreatedAt($created_at);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($category);
        $entityManager->flush();

        $success = 'Категория успешно добавлена';

        return $this->render('category/create.html.twig', [
            'controller_name' => 'CategoryController',
            'success' => $success
        ]);

    }

    #[Route('/edit_category/{id}', name: 'edit_category')]
    public function edit(ManagerRegistry $doctrine, int $id): Response
    {

        $category = $doctrine->getRepository(Category::class)->find($id);

        return $this->render('category/edit.html.twig', [
            'controller_name' => 'CategoryController',
            'category' => $category
        ]);

    }

    #[Route('/update_category', name: 'update_category')]
    public function update(ManagerRegistry $doctrine, int $id): Response
    {

        $entityManager = $doctrine->getManager();
        $category = $entityManager->getRepository(Category::class)->find($id);

        if(!isset($_POST)) {
            $error = 'Ошибка запроса';
            $this->render('category/edit.html.twig', [
                'error' => $error
            ]);
        }

        $name = $_POST['name'];
        $created_at = new \DateTime();

        $category->setName($name);
        $category->setCreatedAt($created_at);
        $entityManager->flush();

        $success = 'Категория успешно добавлена';

        return $this->render('category/edit.html.twig', [
            'controller_name' => 'CategoryController',
            'success' => $success
        ]);

    }
    
}
