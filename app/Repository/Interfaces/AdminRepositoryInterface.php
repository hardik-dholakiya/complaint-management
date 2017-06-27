<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/6/17
 * Time: 12:17 PM
 */

namespace App\Repository\Interfaces;


interface AdminRepositoryInterface
{
    public function getall();
    public function storeUser($user_data);
    public function search($search_text);
    public function updateData($id,$user_data);
    public function updatePassword($email_id,$new_password);
    public function delete($id);
}