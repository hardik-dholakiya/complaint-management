<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/6/17
 * Time: 12:20 PM
 */

namespace App\Repository;


use App\Repository\Interfaces\UserRepositoryInterface;
use App\User;

class UserRepository implements UserRepositoryInterface
{
    protected $user;
    function __construct(User $user)
    {
        $this->user=$user;
    }

    public function getall()
    {
        $user = $this->user->all();
        return $user;
    }
    public function storeUser($user_data)
    {
        $result = $this->user->create($user_data);
        return $result;
    }
    public function search($search_text)
    {
        $result = $this->user->where('first_name', 'like', "%$search_text%")
            ->orWhere('last_name', 'like', "%$search_text%")
            ->orWhere('email', 'like', "%$search_text%")
            ->orWhere('flat_no', 'like', "%$search_text%")
            ->orWhere('block_no', 'like', "%$search_text%")
            ->get();
        return $result;
    }
    public function updateData($id, $user_data)
    {
        $result = $this->user->where('id', $id)->update([
            "first_name" => $user_data['first_name'],
            "last_name" => $user_data['last_name'],
            "email" => $user_data['email'],
            "flat_no" => $user_data['flat_no'],
            "block_no" => $user_data['block_no'],
            "address" => $user_data['address']
        ]);
        return $result;
    }
    public function updatePassword($email_id, $new_password)
    {
        $result = $this->user->where('email', $email_id)->update([
            "password" => $new_password
        ]);
        return $result;

    }
    public function delete($id)
    {
        $result = $this->user->destroy($id);
        return $result;
    }
}