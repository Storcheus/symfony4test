<?php


namespace App\Controller;

use App\Entity\Package;
use App\Entity\Subscription;
use App\Entity\User;

use App\Repository\Filter\UserFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SubscriptionController extends AbstractController
{
    public function index()
    {
        $packages = $this->getDoctrine()
            ->getRepository(Package::class)
            ->findAll();

        return $this->render(
            'subscription/packages.html.twig',
            ['packages' => $packages]
        );
    }

    public function subscribe( $id)
    {
        $package = $this->getDoctrine()->getRepository(Package::class)->find($id);

        if (!$package) {
            throw $this->createNotFoundException(
                'There are no Package with the following id: ' . $id
            );
        }

        $userFilter = new UserFilter();
        $userFilter->setIsActive(1);

        $user = $this->getDoctrine()->getRepository(User::class)->findAllByFilter($userFilter);

        if (!$user) {
            throw $this->createNotFoundException(
                'There are no User with the following id: ' . $id
            );
        }

        $subscription = new Subscription();
        $subscription->setCreatedAt(new \DateTime('now'));
        $subscription->setUpdatedAt(new \DateTime('now'));
        $subscription->setIsActive(1);
        $subscription->setUser($user);
        $subscription->setPackage($package);

        $subscription->setStartsAt(new \DateTime('now'));
        $subscription->setExpireAt((new \DateTime('now'))->add(new \DateInterval("P1M")));

        $em = $this->getDoctrine()->getManager();
        $em->persist($subscription);
        $em->flush();


        $subscriptions = $this->getDoctrine()
            ->getRepository(Subscription::class)
            ->findAll();


        return $this->redirect('/user/show');


    }


}