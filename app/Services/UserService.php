<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Rules\UserRules;
use App\Services\BaseService;

class UserService extends BaseService
{

    private $userRepo;

    private $userRules;

    public function __construct(UserRepository $userRepo, UserRules $userRules)
    {
        $this->userRepo = $userRepo;
        $this->userRules = $userRules;
    }

    public function createUser($userInfo)
    {
        $validation = $this->validateRequest($userInfo, $this->userRules->insertUserRules());
        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        $insertResult  =    $this->formatResponse(true, $this->userRepo->insertUser($userInfo)->toArray());
        return $insertResult;
    }

    public function updateUser($userInfo)
    {
        $validation = $this->validateRequest($userInfo, $this->userRules->updateUserRules($userInfo['user_id']));
        if ($validation['success'] === false) {
            return $this->formatResponse(false, $validation['data']);
        }

        $updateResult =   $this->formatResponse((bool) $this->userRepo->updatetUser($userInfo));
        return $updateResult;
    }


    /**
     *  fetch user using email an password
     */
    public function findUser($email,  $password)
    {
        $validation = $this->validateRequest([
            'email'    => $email,
            'password' => $password
        ], $this->userRules->loginRules());

        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        $foundUser =  $this->userRepo->findUser($email, $password);

        if ($foundUser === null) {
            return $this->formatResponse(false, ['message' => 'Incorrect username/password']);
        }

        $foundUser = $foundUser->toArray();

        session()->put('granted_user', $foundUser);

        return $this->formatResponse(true, $foundUser);
    }

    /**
     *  Check credentials then logout
     */
    public function logoutUser($email)
    {
        $validation = $this->validateRequest(['email'    => $email], $this->userRules->logoutRules());

        if ($validation['success'] === false) {

            return $this->formatResponse(false, $validation['data']);
        }

        $foundUser =  $this->userRepo->findUser($email);

        if ($foundUser === null) {
            return $this->formatResponse(false, ['message' => 'No user found']);
        }

        $foundUser = $foundUser->toArray();

        session()->forget('granted_user');

        return $this->formatResponse(true, ['message' => 'Successfully logged out']);
    }


    /**
     * get bloggers list
     */
    public function getBloggers()
    {
        $bloggers =  $this->userRepo->getBloggers();

        if ($bloggers === null) {
            return $this->formatResponse(false, ['message' => 'No bloggers found']);
        }

        return $this->formatResponse(true, $bloggers->toArray());
    }


    public function deleteBlogger($userId)
    {

        $validation = $this->validateRequest(
            [
                'user_id' => $userId
            ],
            $this->userRules->deleteUserRules()
        );

        if ($validation['success'] === false) {
            return $this->formatResponse(false, $validation['data']);
        }


        $deleteResult =  $this->userRepo->deleteBlogger($userId);
        return $this->formatResponse((bool) $deleteResult);
    }
}
