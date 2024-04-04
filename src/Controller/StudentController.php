<?php

namespace App\Controller;

use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class StudentController extends AbstractController
{
    #[Route('/add-student/{id}', name: 'add_student')]
    public function addStudent(Request $request, EntityManagerInterface $entityManager, int $id): Response
    {
//        dd('test');
        $form = $this->createForm(StudentType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('school_group/show.html.twig');
        }

        return $this->render('school_group/addStudent.html.twig.', [
            'form' => $form,
        ]);
    }
}
