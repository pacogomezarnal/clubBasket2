<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function homepage()
    {        
        return $this->render('home/home.html.twig');
    }
        /**
     * @Route("/registro/", name="registro")
     */
    public function registro(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $usuario = new Usuario();
        //Construyendo el formulario
        $form = $this->createForm(UsuarioType::class,$usuario);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
          // 3) Encode the password (you could also do this via Doctrine listener)
          $password = $passwordEncoder->encodePassword($usuario, $usuario->getPlainPassword());
          $usuario->setPassword($password);

          // 3c) $roles
          $usuario->setRoles(array('ROLE_USER'));

          // 4) save the User!
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($usuario);
          $entityManager->flush();

            return $this->redirectToRoute('home');
        }

        // replace this example code with whatever you need
        return $this->render('home/registro.html.twig',array('form'=>$form->createView(),'titulo'=>'Nuevo usuario'));
    }
}