<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/shop/compte/modifier-mot-de-passe", name="account_password")
     */
    public function index(Request $request, UserPasswordEncoderInterface $encoder): Response
    {
        $notification = null;
        //On récupère les données de l'utilisateur qui est connecté, on les stock dans une instance de User()
        $user = $this->getUser();
        // On instancie un formulaire à partir de ChangePasswordType et de l'objet $user
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération de l'ancien mot de passe saisie dans le champ 'old_password'
            $old_pwd = $form->get('old_password')->getData();

            // Si ce mot de passe est le même que celui stocké en BDD pour cet utilisateur
            if ($encoder->isPasswordValid($user, $old_pwd)) {
                // Récupération du mot de passe saisie dans le champ 'new_password'
                $new_pwd = $form->get('new_password')->getData();
                // On hash ce mot de passe
                $password = $encoder->encodePassword($user, $new_pwd);
                // On affecte ce mot de passe hashé à l'objet $user via le setter associé
                $user->setPassword($password);
                // On inscrit les données en BDD
                $this->entityManager->flush();
                // on donne le message de réussite à notification
                $notification = "Votre mot de passe a été mis à jour.";
            }else {
                $notification = "Votre mot de passe actuel n'est pas le bon.";
            }
        }

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(), // On passe à twig la vue associée au formulaire
            'notification' => $notification // On affiche la notification
        ]);
    }
}
