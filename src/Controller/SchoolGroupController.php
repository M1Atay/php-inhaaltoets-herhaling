<?php

namespace App\Controller;

use App\Entity\SchoolGroup;
use App\Entity\Student;
use App\Form\StudentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
            'schoolGroups' => $schoolGroups
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(EntityManagerInterface $entityManager, int $id): Response
    {
        $student = $entityManager->getRepository(Student::class)->find($id);
        $entityManager->remove($student);
        $entityManager->flush();
        $this->addFlash('danger', 'verwijderd');

        return $this->redirectToRoute('students', ['id' => $student->getSchoolGroup()->getId()]);
    }
}

