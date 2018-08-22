<?php

namespace CoreBundle\Model\Request\CheckPhone;

class CheckCodeRequest
{
    /**
     * @var int
     */
    private $countryCode = 0;

    /**
     * @var int
     */
    private $phoneNumber = 0;

    /**
     * @var int
     */
    private $code = 0;

    /**
     * @return int
     */
    public function getCode(): int
    {
        return $this->code;
    }

    /**
     * @param int $code
     */
    public function setCode(int $code)
    {
        $this->code = $code;
    }

    /**
     * @return int
     */
    public function getCountryCode(): int
    {
        return $this->countryCode;
    }

    /**
     * @param int $countryCode
     */
    public function setCountryCode(int $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return int
     */
    public function getPhoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @param int $phoneNumber
     */
    public function setPhoneNumber(int $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }
}
