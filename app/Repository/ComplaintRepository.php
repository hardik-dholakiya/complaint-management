<?php
namespace App\Repository;
/**
 * Created by PhpStorm.
 * User: Dholakiya Hardik
 * Date: 26/6/17
 * Time: 11:55 AM
 */
use App\complaints;
use App\Repository\Interfaces\ComplaintRepositoryInterface;

class ComplaintRepository implements ComplaintRepositoryInterface
{
    protected $complaint;
    function __construct(complaints $complaints)
    {
        $this->complaint=$complaints;
    }
    public function getall()
    {
        $complaint_list = $this->complaint->with(array('user','admin', 'responses','responses.admin','responses.user'))->orderBy('created_at', 'desc')->get();
        return$complaint_list;
    }
    public function getByUser($user_id)
    {
        $complaint_list = $this->complaint->with(array('responses','responses.admin','responses.user'))->where('user_id', $user_id)->where('create_by', '==', 0)->orderBy('created_at', 'desc')->get();
        return $complaint_list;
    }
    public function store($complaints_data)
    {
        $result = $this->complaint->create($complaints_data);
        return $result;
    }
    public function deleteByUserId($user_id)
    {
        $result=$this->complaint->where('user_id', $user_id)->where('create_by', 0)->delete();
        return $result;
    }
}