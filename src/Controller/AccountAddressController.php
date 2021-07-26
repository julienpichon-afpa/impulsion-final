<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAddressController extends AbstractController
{

    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/shop/compte/adresses", name="account_address")
     */
    public function index(): Response
    {
        return $this->render('account/address.html.twig');
    }

    /**
     * @Route("/shop/compte/ajouter-adresse", name="account_address_add")
     */
    public function add(Cart $cart, Request $request): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) //Si formulaire soumis et valide
        {
            $address->setUser($this->getUser()); // On associe l'utilisateur en cours à l'objet adresse
            $this->entityManager->persist($address); // On prépare l'insertion en BDD
            $this->entityManager->flush(); // On enregistre les données en BDD

            // Ce block de code nous permet de rediriger l'utilisateur sur la page commande si le panier n'est pas vide, sous entendu,
            // que l'utilisateur s'est retrouvé ici au moment de passer commande et qu'il n'avait aucune adresse enregistrée ou qu'il a voulu
            // en ajouter une
            if($cart->get()){
                return $this->redirectToRoute('order');
            }
                return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/shop/compte/modifier-adresse/{id}", name="account_address_edit")
     */
    public function edit(Request $request, $id)
    {
        $address = $this->entityManager->getRepository(Address::class)->findOneById($id);

        // Comme on retrouve l'adresse via l'id passée en URL, on se protège d'un usage malveillant, c'est à dire du cas
        // ou on a fait transité une id innexistante via l'url
        // Redirection si aucune adresse n'est trouvée ou si l'adresse trouvée n'est pas liée à l'utilisateur en cours
        if (!$address || $address->getUser() != $this->getUser())
        {
            return $this->redirectToRoute('account_address');
        }

        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $this->entityManager->flush();
            return $this->redirectToRoute('account_address');
        }
        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/shop/compte/supprimer-adresse/{id}", name="account_address_delete")
     */
    public function delete($id)
    {
        $address = $this->entityManager->getRepository(Address::class)->findOneById($id);

        if ($address && $address->getUser() == $this->getUser())
        {
            $this->entityManager->remove($address);
            $this->entityManager->flush();
        }
        return $this->redirectToRoute('account_address');
    }
}
