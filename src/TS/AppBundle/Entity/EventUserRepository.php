<?php

namespace TS\AppBundle\Entity;

use Doctrine\ORM\EntityRepository;
use TS\UserBundle\Entity\User;

/**
 * EventUserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventUserRepository extends EntityRepository
{
   /**
     * Gets a QueryBuilder finding an enabled Duraltag by QrCode.
     *
     * @param User $user, float $status
     *
     * @return EventUser
     */
    public function findByUserAndStatusOrderByDate(User $user, $status1,$status2)
    {
        return $this
            ->createQueryBuilder('eu')
            ->join('eu.event', 'e')
            ->where('e.enabled = :enabled')
            ->setParameter('enabled', true)
            ->andWhere('eu.user = :user')
            ->setParameter('user', $user)
            ->andWhere('eu.status = :status1 OR eu.status = :status2')
            ->setParameter('status1', $status1)
            ->setParameter('status2', $status2)
            ->orderBy('e.dateEvent', 'ASC')
            ->getQuery()
            ->getResult()
        ;
        }
    
 
}
