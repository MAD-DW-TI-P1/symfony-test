<?php

namespace App\Controller;

use App\Entity\Imgmascota;
use App\Form\ImgmascotaType;
use App\Repository\ImgmascotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/imgmascota')]
class ImgmascotaController extends AbstractController
{
    #[Route('/', name: 'app_imgmascota_index', methods: ['GET'])]
    public function index(ImgmascotaRepository $imgmascotaRepository): Response
    {
        return $this->render('imgmascota/index.html.twig', [
            'imgmascotas' => $imgmascotaRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_imgmascota_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ImgmascotaRepository $imgmascotaRepository): Response
    {
        $imgmascotum = new Imgmascota();
        $form = $this->createForm(ImgmascotaType::class, $imgmascotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgmascotaRepository->save($imgmascotum, true);

            return $this->redirectToRoute('app_imgmascota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('imgmascota/new.html.twig', [
            'imgmascotum' => $imgmascotum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_imgmascota_show', methods: ['GET'])]
    public function show(Imgmascota $imgmascotum): Response
    {
        return $this->render('imgmascota/show.html.twig', [
            'imgmascotum' => $imgmascotum,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_imgmascota_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Imgmascota $imgmascotum, ImgmascotaRepository $imgmascotaRepository): Response
    {
        $form = $this->createForm(ImgmascotaType::class, $imgmascotum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imgmascotaRepository->save($imgmascotum, true);

            return $this->redirectToRoute('app_imgmascota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('imgmascota/edit.html.twig', [
            'imgmascotum' => $imgmascotum,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_imgmascota_delete', methods: ['POST'])]
    public function delete(Request $request, Imgmascota $imgmascotum, ImgmascotaRepository $imgmascotaRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$imgmascotum->getId(), $request->request->get('_token'))) {
            $imgmascotaRepository->remove($imgmascotum, true);
        }

        return $this->redirectToRoute('app_imgmascota_index', [], Response::HTTP_SEE_OTHER);
    }
}
