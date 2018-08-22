<?php

namespace CoreBundle\Service\CheckPhone;

use CoreBundle\Model\Request\CheckPhone\CheckCodeRequest;
use CoreBundle\Model\Request\CheckPhone\SendCodeRequest;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

/**
 * Class class CheckPhoneService
 */
class CheckPhoneService
{
    /**
     * @var string
     */
    private $twilioSendCodeUrl;

    /**
    * @var string
    */
    private $twilioCheckCodeUrl;

    /**
    * @var string
    */
    private $twilioToken;

    /**
    * @var string
    */
    private $secret;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * CheckPhoneService constructor.
     * @param string $twilioSendCodeUrl
     * @param string $twilioCheckCodeUrl
     * @param string $twilioToken
     * @param string $secret
     * @param RequestStack $request_stack
     */
    public function __construct(string $twilioSendCodeUrl, string $twilioCheckCodeUrl, string $twilioToken, string $secret, RequestStack $request_stack)
    {
        $this->twilioSendCodeUrl = $twilioSendCodeUrl;
        $this->twilioCheckCodeUrl = $twilioCheckCodeUrl;
        $this->twilioToken = $twilioToken;
        $this->secret = $secret;
        $this->request = $request_stack->getCurrentRequest();
    }

    /**
     * @return bool
     */
    public function checkSecret()
    {
        if ($this->secret != $this->request->headers->get('secret')) {
            throw new AccessDeniedException();
        }
        return true;
    }

    /**
     * @param CheckCodeRequest $request
     * @return array
     */
    public function checkCode(CheckCodeRequest $request)
    {
        $params = http_build_query([
            'verification_code' => $request->getCode(),
            'api_key' => $this->twilioToken,
            'country_code' => $request->getCountryCode(),
            'phone_number' => $request->getPhoneNumber()
        ]);

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->twilioCheckCodeUrl . '?' .$params);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $res = curl_exec($curl);

        return json_decode($res, true);
    }

    /**
     * @param SendCodeRequest $request
     * @return array
     */
    public function sendCode(SendCodeRequest $request)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->twilioSendCodeUrl);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS,
            array (
                'via' => 'sms',
                'api_key' => $this->twilioToken,
                'country_code' => $request->getCountryCode(),
                'phone_number' => $request->getPhoneNumber()
            ));
        $res = curl_exec($curl);

        return json_decode($res, true);
    }
}