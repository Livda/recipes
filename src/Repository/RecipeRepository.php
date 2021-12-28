<?php

namespace App\Repository;

use App\Entity\Recipe;
use App\Enum\DietEnum;
use App\Enum\SeasonEnum;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Recipe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recipe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recipe[]    findAll()
 * @method Recipe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 *
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository implements RepositoryInterface
{
    use RepositoryTrait;

    /**
     * @return Recipe[]
     */
    public function findBySeasonAndDietWithSearchQuery(
        string $season, 
        string $diet, 
        ?string $search = null, 
        array $orderBy = null, 
        int $limit = null, 
        int $offset = null,
        ): array
    {
        return $this->generateQueryBuilder($season, $diet, $search, $orderBy, $limit, $offset)
            ->getQuery()
            ->getResult()
        ;
    }

    public function countBySeasonAndDietWithSearchQuery(
        string $season , 
        string $diet , 
        ?string $search = null
        ): int
    {
        return (int) $this->generateQueryBuilder($season, $diet, $search)
            ->select('COUNT(r.id)')
            ->getQuery()
            ->getSingleScalarResult()
        ;
    }

    public function generateQueryBuilder(
        string $season, 
        string $diet, 
        ?string $search = null, 
        array $orderBy = null, 
        int $limit = null, 
        int $offset = null,
        ): QueryBuilder
    {
        $qb = $this->createQueryBuilder('r');
        if (null !== $season && SeasonEnum::ALL_SEASONS !== $season) {
            $qb->andWhere('r.season = :season');
            $qb->setParameter('season', $season);
        }
        if (null !== $diet && DietEnum::ALL !== $diet) {
            $qb->andWhere('r.diet = :diet');
            $qb->setParameter('diet', $diet);
        }
        if (null !== $search) {
            $shards = explode(' ', $search);

            foreach ($shards as $index => $shard) {
                $qb->andWhere('r.tags LIKE :shard'.$index);
                $qb->orWhere('r.name LIKE :shard'.$index);
                $qb->setParameter('shard'.$index, '%'.$shard.'%');
            }
        }

        if (null !== $orderBy) {
            foreach ($orderBy as $field => $order) {
                $qb->addOrderBy('r.' . $field, $order);
            }
        }

        $qb->setMaxResults($limit);
        $qb->setFirstResult($offset);

        return $qb;
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }
}
