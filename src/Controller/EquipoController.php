<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Equipo;
use App\Form\EquipoType;

/**
* @Route("/equipo")
*/
class EquipoController extends AbstractController
{
    /**
     * @Route("/lista", name="listaEquipo")
     */
    public function listaEquipos()
    {        
        $repository = $this->getDoctrine()->getRepository(Equipo::class);
        $equipos = $repository->findAll();
        return $this->render('equipo/lista.html.twig',
        [
            'equipos'=>$equipos
        ]
        );
    }
    /**
     * @Route("/nuevo", name="nuevoEquipo")
    */
    public function nuevoEquipo()
    {           
        $equipo = new Equipo();
        $form = $this->createForm(EquipoType::class, $equipo);
        
        return $this->render('equipo/nuevo.html.twig', [
            'form' => $form->createView(),
        ]);
    }

}