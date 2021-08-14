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
        $aValidation = $this->validateRequest($userInfo, $this->userRules->insertUserRules());
        if ($aValidation['success'] === false) {

            return $this->formatResponse(false, $aValidation['data']);
        }

        return   $this->formatResponse(true, $this->userRepo->insertUser($userInfo)->toArray());
    }


    /**
     *  fetch user using email an password
     */
    public function findUser($email,  $password)
    {
        $aValidation = $this->validateRequest([
            'email'    => $email,
            'password' => $password
        ], $this->userRules->loginRules());

        if ($aValidation['success'] === false) {

            return $this->formatResponse(false, $aValidation['data']);
        }

        $foundUser =  $this->userRepo->findUser($email, $password);

        if ($foundUser === null) {
            return $this->formatResponse(false, ['message' => 'Incorrect username/password']);
        }

        return $this->formatResponse(true, $foundUser->toArray());
    }


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

        $aValidation = $this->validateRequest(
            [
                'user_id' => $userId
            ],
            $this->userRules->deleteUserRules()
        );

        if ($aValidation['success'] === false) {
            return $this->formatResponse(false, $aValidation['data']);
        }


        $deleteResult =  $this->userRepo->deleteBlogger($userId);
        return $this->formatResponse((bool) $deleteResult);
    }
}
