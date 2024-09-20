<?php

namespace App\repositories;

use App\models\User;
use Doctrine\ORM\EntityRepository;

class UserRewardRepository extends EntityRepository
{
    public function findPromoCodeUserOwn(int $userId, int $promoCode)
    {
        $user = $this->getEntityManager()->getRepository(User::class)->find($userId);
        $results = null;
        if($user) {
            $results = $this->createQueryBuilder('ur')
                ->where('ur.user = :user')
                ->andWhere('ur.promoCode = :promoCode')
                ->andWhere('ur.rewardCondition = :unused')
                ->setParameter('user', $user)
                ->setParameter('promoCode', $promoCode)
                ->setParameter('unused', 'unused')
                ->getQuery()
                ->getResult();
        }
        return $results;
    }

    public function findMatchingUserOfPromoCode(int $userId, int $promoCode){
        return $this->createQueryBuilder('ur')
            ->join('ur.user', 'u') // Join with the User entity
            ->where('u.userId = :userId') // Filter by userId through the User entity
            ->andWhere('ur.promoCode = :promoCode')
            ->setParameter('userId', $userId)
            ->setParameter('promoCode', $promoCode)
            ->getQuery()
            ->getResult();
    }
}