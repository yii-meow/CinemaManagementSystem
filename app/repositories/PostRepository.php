<?php

namespace App\repositories;

use App\models\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{
    public function findAllPostsWithRelations()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->leftJoin('c.replies', 'r')
            ->leftJoin('p.likes', 'l')
            ->addSelect('c')
            ->addSelect('r')
            ->addSelect('l')
            ->orderBy('p.postDate', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
?>
