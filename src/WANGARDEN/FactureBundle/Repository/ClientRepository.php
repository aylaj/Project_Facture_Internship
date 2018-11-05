<?php

namespace WANGARDEN\FactureBundle\Repository;

/**
 * ClientRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClientRepository extends \Doctrine\ORM\EntityRepository
{
    public function findClientBy($data)
    {
        $query=$this->createQueryBuilder('a');

        if (is_array($data)) {

          //ID
            if (array_key_exists('id', $data)
            && $data['id']!=null) {
                $query->where('a.id  = :idClient')
                ->setParameter('idCLient', $data['id']);
            }

            //Prénom
            if (array_key_exists('prenom', $data)
              && $data['prenom']!=null) {
                $query->andWhere('a.prenom LIKE \''.$data['prenom'].'\'');
            }

            //Nom
            if (array_key_exists('nom', $data)
              && $data['nom']!=null) {
                $query->andWhere('a.nom LIKE \''.$data['nom'].'\'');
            }
        }

        //  ->andwhere('a.id')
//      ->andwhere('a.nom LIKE \''.$nom.'\'')
//      ->setParameters(array('prenom'=>$data['prenom'], 'id'=>$data['id'], 'nom'=>$data['nom']));
        /*  if($data['prenom'] !=''){
            $query->setParameter('prenom'=>$data['prenom']);

          }*/
        return $query->getQuery()->getResult();
    }
}