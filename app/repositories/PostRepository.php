<?php
/**
 * @author Angeline Chuang May Teng
 */
namespace App\repositories;

use App\models\Post;
use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{

        public function findAllPostsWithCommentsLikes()
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.comments', 'c')
            ->leftJoin('c.replies', 'r')
            ->leftJoin('p.likes', 'l')
            ->addSelect('c', 'r', 'l')
            ->orderBy('p.postDate', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Search
    public function findPostsByIdsAndKeyword(array $postIds, ?string $keyword): array
    {
        $qb = $this->createQueryBuilder('p')
            ->leftJoin('p.user', 'u')
            ->addSelect('u')
            ->where('p.postID IN (:postIds)')
            ->setParameter('postIds', $postIds);

        if ($keyword !== null) {
            // Search by post content and user's username
            $qb->andWhere('p.content LIKE :keyword OR u.userName LIKE :keyword')
                ->setParameter('keyword', '%' . $keyword . '%');
        }

        return $qb->getQuery()->getResult();
    }


    public function findPostsByUserAndKeyword(int $userId, string $keyword): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->leftJoin('p.user', 'u')
            ->addSelect('u')
            ->where('p.user = :userId')
            ->andWhere('p.content LIKE :keyword OR u.userName LIKE :keyword')
            ->setParameter('userId', $userId)
            ->setParameter('keyword', '%' . $keyword . '%');

        return $queryBuilder->getQuery()->getResult();
    }


    public function findPostsByKeyword(string $keyword): array
    {
        $queryBuilder = $this->createQueryBuilder('p')
            ->leftJoin('p.user', 'u')
            ->addSelect('u');

        $queryBuilder
            ->where('p.content LIKE :keyword')
            ->orWhere('u.userName LIKE :keyword')
            ->setParameter('keyword', '%' . $keyword . '%');

        return $queryBuilder
            ->getQuery()
            ->getResult();
    }



    //Filter for MyPost and ShowLikedPost
    public function filterPostsByIdsOrderedByDate(array $postIds, string $order = 'DESC')
    {
        if (empty($postIds)) {
            return [];
        }

        return $this->createQueryBuilder('p')
            ->where('p.postID IN (:postIds)')
            ->setParameter('postIds', $postIds)
            ->orderBy('p.postDate', $order)
            ->getQuery()
            ->getResult();
    }

    public function filterPostsByIdsOrderedByLikes(array $postIds, string $order = 'DESC')
    {
        if (empty($postIds)) {
            return [];
        }

        return $this->createQueryBuilder('p')
            ->leftJoin('p.likes', 'l') // Join the likes relationship
            ->where('p.postID IN (:postIds)')
            ->setParameter('postIds', $postIds)
            ->groupBy('p.postID') // Group by post ID to calculate likes per post
            ->orderBy('COUNT(l)', $order) // Order by the number of likes
            ->getQuery()
            ->getResult();
    }

    public function filterPostsByIds(array $postIds)
    {
        if (empty($postIds)) {
            return [];
        }

        return $this->createQueryBuilder('p')
            ->where('p.postID IN (:postIds)')
            ->setParameter('postIds', $postIds)
            ->getQuery()
            ->getResult();
    }

    //Filter for Forum
    public function filterPostsOrderedByLikes(string $order = 'DESC')
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.likes', 'l') // Join the likes relationship
            ->groupBy('p.postID') // Group by post ID to aggregate likes
            ->orderBy('COUNT(l)', $order) // Order by the number of likes
            ->getQuery()
            ->getResult();
    }

    public function filterPostsOrderedByDate(string $order = 'DESC')
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.postDate', $order) // Order by the post date
            ->getQuery()
            ->getResult();
    }



}
?>
