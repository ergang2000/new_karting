<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\DBAL\DriverManager;

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

    public function createFromArray(array $attributes)
    {
        try {
            $conn = $this->getEntityManager()->getConnection();
            $queryBuilder = $conn->createQueryBuilder();

            $queryBuilder
                ->insert('user');

            // the reason that we loop through the values twice and not insert the values directly
            // is because this way the values also gets serialized
            foreach ($attributes as $key => $value) {
                $queryBuilder->setValue($key, ':'.$key);
            }
            foreach ($attributes as $key => $value) {
                $queryBuilder->setParameter($key, $value);
            }

            $queryBuilder->execute();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function updateFromArray(User $user, array $attributes)
    {
//        try {
            $conn = $this->getEntityManager()->getConnection();
            $queryBuilder = $conn->createQueryBuilder();

            $queryBuilder->update('user');

            // the reason that we loop through the values twice and not insert the values directly
            // is because this way the values also gets serialized
            foreach ($attributes as $key => $value) {
                $queryBuilder->set($key, ':'.$key);
            }
            foreach ($attributes as $key => $value) {
                $queryBuilder->setParameter($key, $value);
	        }

            $queryBuilder->where('id', ':id');
	        $queryBuilder->setParameter('id', $user->getId());

            $queryBuilder->execute();

            return true;
//        } catch (\Exception $e) {
//            return false;
//        }
    }
}
