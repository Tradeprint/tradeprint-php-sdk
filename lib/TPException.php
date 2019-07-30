<?php
namespace Tradeprint;

if(!class_exists('Tradeprint\TPException'))
{
    class TPException extends \Exception
    {
        private $details;

        public function __construct($message, $errorDetails)
        {
            $this->details = $errorDetails;
            return parent::__construct($message);
        }

        public function getDetails()
        {
            return $this->details;
        }
    }
}