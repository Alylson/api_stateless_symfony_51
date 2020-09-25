<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class UserController
 * @package App\Controller
 * @Route("/api", name="user_api")
 */
class UserController extends AbstractController
{
    /**
     * @param UserService $user
     * @Route("/users", name="users", methods={"GET"})
     * @return JsonResponse
     */
    public function index(UserService $user)
    {
        $users = $user->getAllUser();

        return $this->json($users);
    }

    /**
     * @param Request $request
     * @param UserService $user
     * @Route("/user", name="user_add", methods={"POST"})
     * @return JsonResponse
     */
    public function store(Request $request, UserService $user)
    {
        $add_user = $user->addUser($request);

        return $this->response($add_user);
    }

    /**
     * @param UserService $user
     * @param $id
     * @return JsonResponse
     * @Route("/user/{id}", name="user_get", methods={"GET"})
     */
    public function show(UserService $user, $id)
    {
        $show_user = $user->getUser($id);

        return $this->json($show_user);
    }

    /**
     * @param UserService $user
     * @param Request $request
     * @param $id
     * @return JsonResponse
     * @Route("/user/{id}", name="user_put", methods={"PUT"})
     */
    public function update(UserService $user, Request $request, $id)
    {
        $update_user = $user->updateUser($request, $id);

        return $this->response($update_user);
    }

    /**
     * @param UserService $user
     * @param $id
     * @return JsonResponse
     * @Route("/user/{id}", name="user_delete", methods={"DELETE"})
     */
    public function destroy(UserService $user, $id)
    {
        $del_user = $user->delUser($id);

        return $this->response($del_user);
    }

    /**
     * @param array $data
     * @param $status
     * @param array $headers
     * @return JsonResponse
     */
    public function response($data, $status = 200, $headers = [])
    {
        return new JsonResponse($data, $status, $headers);
    }
}
