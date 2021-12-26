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
    public function search(?string $season = null, ?string $diet = null, ?string $search = null): array
    {
        return $this->searchQuery($season, $diet, $search)
            ->getQuery()
            ->getResult()
        ;
    }

    public function countWithSearch(?string $season = null, ?string $diet = null, ?string $search = null): int
    {
        return (int) $this->searchQuery($season, $diet, $search)
            ->select('COUNT(id)')
            ->getQuery()
            ->getResult()
        ;
    }

    public function searchQuery(?string $season = null, ?string $diet = null, ?string $search = null): QueryBuilder
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

        return $qb;
    }

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }
}
