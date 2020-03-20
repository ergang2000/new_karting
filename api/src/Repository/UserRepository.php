<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }


    public function getDeelnemers($activiteitid)
    {
        $em=$this->getEntityManager();


        $query=$em->createQuery("SELECT d FROM App\Entity\User d WHERE :activiteitid MEMBER OF d.activiteiten");

        $query->setParameter('activiteitid',$activiteitid);

        return $query->getResult();
    }

    /**
     * @param string $role
     * @return User[]
     */
    public function getFromRole(string $role): array
    {
        $em = $this->getEntityManager();

        $query = $em->createQuery("SELECT u FROM App\Entity\User u WHERE u.roles LIKE :role");
        $query->setParameter('role', '%"'.$role.'"%');

        return $query->getResult();
    }
}
