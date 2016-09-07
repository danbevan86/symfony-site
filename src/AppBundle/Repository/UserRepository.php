<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 15:52
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    /**
     * @return User[]
     */
    public function findAllPublishedOrderedByName()
    {
        return $this->createQueryBuilder('user')
            ->orderBy('user.name', 'ASC')
            ->getQuery()
            ->execute();
    }
}