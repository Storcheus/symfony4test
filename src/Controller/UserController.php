<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 * @Route("/user")
 *
 */
class UserController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(User::class);
    }


    /**
     * @Route("/index", name="user_index")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    

    /**
     * @Route("/create", methods={"GET", "POST"}, name="user_create")
     */
    public function create(Request $request)
    {

        $user = new User();
        $user->setCreatedAt(new \DateTime('now'));
        $user->setUpdatedAt(new \DateTime('now'));
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $user = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirect('/user/view/' . $user->getId());

        }

        return $this->render(
            'user/edit.html.twig',
            ['form' => $form->createView()]
        );

    }

    /**
     * @Route("/view/{id}", methods={"GET", "POST"}, name="user_view")
     */
    public function view($id)
    {
        $user = $this->repository->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'There are no User with the following id: ' . $id
            );
        }

        return $this->render(
            'user/view.html.twig',
            ['user' => $user]
        );
    }

    /**
     * @Route("/show", methods={"GET", "POST"}, name="user_show")
     */
    public function show()
    {
        $users = $this->repository->findAll();

        return $this->render(
            'user/show.html.twig',
            ['users' => $users]
        );
    }

    /**
     * @Route("/delete/{id}", methods={"GET", "POST"}, name="user_delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'There are no User with the following id: ' . $id
            );
        }

        $em->remove($user);
        $em->flush();

        return $this->redirect('/user/show');
    }

    /**
     * @Route("/update/{id}", methods={"GET", "POST"}, name="user_update")
     */
    public function update(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'There are no User with the following id: ' . $id
            );
        }

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $user = $form->getData();
            $em->flush();
            return $this->redirect('/user/view/' . $id);
        }

        return $this->render(
            'user/edit.html.twig',
            ['form' => $form->createView()]
        );
    }
}
