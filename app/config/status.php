<?php

class Status
{
    private $data = [];

    //Status http para retorno 
    function code_200()
    {
        header("http/1.1 200 Ok");
        $this->data = [
            "status" => 200,
            "message" => "Ok"
        ];

        return $this->data;
    }

    function code_201()
    {
        header("http/1.1 201 Created");
        $this->data = [
            "status" => 201,
            "message" => "Created"
        ];

        return $this->data;
    }

    function code_400()
    {
        header("http/1.1 400 Bad Request");
        $this->data = [
            "status" => 400,
            "message" => "Bad Request"
        ];

        return $this->data;
    }

    function code_404()
    {
        header("http/1.1 404 Not Found");
        $this->data = [
            "status" => 404,
            "message" => "Not Found"
        ];

        return $this->data;
    }

    function code_405()
    {
        header("http/1.1 405 Method Not Allowed");
        $this->data = [
            "status" => 405,
            "message" => "Method Not Allowed"
        ];

        return $this->data;
    }

    function code_501()
    {
        header("http/1.1 501 Not Implemented");
        $this->data = [
            "status" => 501,
            "message" => "Not Implemented"
        ];

        return $this->data;
    }
}
