<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use TS\AppBundle\Entity\Event;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository
{   
    /**
     * Gets a QueryBuilder finding an enabled Duraltag by QrCode.
     *
     * @param $userId
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getQueryBuilderByEventId(Event $event)
    {
        return $this
            ->createQueryBuilder('p')
            ->join('p.eventProducts', 'ep')
            ->where('ep.event = :event')
            ->setParameter('event', $event)
            ->andWhere('p.enabled = true')
            
        ;
        }
    
    /**
     * Finds a Duraltag with its associated EAN by its QR code if the associated retailer is enabled.
     *
     * @param string $id
     *
     * @return Product
     */
    public function findProductsForEventWithUser(Event $event, $page, $nbPerPage)
    {
        $query = $this
            ->getQueryBuilderByEventId($event)
            ->select('p, ep, pu, u, b, s, c, i, sp')
            ->leftJoin('p.productUsers', 'pu')
            ->leftJoin('pu.user', 'u')
            ->leftJoin('p.brand', 'b')
            ->leftJoin('p.size','s')
            ->leftJoin('p.category','c')
            ->leftJoin('p.image','i')
            ->leftJoin('p.statusProduct', 'sp')
            //->setParameter('user', $userId)
            ->getQuery();
    $query
      // On définit l'annonce à partir de laquelle commencer la liste
      ->setFirstResult(($page-1) * $nbPerPage)
      // Ainsi que le nombre d'annonce à afficher sur une page
      ->setMaxResults($nbPerPage)
    ;
        return new Paginator($query, true);
    }
     /**
     * Finds a Duraltag with its associated EAN by its QR code if the associated retailer is enabled.
     *
     * @param string $id
     *
     * @return Product
     */
    public function findOneProductByIdFullInfo($id)
    {
        return $this
            ->createQueryBuilder('p')

            ->where('p.id = :id')
            ->setParameter('id', $id)
            ->select('p, pu, u, b, s, c, i, sp')
            ->leftJoin('p.productUsers', 'pu')
            ->leftJoin('pu.user', 'u')
            ->leftJoin('p.brand', 'b')
            ->leftJoin('p.size','s')
            ->leftJoin('p.category','c')
            ->leftJoin('p.image','i')
            ->leftJoin('p.statusProduct', 'sp')
            //->setParameter('user', $userId)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}
