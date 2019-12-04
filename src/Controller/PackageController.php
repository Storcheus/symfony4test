<?php

namespace App\Controller;

use App\Entity\Package;
use App\Form\PackageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/package")
 *
 */
class PackageController extends AbstractController
{

    /**
     * @Route("/index", name="package_index")
     */
    public function index()
    {
        return $this->render('package/index.html.twig', [
            'controller_name' => 'PackageController',
        ]);
    }

    /**
     * @Route("/create", methods={"GET", "POST"}, name="package_create")
     */
    public function create(Request $request)
    {

        $package = new Package();
        $package->setCreatedAt(new \DateTime('now'));
        $package->setUpdatedAt(new \DateTime('now'));
        $form = $this->createForm(PackageType::class, $package);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $package = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($package);
            $em->flush();

            return $this->redirect('/package/view/' . $package->getId());

        }

        return $this->render(
            'package/edit.html.twig',
            ['form' => $form->createView()]
        );

    }

    /**
     * @Route("/view/{id}", methods={"GET", "POST"}, name="package_view")
     */
    public function view($id)
    {
        $package = $this->getDoctrine()
            ->getRepository(Package::class)
            ->find($id);

        if (!$package) {
            throw $this->createNotFoundException(
                'There are no Package with the following id: ' . $id
            );
        }

        return $this->render(
            'package/view.html.twig',
            ['package' => $package]
        );
    }

    /**
     * @Route("/show", methods={"GET", "POST"}, name="package_show")
     */
    public function show()
    {
        $packages = $this->getDoctrine()
            ->getRepository(Package::class)
            ->findAll();

        return $this->render(
            'package/show.html.twig',
            ['packages' => $packages]
        );
    }

    /**
     * @Route("/delete/{id}", methods={"GET", "POST"}, name="package_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $package = $em->getRepository(Package::class)->find($id);

        if (!$package) {
            throw $this->createNotFoundException(
                'There are no Package with the following id: ' . $id
            );
        }

        $em->remove($package);
        $em->flush();

        return $this->redirect('/package/show');
    }

    /**
     * @Route("/update/{id}", methods={"GET", "POST"}, name="package_update")
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $package = $em->getRepository(Package::class)->find($id);

        if (!$package) {
            throw $this->createNotFoundException(
                'There are no Package with the following id: ' . $id
            );
        }

        $form = $this->createForm(PackageType::class, $package);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $package = $form->getData();
            $em->flush();
            return $this->redirect('/package/view/' . $id);
        }

        return $this->render(
            'package/edit.html.twig',
            ['form' => $form->createView()]
        );
    }


    public function plans()
    {
        $packages = $this->getDoctrine()
            ->getRepository(Package::class)
            ->findAll();

        return $this->render(
            'package/plans.html.twig',
            ['packages' => $packages]
        );
    }
}
