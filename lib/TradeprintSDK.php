<?php
namespace Tradeprint;

if(!class_exists('Tradeprint\TradeprintSDK'))
{
    class TradeprintSDK
    {


        private $environment, $username, $password, $version;
        private $_authToken;
        private $base_url;

        function __construct($username, $password, $environment = 'production', $version = 'v2')
        {

            if ($environment === 'sandbox') {
                $environment = 'stage';
            }

            $this->environment = $environment;
            $this->username = $username;
            $this->version = $version;

            if($environment === 'stage')
                $this->base_url = "https://{$this->environment}.orders.tradeprint.io/{$version}/";
            else
                $this->base_url = "https://orders.tradeprint.io/{$version}/";

            $this->password = $password;
            $this->_authToken = $this->getToken();
        }

        /**
         * Get the Tradeprint Order Service
         * @return TPOrderService
         */
        public function getOrderService()
        {
            return new TPOrderService($this);
        }

        /**
         * Get the Tradeprint Product Service
         * @return TPProductService
         */
        public function getProductService()
        {
            return new TPProductService($this);
        }

        /**
         * Make call to tradeprint api to authenticate, and return the token
         * required to make api calls.
         * @return mixed
         * @throws TPAuthorizationException
         */
        private function getToken()
        {
            $authResult = $this->_post('login', ['username' => $this->username, 'password' => $this->password], false);

            if (!$authResult->isSuccess()) {
                throw new TPAuthorizationException('Invalid username or password');
            }

            $result = $authResult->toArray();
            return $result['token'];
        }

        /**
         * Make a HTTP POST request to the Tradeprint api with auth
         * @param string $path - the path to post to (after version)
         * @param array $body - the body of the post
         * @return TPResponse - If the post was successful
         * @throws TPException - If there was an error
         */
        public function post($path, $body)
        {
            if (empty($this->_authToken)) {
                throw new \Exception('Must be authenticated first');
            }

            $result = $this->_post($path, $body);

            if (!$result->isSuccess()) {
                throw new TPException($result->errorMessage(), $result->errorDetails());
            }

            return $result;
        }

        /**
         * Make a HTTP PUT request to the Tradeprint api with auth
         * @param string $path - the path to post to (after version)
         * @param array $body - the body of the post
         * @return TPResponse - If the post was successful
         * @throws TPException - If there was an error
         */
        public function put($path, $body)
        {
            if (empty($this->_authToken)) {
                throw new \Exception('Must be authenticated first');
            }

            $result = $this->_put($path, $body);

            if (!$result->isSuccess()) {
                throw new TPException($result->errorMessage(), $result->errorDetails());
            }

            return $result;
        }

        /**
         * Make a HTTP GET request to the Tradeprint api with auth
         * @param string $path - the path to post to (after version)
         * @return TPResponse - If the post was successful
         * @throws TPException - If there was an error
         */
        public function get($path)
        {
            if (empty($this->_authToken)) {
                throw new \Exception('Must be authenticated first');
            }

            $result = $this->_get($path);

            if (!$result->isSuccess()) {
                throw new TPException($result->errorMessage(), $result->errorDetails());
            }

            return $result;
        }

        /**
         * Make a HTTP DELETE request to the Tradeprint api with auth
         * @param string $path - the path to post to (after version)
         * @return TPResponse - If the post was successful
         * @throws TPException - If there was an error
         */
        public function delete($path)
        {
            if (empty($this->_authToken)) {
                throw new \Exception('Must be authenticated first');
            }

            $result = $this->_delete($path);

            if (!$result->isSuccess()) {
                throw new TPException($result->errorMessage(), $result->errorDetails());
            }

            return $result;
        }

        /**
         * Make a standard post to Tradeprint API and transform it to a TP response
         * @param string $path - The path to post to (after version)
         * @param array $body - The body of the post
         * @param bool $withAuth - Are we using authentication on this post
         * @return TPResponse - if the server did not throw a 500 error
         * @throws \Exception - if the server threw a 500 error
         */
        private function _post($path, $body, $withAuth = true)
        {
            $headers = [
                'Content-Type: application/json'
            ];

            if ($withAuth) {
                $headers[] = "Authorization: Bearer {$this->_authToken}";
            }

            $path = $this->base_url.$path;

            $ch = curl_init($path);
            curl_setopt_array($ch, array(
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => json_encode($body)
            ));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if ($response === FALSE) {
                die(curl_error($ch));
            }

            $responseData = json_decode($response, TRUE);

            if (isset($responseData['message'])) {
                throw new \Exception('Unknown error ' . $responseData['message']);
            }

            return new TPResponse($responseData);
        }

        /**
         * Make a standard GET to Tradeprint API and transform it to a TP response
         * @param string $path - The path to post to (after version)
         * @param bool $withAuth - Are we using authentication on this post
         * @return TPResponse - if the server did not throw a 500 error
         * @throws \Exception - if the server threw a 500 error
         */
        private function _get($path, $withAuth = true)
        {
            $headers = [
                'Content-Type: application/json'
            ];

            if ($withAuth) {
                $headers[] = "Authorization: Bearer {$this->_authToken}";
            }

            $path = $this->base_url.$path;

            $ch = curl_init($path);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_HTTPHEADER => $headers,
            ));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if ($response === FALSE) {
                die(curl_error($ch));
            }

            $responseData = json_decode($response, TRUE);

            if (isset($responseData['message'])) {
                throw new \Exception('Unknown error ' . $responseData['message']);
            }

            return new TPResponse($responseData);
        }

        /**
         * Make a standard DELETE to Tradeprint API and transform it to a TP response
         * @param string $path - The path to post to (after version)
         * @param bool $withAuth - Are we using authentication on this post
         * @return TPResponse - if the server did not throw a 500 error
         * @throws \Exception - if the server threw a 500 error
         */
        private function _delete($path, $withAuth = true)
        {
            $headers = [
                'Content-Type: application/json'
            ];

            if ($withAuth) {
                $headers[] = "Authorization: Bearer {$this->_authToken}";
            }

            $path = $this->base_url.$path;

            $ch = curl_init($path);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_CUSTOMREQUEST => 'DELETE',
                CURLOPT_HTTPHEADER => $headers,
            ));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if ($response === FALSE) {
                die(curl_error($ch));
            }

            $responseData = json_decode($response, TRUE);

            if (isset($responseData['message'])) {
                throw new \Exception('Unknown error ' . $responseData['message']);
            }

            return new TPResponse($responseData);
        }

        /**
         * Make a standard PUT to Tradeprint API and transform it to a TP response
         * @param string $path - The path to post to (after version)
         * @param array $body - The body of the post
         * @param bool $withAuth - Are we using authentication on this post
         * @return TPResponse - if the server did not throw a 500 error
         * @throws \Exception - if the server threw a 500 error
         */
        private function _put($path, $body, $withAuth = true)
        {
            $headers = [
                'Content-Type: application/json'
            ];

            if ($withAuth) {
                $headers[] = "Authorization: Bearer {$this->_authToken}";
            }

            $path = $this->base_url.$path;

            $ch = curl_init($path);
            curl_setopt_array($ch, array(
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_HTTPHEADER => $headers,
                CURLOPT_POSTFIELDS => json_encode($body)
            ));

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if ($response === FALSE) {
                die(curl_error($ch));
            }

            $responseData = json_decode($response, TRUE);

            if (isset($responseData['message'])) {
                throw new \Exception('Unknown error ' . $responseData['message']);
            }

            return new TPResponse($responseData);
        }
    }
}
