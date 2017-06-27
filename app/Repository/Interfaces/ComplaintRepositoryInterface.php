<?php
namespace App\Repository\Interfaces;
/**
 * Created by PhpStorm.
 * User: root
 * Date: 26/6/17
 * Time: 11:51 AM
 */
interface ComplaintRepositoryInterface
{
    public function getByUser($user_id);

    public function getall();

    public function store($complaints_data);

    public function deleteByUserId($user_id);

}