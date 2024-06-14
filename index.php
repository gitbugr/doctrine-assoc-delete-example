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

        $thingA1 = new ThingA();
        $thingA2 = new ThingA();
        $thingA3 = new ThingA();
        $thingA4 = new ThingA();
        $thingB = new ThingB();

        $thingA1->setOwner($userA);
        $thingA2->setOwner($userA);
        $thingA3->setOwner($userA);
        $thingA4->setOwner($userA);
        $userA->setThings(new ArrayCollection([$thingA1, $thingA2, $thingA3, $thingA4]));

        $thingB->setOwner($userB);
        $userB->setThings(new ArrayCollection([$thingB]));

        $em->persist($userA);
        $em->persist($userB);
        $em->persist($thingA1);
        $em->persist($thingA2);
        $em->persist($thingA3);
        $em->persist($thingA4);
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

