<?php
namespace Tradeprint;


if(!class_exists('Tradeprint\TPAuthorizationException'))
{
    class TPAuthorizationException extends \Exception
    {
        public function __construct($message = '', $code = 0)
        {
            return parent::__construct($message, $code);
        }
    }
}
