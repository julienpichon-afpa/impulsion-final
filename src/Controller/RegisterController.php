<?php

namespace App\Controller;

use App\Classe\MyMail;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $entityManager;

    //On instancie EntityManager qui permet de réaliser toutes les modifications dans la base de donnée.
    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/shop/inscription", name="register")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder, MyMail $mail): Response
    {
        // nous créons une variable $user à partir de la classe User().
        $user = new User();
        // on instancie une variable $form avec la méthode createForm dans laquelle
        // on renseigne deux paramètres pour créer le formulaire,  RegisterType et $user
        $form = $this->createForm(RegisterType::class, $user);

        //Le formulaire doit écouter la requête entrante pour savoir si elle est valide ou non avec la méthode handlerequest
        $form ->handleRequest($request);

        // si le formulaire est envoyé et valide
        if ($form->isSubmitted() && $form->isValid()) {

            // on injecte dans $user les données récupérées du formulaire
            $user = $form->getData();
            // nous encodons le mot passe stocké dans $user
            $password = $encoder->encodePassword($user, $user->getPassword());
            // on stocke le mot de passe hashé à la place de l’ancien dans $user
            $user->setPassword($password);
            // on persist/fige les données (uniquement lors d’une nouvelle entrée à la base de donnée)
            $this->entityManager->persist($user);
            // puis on flush, c'est à dire on stocke les données dans la base
            $this->entityManager->flush();

            $mail->sendRegisterSuccess($user->getEmail(), $user->getFullName());

        }

        // On utilise la méthode createView pour créer la vue du formulaire.
        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
