<?php

namespace App\Controller;

use App\Entity\Proveedor;
use App\Form\ProveedorType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /* Función para listar los registros */
    #[Route('/', name: 'main')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $data = $doctrine->getRepository(Proveedor::class)->findAll();
        return $this->render('main/index.html.twig', [
            'list' => $data
        ]);
    }

    /*Función para crear registros */
    #[Route('create', name: 'create')]
    public function create(Request $request, ManagerRegistry $doctrine){
        $proveedor = new Proveedor();
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($proveedor);
            $em->flush();

            $this->addFlash('notice','Añadido correctamente');

            return $this->redirectToRoute('main');
        }

        return $this->render('main/create.html.twig', ['form' => $form->createView()]);
    }

    /* Función para actualizar registros */
    #[Route('/update/{id}', name: 'update')]
    public function update(Request $request, ManagerRegistry $doctrine, int $id){
        
        $proveedor = $doctrine->getRepository(Proveedor::class)->find($id);
        $form = $this->createForm(ProveedorType::class, $proveedor);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $doctrine->getManager();
            $em->persist($proveedor);
            $em->flush();

            $this->addFlash('notice','Actualizado correctamente');

            return $this->redirectToRoute('main');
        }

        return $this->render('main/update.html.twig', ['form' => $form->createView()]);
    }
    
    /* Función para eliminar registros */
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(ManagerRegistry $doctrine, int $id){

        $data = $doctrine->getRepository(Proveedor::class)->find($id);
        $em = $doctrine->getManager();
        $em->remove($data);
        $em->flush();

        $this->addFlash('notice','Eliminado correctamente');
        return $this->redirectToRoute('main');
    }


}
