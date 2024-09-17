<?php

namespace App\repositories;

use App\models\User;
use Doctrine\ORM\EntityRepository;

class UserRewardRepository extends EntityRepository
{
    public function findPromoCodeUserOwn($userId, $promoCode)
    {
        $user = $this->getEntityManager()->getRepository(User::class)->find($userId);
        $results = null;
        if($user) {
            $results = $this->createQueryBuilder('ur')
                ->where('ur.user = :user')  // Reference the user association, not the userId directly
                ->andWhere('ur.promoCode = :promoCode')  // Assuming promoCode is a field in the UserReward entity
                ->andWhere('ur.rewardCondition = :unused')  // Add condition for rewardCondition
                ->setParameter('user', $user)  // Pass the User entity
                ->setParameter('promoCode', $promoCode)
                ->setParameter('unused', 'unused')
                ->getQuery()
                ->getResult();
        }

        return $results;
    }
}