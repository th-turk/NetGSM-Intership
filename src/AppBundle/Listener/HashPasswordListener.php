<?php
/**
 * Created by PhpStorm.
 * User: tahaturk25
 * Date: 2.9.2017
 * Time: 17:17
 */

namespace AppBundle\Listener;


use AppBundle\Entity\Users;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class HashPasswordListener implements EventSubscriber
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->passwordEncoder = $passwordEncoder;
    }

    public function getSubscribedEvents()
    {
        return ["prePersist","preUpdate"];
    }

    public function prePersist(LifecycleEventArgs $args )
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Users){
            return;
        }

        $this->encodePassword($entity);

    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();

        if (!$entity instanceof Users){
            return;
        }
        $this->encodePassword($entity);
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta,$entity);


    }

    /**
     * @param Users $entity
     */
    public function encodePassword(Users $entity)
    {
        if (!$entity->getPlainPassword()) {
            return;
        }
        $encoded = $this
            ->passwordEncoder
            ->encodePassword($entity, $entity->getPlainPassword());
        $entity->setPassword($encoded);
    }


}