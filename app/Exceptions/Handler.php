<?php

namespace App\Exceptions;

use Exception;
use Psr\Http\Message\ResponseInterface;
use ReflectionClass;

class Handler
{
    /**
     * @var Exception
     */
    protected $exception;

    /**
     * Handler constructor.
     * @param Exception $exception
     */
    public function __construct(Exception $exception)
    {
        $this->exception = $exception;
    }

    /**
     * @return ResponseInterface
     */
    public function respond(): ResponseInterface
    {
        try {
            $class = (new ReflectionClass($this->exception))->getShortName();
        } catch (\ReflectionException $e) {
            return $this->unhandledException($e);
        }

        if (method_exists($this, $method = "handle{$class}")) {
            return $this->$method($this->exception);
        }

        return $this->unhandledException($this->exception);
    }

    /**
     * @param Exception $exception
     * @return ResponseInterface
     */
    protected function unhandledException(Exception $exception): ResponseInterface
    {
        return redirect('/');
    }

    /**
     * @param ValidationException $exception
     * @return ResponseInterface
     */
    protected function handleValidationException(ValidationException $exception): ResponseInterface
    {
        return redirect($exception->getPath());
    }
}
