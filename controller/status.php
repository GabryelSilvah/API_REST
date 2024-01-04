<?php

class Status
{
    private $data = [];


    function status200()
    {
        $this->data = [
            "status" => 200,
            "message" => "Ok"
        ];

        return $this->data;
    }

    function status201()
    {
        $this->data = [
            "status" => 201,
            "message" => "Created"
        ];

        return $this->data;
    }

    function status400()
    {
        $this->data = [
            "status" => 400,
            "message" => "Bad Request"
        ];

        return $this->data;
    }

    function status404()
    {
        $this->data = [
            "status" => 404,
            "message" => "Not found"
        ];

        return $this->data;
    }

    function status501()
    {
        $this->data = [
            "status" => 501,
            "message" => "Not implemented"
        ];

        return $this->data;
    }
}
