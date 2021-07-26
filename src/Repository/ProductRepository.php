<?php

namespace App\Repository;

use App\Entity\Product;
use App\Classe\Search;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * requete qui me permet de récupérer des produits en fonction de la recherche utlisateur
     * @return Product[]
     */
    public function findWithSearch(Search $search) {
        $query = $this
            ->createQueryBuilder('p') // On crée une requête sur la table product alias p
            ->select('c', 'p')
            ->join('p.category', 'c'); // Jointure avec category alias c

        // Si des catégories ont été sélectionnées
        if(!empty($search->categories)) {
            $query = $query
                ->andWhere('c.id IN (:categories)') // on envoie en paramètre categories de la classe search
                ->setParameter('categories', $search->categories);
        }
        if(!empty($search->string)){
            $query = $query
                ->andWhere('p.name LIKE :string')
                ->setParameter('string', "%{$search->string}%");
        }
        return $query->getQuery()->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
