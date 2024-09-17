<?php

namespace App\repositories;

use App\models\Feedback;
use Doctrine\ORM\EntityRepository;

class FeedbackRepository extends EntityRepository
{
    public function findAllFeedback()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.postDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
?>

