<?php

namespace App\Controller;

use App\Entity\SchoolGroup;
use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SchoolGroupController extends AbstractController
{
    #[Route('/', name: 'app_school_group')]
    public function index(): Response
    {
        return $this->render('school_group/index.html.twig');
    }

    #[Route('/school_group', name: 'app_school_group_show')]
    public function show(EntityManagerInterface $entityManager): Response
    {
        $schoolGroups = $entityManager->getRepository(SchoolGroup::class)->findAll();

        return $this->render('school_group/show.html.twig', [
            'school_groups' => $schoolGroups
        ]);
    }

    #[Route('/students/{id}', name: 'students')]
    public function students(EntityManagerInterface $entityManager, int $id): Response
    {
        $schoolGroups = $entityManager->getRepository(SchoolGroup::class)->find($id);

        return $this->render('school_group/students.html.twig', [
            'school_groups' => $schoolGroups
        ]);
    }


    #[Route('/delete/{id}', name: 'delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $student = $entityManager->getRepository(Student::class)->find($id);
        $entityManager->remove($student);
        $entityManager->flush();
        $this->addFlash('danger', 'verwijderd');

        return $this->redirectToRoute('school_group/show.html.twig');
    }

//    #[Route('/addStudent/{id}', name: 'addStudent')]
//    public function addStudent(Request $request, EntityManagerInterface $entityManager, int $id): Response
//    {
//        $form = $this->createForm(StudentType::class);
//
//        $form->handleRequest($request);
//        if ($form->isSubmitted() && $form->isValid()) {
//            // $form->getData() holds the submitted values
//            // but, the original `$task` variable has also been updated
//            $task = $form->getData();
//
//            // ... perform some action, such as saving the task to the database
//
//            return $this->redirectToRoute('school_group/show.html.twig');
//        }
//
//        return $this->render('school_group/addStudent.html.twig.', [
//            'form' => $form,
//        ]);
//    }
}

