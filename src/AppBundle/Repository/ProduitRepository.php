<?php

/**
 * Description of ProduitRepository
 *
 * @author LENOVO
 */
namespace AppBundle\Repository;

class ProduitRepository extends AbstractRepository
{
    public function search($entity, $term, $order = 'asc', $limit = 20, $offset = 0)
    {
        $qb = $this
            ->createQueryBuilder('a')
            ->select('a')
            ->orderBy('a.nom', $order)
        ;
        if ($entity)
        {
            $qb
                ->where('a.categorie = ?1')    
                ->setParameter(1, $entity->getId())
            ;
        }
        if ($term) {
            $qb
                ->where('a.nom LIKE ?1')
                ->setParameter(1, '%'.$term.'%')
            ;
        }
        //echo $qb->getQuery()->getSql();        die();
        return $this->paginate($qb, $limit, $offset);
    }
}
