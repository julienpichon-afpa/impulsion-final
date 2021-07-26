<?php

namespace App\Controller;

use App\Classe\MyMail;
use App\Entity\ResetPassword;
use App\Entity\User;
use App\Form\ResetPasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordController extends AbstractController
{
    private $entitymanager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entitymanager = $entityManager;
    }

    /**
     * @Route("/shop/mot-de-passe-oublie", name="reset_password")
     */
    public function index(Request $request, MyMail $mail): Response
    {
        // si on est déjà connecté, on est automatiquement retourné sur la homepage shop
        if ($this->getUser()){
            return $this->redirectToRoute('shop');
        }

        //on recherche l'utilisateur par email
        if ($request->get('email')) {
            $user = $this->entitymanager->getRepository(User::class)->findOneByEmail($request->get('email'));

            // si l'utilisateur existe bien, alors on créé un nouveau password
            if ($user) {
                $resetPassword = new ResetPassword();
                $resetPassword->setUser($user);
                $resetPassword->setToken(uniqid());
                $resetPassword->setCreatedAt(new \DateTime());
                $this->entitymanager->persist($resetPassword);
                $this->entitymanager->flush();

                // envoyer un mail a l'utilisateur avec un lien pour mettre à jour le mot de passe

                $url = $this->generateUrl('update_password', [
                    'token' => $resetPassword->getToken()
                ]);

                $mail->sendResetPassword($resetPassword, $url);

                $this->addFlash('notice', 'Vous allez recevoir dans queqlues secondes un mail avec la procédure pour réinitialiser votre mot de passe.');
            } else {
                $this->addFlash('notice', 'Cette adresse email est inconnue.');
            }
        }

        return $this->render('reset_password/index.html.twig');
    }

    /**
     * @Route("/shop/modifier-mot-de-passe/{token}", name="update_password")
     */
    public function update(Request $request, $token, UserPasswordEncoderInterface $encoder): Response
    {
        $resetPassword = $this->entitymanager->getRepository(ResetPassword::class)->findOneByToken($token);

        if (!$resetPassword) {
            return $this->redirectToRoute('reset_password');
        }

        //pour l'erreur : heure actuelle supérieur à l'heure + 3h
        $now = new \DateTime();
        if ($now > $resetPassword->getCreatedAt()->modify('+ 3 hour'))
        {
            $this->addFlash('notice', 'Votre demande de mot de passé a expiré. Merci de la renouveller.');
            return $this->redirectToRoute('reset_password');
        }
            $form = $this->createForm(ResetPasswordType::class);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $new_pwd = $form->get('new_password')->getData();

                $password = $encoder->encodePassword($resetPassword->getUser(), $new_pwd);

                $resetPassword->getUser()->setPassword($password);

                $this->entitymanager->flush();

                $this->addFlash('notice', 'Votre mot de passe a bien été mis à jour.');
                return $this->redirectToRoute('app_login');

            }

        return $this->render('reset_password/update.html.twig', [
            'form' => $form->createView()
        ]);


    }
}
