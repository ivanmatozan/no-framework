<?php

namespace App\Exceptions;

use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ValidationException extends \Exception
{
    /**
     * @var ServerRequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * ValidationException constructor.
     * @param ServerRequestInterface $request
     * @param array $errors
     * @param string $message
     * @param int $code
     * @param Throwable|null $previous
     */
    public function __construct(
        ServerRequestInterface $request,
        array $errors,
        string $message = '',
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);
        $this->request = $request;
        $this->errors = $errors;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->request->getUri()->getPath();
    }

    /**
     * @return array|object|null
     */
    public function getOldInput()
    {
        return $this->request->getParsedBody();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
