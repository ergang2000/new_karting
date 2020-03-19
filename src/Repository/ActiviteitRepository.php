<?php

namespace App\Repository;

use App\Entity\Activiteit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Activiteit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Activiteit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Activiteit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ActiviteitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Activiteit::class);
    }

    /**
     * @param $userid
     * @return Activiteit[]
     */
    public function getBeschikbareActiviteiten($userid): array
    {
        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT a FROM App\Entity\Activiteit a WHERE :userid NOT MEMBER OF a.users AND :date < a.datum ORDER BY a.datum");

        $query->setParameter('userid',$userid);
        $query->setParameter('date', new \DateTime());

        return $query->getResult();
    }

    /**
     * @param $userid
     * @return Activiteit[]
     */
    public function getIngeschrevenActiviteiten($userid): array
    {

        $em=$this->getEntityManager();
        $query=$em->createQuery("SELECT a FROM App\Entity\Activiteit a WHERE :userid MEMBER OF a.users ORDER BY a.datum");

        $query->setParameter('userid',$userid);

        return $query->getResult();
    }

    public function getTotaal($activiteiten): float
    {

        $totaal=0;
        foreach($activiteiten as $a)
        {
            $totaal+=$a->getSoort()->getPrijs();
        }
        return $totaal;

    }

    /**
     * @return Activiteit[]
     */
    public function findAll(): array
    {
        return $this->findBy(array(),array('datum'=>'ASC'));
    }
}
