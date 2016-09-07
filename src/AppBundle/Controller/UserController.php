<?php
/**
 * Created by PhpStorm.
 * User: danbevan
 * Date: 06/09/2016
 * Time: 12:17
 */

namespace AppBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\User;
use AppBundle\Entity\Hobby;
use AppBundle\Form\UserFormType;
use AppBundle\Form\HobbyFormType;
use AppBundle\Service\MarkdownTransfomer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserController extends Controller
{
    /**
     * @Route("/user/new" name="admin_user_new)
     */
    public function newAction(Request $request)
    {
        $hobby = new Hobby();
        $form = $this->createForm(HobbyFormType::class);
        // only handles data on POST
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hobby = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($hobby);
            $em->flush();

            $this->addFlash('success', 'Hobby created!');

            return $this->redirectToRoute('user_show');

        }
        return $this->render('admin/user/new.html.twig', [
            'hobbyForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="admin_user_edit")
     */
    public function editAction(Request $request, User $user)
    {   $newFile = new User;
        $form = $this->createForm(UserFormType::class, $user, $newFile);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file

            $file = $newFile->getProfileimage();

            $fileName = md5(uniqid()).'.'.$file->guessExtension();

            $file->move(
                $this->getParameter('images_directory'),
                $fileName
            );

            $newFile->setProfileimage($fileName);
            $user = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'User updated!');
            return $this->redirectToRoute('admin_user_list');
        }

        return $this->render('admin/user/edit.html.twig', [
            'userForm' => $form->createView()
        ]);
    }


    /**
     * @Route("/user/{userName}", name="user_show")
     */
    public function showAction($userName)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('AppBundle:User')
            ->findOneBy(['name' => $userName]);

        if (!$user) {
            throw $this->createNotFoundException('user not found');
        }


        $markdownParser = new MarkdownTransfomer();
        $biography = $markdownParser->parse($user->getBiography());

        $recentHobbies = $user->getHobbies();

        return $this->render('user/show.html.twig', array(
            'user' => $user,
            'biography' => $biography,
            'recentHobbyCount' => count($recentHobbies)
        ));
    }

    /**
     * @Route("/user/{name}/hobbies", name="user_show_hobbies")
     * @Method("GET")
     */
    public function getHobbiesAction(User $user)
    {
        foreach ($user->getHobbies() as $hobby) {
            $hobbies[] = [
                'id' => $hobby->getId(),
                'hobby' => $hobby->getHobby(),
                'age' => $hobby->getAge()
            ];
        }

        $data = [
            'hobbies' => $hobbies
        ];

        return new JsonResponse($data);
    }

}