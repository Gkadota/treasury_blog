<?php


namespace App\Repository;

use App\Models\User;

class UserRepository extends BaseRepository
{

    /**
     * Insert new user
     */
    public function insertUser(array $userInfo)
    {
        $newUser = User::create($userInfo);

        return $newUser;
    }

    /**
     * Update new user
     */
    public function updatetUser(array $userInfo)
    {
        $updateUserInfo = User::where('user_id', $userInfo['user_id'])
        ->update($userInfo);

        return $updateUserInfo;
    }


    /**
     * get specific user using pass and email
     */
    public function findUser(string $email, string $password = null)
    {
        $user = User::firstWhere(array_filter(['email' => $email, 'password' => $password]));
        return $user;
    }


    /**
     * fetch all bloggers
     */
    public function getBloggers()
    {
        $bloggers = User::where('user_type', 'blogger')->get();
        return $bloggers;
    }


    /**
     * Delete user using user_id
     */
    public function deleteBlogger(int $userId)
    {
        $deleteResult = User::where(['user_id' => $userId, 'user_type' => 'blogger'])->delete();
        return $deleteResult;
    }


}

