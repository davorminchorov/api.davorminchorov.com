<?php

namespace DavorMinchorov\Contact\DataTransferObjects;

use DavorMinchorov\Contact\Api\V1\FormRequests\ContactFormRequest;
use Illuminate\Config\Repository;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class ContactDataTransferObject extends DataTransferObject
{
    /**
     * @var string
     */
    public string $fromName;

    /**
     * @var string
     */
    public string $fromEmail;

    /**
     * @var string
     */
    public string $message;

    /**
     * @var string
     */
    public ?string $toName;

    /**
     * @var string
     */
    public ?string $toEmail;

    /**
     * Populates the properties of the data transfer object from the request object.
     *
     * @param ContactFormRequest $contactFormRequest
     *
     * @return ContactDataTransferObject
     * @throws UnknownProperties
     */
    public static function fromRequest(ContactFormRequest $contactFormRequest): self
    {
        return new self([
            'fromName' => $contactFormRequest->input('name'),
            'fromEmail' => $contactFormRequest->input('email'),
            'message' => $contactFormRequest->input('message'),
        ]);
    }

    /**
     * Gets the email that needs to be set in the to field.
     *
     * @return string
     */
    public function getToEmail(): string
    {
        $this->toEmail = $this->getConfigRepository()->get('mail.to.email');

        return $this->toEmail;
    }

    /**
     * Gets the name that needs to be set in the to field.
     *
     * @return string
     */
    public function getToName(): string
    {
        $this->toName = $this->getConfigRepository()->get('mail.to.name');

        return $this->toName;
    }

    /**
     * Gets the config repository.
     *
     * @return Repository
     */
    public function getConfigRepository(): Repository
    {
        return new Repository();
    }
}
