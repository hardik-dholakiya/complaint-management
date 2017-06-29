<?php
/**
 * Created by PhpStorm.
 * User: Dholakiya Hardik
 * Date: 26/6/17
 * Time: 12:20 PM
 */

namespace App\Repository;


use App\Admin;
use App\Repository\Interfaces\AdminRepositoryInterface;

class AdminRepository implements AdminRepositoryInterface
{
    protected $admin;
    function __construct(Admin $admin)
    {
        $this->admin=$admin;
    }

    public function getall()
    {
        $admin = $this->admin->all();
        return $admin;
    }
    public function storeUser($admin_data)
    {
        $result = $this->admin->create($admin_data);
        return $result;
    }
    public function search($search_text)
    {
        $result = $this->admin->where('first_name', 'like', "%$search_text%")
            ->orWhere('last_name', 'like', "%$search_text%")
            ->orWhere('email', 'like', "%$search_text%")
            ->orWhere('flat_no', 'like', "%$search_text%")
            ->orWhere('block_no', 'like', "%$search_text%")
            ->get();
        return $result;
    }
    public function updateData($id, $admin_data)
    {
        $result = $this->admin->where('id', $id)->update([
            "first_name" => $admin_data['first_name'],
            "last_name" => $admin_data['last_name'],
            "email" => $admin_data['email'],
            "flat_no" => $admin_data['flat_no'],
            "block_no" => $admin_data['block_no'],
            "address" => $admin_data['address']
        ]);
        return $result;

    }
    public function updatePassword($email_id, $new_password)
    {
        $result = $this->admin->where('email', $email_id)->update([
            "password" => $new_password
        ]);
        return $result;

    }

    public function delete($id)
    {
        $result = $this->admin->destroy($id);
        return $result;
    }
}