<?php

namespace Mdhesari\RoleManager\Exceptions;

use Exception;

class RoleRepositoryIsNotLoaded extends Exception
{
    /**
     * message
     *
     * @var string
     */
    protected $message = "Please setup a repository for role and follow correct installation instructions.";

    /**
     * render
     *
     * @return mixed
     */
    public function render()
    {

        return response()->json([
            'message' => $this->message
        ]);
    }

    /**
     * report
     *
     * @return string
     */
    public function report()
    {

        return $this->message;
    }
}
