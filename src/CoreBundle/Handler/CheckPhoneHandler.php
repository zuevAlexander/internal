<?php

namespace CoreBundle\Handler;

use CoreBundle\Model\Request\CheckPhone\CheckCodeRequest;
use CoreBundle\Model\Request\CheckPhone\SendCodeRequest;
use CoreBundle\Service\CheckPhone\CheckPhoneService;
use RestBundle\Handler\ProcessorInterface;

/**
 * Class CheckPhoneHandler
 */
class CheckPhoneHandler implements ProcessorInterface
{
    /**
     * @var CheckPhoneService
     */
    private $checkPhoneService;

    /**
     * TestHandler constructor.
     * @param CheckPhoneService $checkPhoneService
     */
    public function __construct(CheckPhoneService $checkPhoneService) {
        $this->checkPhoneService = $checkPhoneService;
    }

    /**
     * @param CheckCodeRequest $request
     * @return array
     */
    public function processGetCheckCode(CheckCodeRequest $request): array
    {
        $this->checkPhoneService->checkSecret();
        return $this->checkPhoneService->checkCode($request);
    }

    /**
     * @param SendCodeRequest $request
     * @return array
     */
    public function processGetSendCode(SendCodeRequest $request): array
    {
        $this->checkPhoneService->checkSecret();
        return $this->checkPhoneService->sendCode($request);
    }
}
