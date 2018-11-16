<?php

namespace LIV\AppBundle\Repository;

/**
 * PlaceCategoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PlaceCategoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllPlaceByCategorySlug($slug)
    {
        $qb = $this->createQueryBuilder('pc')
            ->where('pc.slug = :slug')
            ->setParameter('slug', $slug)
            ->leftJoin('pc.places', 'plcs')
            ->addSelect('plcs')
            ->leftJoin('plcs.address', 'ddrss')
            ->addSelect('ddrss')
            ->leftJoin('plcs.tags', 'tgs')
            ->addSelect('tgs')
        ;

        return $qb->getQuery()->getOneOrNullResult();
    }
}
