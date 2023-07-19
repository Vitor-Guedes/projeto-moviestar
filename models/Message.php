<?php

class Message 
{
    protected $url;

    public function __construct(string $url)
    {
        $this->url = $url;
    }
    
    public function setMessage(string $message, string $type = 'success', $redirect = '/')
    {
        $_SESSION['message'] = $message;
        $_SESSION['type'] = $type;

        $location = $_SERVER['HTTP_REFERER'];
        if ($redirect != 'back') {
            $location = $this->url . $redirect;
        }
        header("Location: $location");
    }

    public function getMessage()
    {
        if (isset($_SESSION['message'], $_SESSION['type'])) {
            return [
                'message' => $_SESSION['message'],
                'type' => $_SESSION['type']
            ];
        }
        return false;
    }

    public function clearMessage()
    {
        $_SESSION['message'] = [];
    }
}