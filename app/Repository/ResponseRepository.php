<?php
namespace App\Repository;

/**
 * Created by PhpStorm.
 * User: Dholakiya Hardik
 * Date: 26/6/17
 * Time: 11:55 AM
 */
use App\Repository\Interfaces\ResponseRepositoryInterface;
use App\Response;

class ResponseRepository implements ResponseRepositoryInterface
{
    protected $response;

    function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function store($data)
    {
        $result=$this->response->create($data);
        return$result;
    }
}