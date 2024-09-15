<?php

namespace App\repositories;

use App\models\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findAllWithDetails()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->leftJoin('p.likes', 'l')
            ->leftJoin('p.replies', 'r')
            ->addSelect('c')
            ->addSelect('l')
            ->addSelect('r')
            ->orderBy('p.postDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
?>
