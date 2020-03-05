<?php

declare(strict_types=1);

namespace PhpCfdi\Finkok\Helpers;

use DateTimeImmutable;
use PhpCfdi\Credentials\Credential;
use PhpCfdi\XmlCancelacion\Credentials as XmlCancelacionCredentials;
use PhpCfdi\XmlCancelacion\XmlCancelacionHelper;

class CancelSigner
{
    /** @var array<string> */
    private $uuids;

    /** @var DateTimeImmutable */
    private $dateTime;

    /**
     * CancelSigner constructor
     *
     * @param array<string> $uuid
     * @param DateTimeImmutable|null $dateTime If null or ommited then use current time and time zone
     */
    public function __construct(array $uuid, ?DateTimeImmutable $dateTime = null)
    {
        $this->uuids = $uuid;
        $this->dateTime = $dateTime ?? new DateTimeImmutable();
    }

    /** @return array<string> */
    public function uuids(): array
    {
        return $this->uuids;
    }

    public function dateTime(): DateTimeImmutable
    {
        return $this->dateTime;
    }

    public function sign(Credential $credential): string
    {
        $helper = new XmlCancelacionHelper(XmlCancelacionCredentials::createWithPhpCfdiCredential($credential));
        return $helper->signCancellationUuids($this->uuids(), $this->dateTime());
    }

    public function signRetention(Credential $credential): string
    {
        $helper = new XmlCancelacionHelper(XmlCancelacionCredentials::createWithPhpCfdiCredential($credential));
        return $helper->signRetentionCancellationUuids($this->uuids(), $this->dateTime());
    }
}
