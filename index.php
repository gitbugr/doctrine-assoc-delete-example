<?php

    use Doctrine\Common\Collections\ArrayCollection;
    use Test\Entity\ThingA;
    use Test\Entity\ThingB;
    use Test\Entity\UserA;
    use Test\Entity\UserB;

    require_once 'bootstrap.php';

    try {
        $em = getEntityManager();

        $em->beginTransaction();

        $userA = new UserA();
        $userB = new UserB();

        $thingA = new ThingA();
        $thingB = new ThingB();

        $thingA->setOwner($userA);
        $userA->setThings(new ArrayCollection([$thingA]));

        $thingB->setOwner($userB);
        $userB->setThings(new ArrayCollection([$thingB]));

        $em->persist($userA);
        $em->persist($userB);
        $em->persist($thingA);
        $em->persist($thingB);
        $em->flush();

        // show things;
        dump('BEFORE removing ONLY userA\'s things:', $em->getConnection()->executeQuery('SELECT * FROM `things`;')->fetchAllAssociative());

        $userA->setThings(new ArrayCollection());
        $em->persist($userA);
        $em->flush();

        // show things;
        dump('AFTER removing ONLY userA\'s things:', $em->getConnection()->executeQuery('SELECT * FROM `things`;')->fetchAllAssociative());


        $em->rollback();

    } catch (Throwable $e) {
        dd('Something went wrong', $e);
    }

