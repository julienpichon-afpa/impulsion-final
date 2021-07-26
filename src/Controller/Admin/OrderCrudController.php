<?php

namespace App\Controller\Admin;

use App\Classe\MyMail;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;

class OrderCrudController extends AbstractCrudController
{
    private $entityManager;
    private $crudUrlGenerator; // Nous permet de manager une URL, on s'en sert lors de la redirection après avoir changé le status de la commande

    public function __construct(EntityManagerInterface $entityManager, CrudUrlGenerator $crudUrlGenerator, MyMail $mail)
    {
        $this->entityManager = $entityManager;
        $this->crudUrlGenerator = $crudUrlGenerator;
        $this->mail = $mail;
    }

    public static function getEntityFqcn(): string
    {
        return Order::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $updatePreparation = Action::new('updatePreparation', 'Préparation en cours', 'fas fa-box-open')->linkToCrudAction('updatePreparation');
        $updateDelivery = Action::new('updateDelivery', 'Livraison en cours', 'fas fa-truck')->linkToCrudAction('updateDelivery');

        return $actions
            ->add('detail', $updatePreparation)
            ->add('detail', $updateDelivery)
            ->add('index', 'detail');
    }

    public function updatePreparation(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(2);
        $this->entityManager->flush();

        // Envoi d'un mail à l'utilisateur pour l'informer que sa commande est en cours de préparation
        $this->mail->sendOrderStatus($order);

        // Ajout d'un message flash pour informer l'utilisateur que le status a bien été modifié
        $this->addFlash('notice', '<span style="color:green;"> <strong> La commande '.$order->getReference().' est bien en cours de préparation. </strong> </span>');

        // Construction d'une URL de redirection
        $url = $this->crudUrlGenerator->build()
            ->setController(OrderCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }

    public function updateDelivery(AdminContext $context)
    {
        $order = $context->getEntity()->getInstance();
        $order->setState(3);
        $this->entityManager->flush();

        // Envoi d'un mail à l'utilisateur pour l'informer que sa commande est en cours de préparation
        $this->mail->sendOrderStatus($order);

        // Ajout d'un message flash pour informer l'utilisateur que le status a bien été modifié
        $this->addFlash('notice', '<span style="color:orange;"> <strong> La commande '.$order->getReference().' est bien en cours de livraison. </strong> </span>');

        // Construction d'une URL de redirection
        $url = $this->crudUrlGenerator->build()
            ->setController(OrderCrudController::class)
            ->setAction('index')
            ->generateUrl();

        return $this->redirect($url);
    }


    // dans admin on vient afficher en DESC l'id
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setDefaultSort(['id' => 'DESC' ]);
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateTimeField::new('createdAt', 'passée le'),
            TextField::new('user.getFullName', 'Utilisateur'),
            TextEditorField::new('delivery', 'Adresse de livraison')->onlyOnDetail(),
            TextField::new('carrierName', 'Transporteur'),
            MoneyField::new('carrierPrice', 'Frais de port')->setCurrency('EUR'),
            MoneyField::new('Total')->setCurrency('EUR'),
        // La ligne si dessous nous permet d'afficher différents états selon la valeur de state en BDD
            ChoiceField::new('state', 'Status')->setChoices([
                'Non Payée' => 0,
                'Payée' => 1,
                'Préparation en cours' => 2,
                'Livraison en cours' => 3
            ]),
            ArrayField::new('orderDetails', 'Produits achetés')->hideOnIndex()
        ];
    }

}
