<?php

class Status
{
    private $data = [];


    function successful()
    {
        $this->data = [
            "status" => 200,
            "messenger" => "ok"
        ];

        return $this->data;
    }

    function create()
    {
        $this->data = [
            "status" => 201,
            "messenger" => "user created"
        ];

        return $this->data;
    }

    function notFound()
    {
        $this->data = [
            "status" => 404,
            "messenger" => "not found"
        ];

        return $this->data;
    }

    function notImplemented()
    {
        $this->data = [
            "status" => 501,
            "messenger" => "not implemented"
        ];

        return $this->data;
    }
}
