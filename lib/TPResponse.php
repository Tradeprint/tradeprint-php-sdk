<?php
namespace Tradeprint;
if(!class_exists('Tradeprint\TPResponse'))
{
    class TPResponse
    {
        private $payload;

        private $statusCode = 0;

        public function __construct($payload, $statusCode = 200)
        {
            $this->payload = $payload;
            $this->statusCode = $statusCode;
        }

        public function getStatusCode()
        {
            return $this->statusCode;
        }

        public function isSuccess()
        {
            return $this->payload['success'] == true;
        }

        public function toArray()
        {
            return $this->payload['result'];
        }

        public function errorMessage()
        {
            return $this->payload['errorMessage'];
        }

        public function errorDetails()
        {
            return $this->payload['errorDetails'];
        }
    }
}