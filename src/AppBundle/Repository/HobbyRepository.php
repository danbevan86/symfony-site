<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 15:52
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class HobbyRepository extends EntityRepository
{
    /**
     * @param User $user
     * @return Hobby[]
     */
    public function findAllRecentHobbiesForUser(User $user)
    {
        return $this->createQueryBuilder('user_hobby')
            ->andWhere('user_hobby.user = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->execute();
    }
}