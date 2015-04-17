<?php
namespace TijsVerkoyen\VoipCenter;

/**
 * VoipCenter class
 *
 * @author    Tijs Verkoyen <php-voipcenter@verkoyen.eu>
 * @version   2.0.0
 * @copyright Copyright (c), Tijs Verkoyen. All rights reserved.
 * @license   BSD License
 */
class VoipCenter
{
    const VERSION = "1.0.0";
    const DEBUG = false;

    /**
     * The user agent
     *
     * @var string
     */
    protected $userAgent;

    /**
     * The timeout
     *
     * @var int
     */
    protected $timeout = 30;

    /**
     * The API ID to use
     *
     * @var string
     */
    protected $apiId;

    /**
     * The API key to use
     *
     * @var string
     */
    protected $apiKey;

    /**
     * The client number to use
     *
     * @var string
     */
    protected $clientNumber;

    /**
     * The password
     *
     * @var string
     */
    protected $password;

    /**
     * Mapping between the menu and the classes
     *
     * @var array
     */
    protected $menuClassMapping = array(
        'sipacc' => 'SipAccount',
        'did' => 'Did',
    );

    /**
     * @param string $apiId        The API ID to use, provided by VoipCenter
     * @param string $apiKey       The API key to use, provided by VoipCenter
     * @param string $clientNumber The client number to use, provided by VoipCenter
     * @param string $password     The password to use, provided by VoipCenter
     */
    public function __construct($apiId, $apiKey, $clientNumber, $password)
    {
        $this->apiId = $apiId;
        $this->apiKey = $apiKey;
        $this->clientNumber = $clientNumber;
        $this->password = $password;
    }

    /**
     * @param int $timeout
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
    }

    /**
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Get the useragent that will be used.
     * Our version will be prepended to yours.
     * It will look like: "PHP VoipCenter/<version> <your-user-agent>"
     *
     * @return string
     */
    public function getUserAgent()
    {
        return (string) 'PHP VoipCenter/' . self::VERSION . ' ' . $this->userAgent;
    }

    /**
     * Set the user-agent for you application
     * It will be appended to ours, the result will look like: "PHP VoipCenter/<version> <your-user-agent>"
     *
     * @param string $userAgent Your user-agent, it should look like <app-name>/<app-version>.
     */
    public function setUserAgent($userAgent)
    {
        $this->userAgent = (string) $userAgent;
    }

    /**
     * Hash the client password
     *
     * @return string
     */
    protected function getHashedPassword()
    {
        return hash('sha256', md5($this->password));
    }

    /**
     * Helper method to get the pass based on the data to be send
     *
     * @param array $data
     * @return string
     */
    protected function getPass(array $data = null, array $keysToIgnore = null)
    {
        $stringToBeHashed = '';
        foreach ($data as $key => $value) {
            if (is_array($keysToIgnore) && in_array($key, $keysToIgnore)) {
                continue;
            }

            $stringToBeHashed .= $key . $value;
        }

        return hash_hmac('sha256', $stringToBeHashed, $this->apiKey);
    }

    /**
     * Make a call
     *
     * @param string $url    The url to call
     * @param array  $data   The data to be sent
     * @param string $method The method to be used, possible values are GET, POST.
     * @return array
     * @throws Exception
     */
    protected function doCall($url, array $data = null, $method = 'GET', array $keysToIgnore = null)
    {
        // build url
        $url = 'https://pbxonline.be/api/' . $url;

        $prependData = array(
            'apiID' => $this->apiId,
            'knummer' => $this->clientNumber,
            'pwd' => $this->getHashedPassword(),
        );
        $appendData = array(
            'f' => 'json',
            'ts' => time(),
        );

        $parameters = array_merge($prependData, $data, $appendData);
        $parameters['pass'] = $this->getPass($parameters, $keysToIgnore);

        $urlToCall = $url;
        if ($method == 'GET') {
            if (!empty($parameters)) {
                $urlToCall .= '?' . http_build_query($parameters);
            }
        }

        // set options
        $options[CURLOPT_URL] = $urlToCall;
        $options[CURLOPT_USERAGENT] = $this->getUserAgent();
        if (ini_get('open_basedir') == '' && ini_get('safe_mode' == 'Off')) {
            $options[CURLOPT_FOLLOWLOCATION] = true;
        }
        $options[CURLOPT_RETURNTRANSFER] = true;
        $options[CURLOPT_TIMEOUT] = (int) $this->getTimeOut();
        $options[CURLOPT_SSL_VERIFYPEER] = false;
        $options[CURLOPT_SSL_VERIFYHOST] = false;

        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $response = curl_exec($curl);

        $errorNumber = curl_errno($curl);
        $errorMessage = curl_error($curl);
        if ($errorNumber != 0) {
            throw new Exception($errorMessage, $errorNumber);
        }

        $decodedResponse = json_decode($response, true);

        // validate response
        if (false === $decodedResponse) {
            throw new Exception('Expected JSON');
        }
        if (isset($decodedResponse['head']['error_number']) && $decodedResponse['head']['error_number'] != '') {
            $message = 'unknown error';
            if (isset($decodedResponse['head']['error_message'])) {
                $message = $decodedResponse['head']['error_message'];
            }

            throw new Exception($message, (int) $decodedResponse['head']['error_number']);
        }
        if (isset($decodedResponse['body']['error_number']) && $decodedResponse['body']['error_number'] != '') {
            $message = 'unknown error';
            if (isset($decodedResponse['body']['error_message'])) {
                $message = $decodedResponse['body']['error_message'];
            }

            throw new Exception($message, (int) $decodedResponse['body']['error_number']);
        }

        return $decodedResponse;
    }

    /**
     * Call a number with a given SIP account
     *
     * @param string $sipAccount
     * @param string $numberToCall
     * @return bool
     * @throws Exception
     */
    public function call($sipAccount, $numberToCall)
    {
        $response = $this->doCall(
            'call.php',
            array(
                'sipacc' => $sipAccount,
                'telnr' => $numberToCall,
            ),
            'GET'
        );

        return (
            isset($response['head']['status']) &&
            $response['head']['status'] == '1' &&
            isset($response['body']['status']) &&
            $response['body']['status'] == '1'
        );
    }

    /**
     *
     * @param        $menu
     * @param string $filter
     * @return array
     * @throws Exception
     */
    public function getMenu($menu, $filter = '')
    {
        $response = $this->doCall(
            'get.php',
            array(
                'm' => $menu,
                'id' => 0,
                'filter' => $filter,
            ),
            'GET',
            array('filter')
        );

        // build className
        $className = mb_strtolower($menu);
        if (isset($this->menuClassMapping[$menu])) {
            $className = $this->menuClassMapping[$menu];
        }
        $className = '\\TijsVerkoyen\\VoipCenter\\Collections\\' . $className . 's';

        $instance = new $className;
        $instance->fromAPI($response);

        return $instance;
    }
}
