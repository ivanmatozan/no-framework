<?php

namespace App\Exceptions;

use App\Session\SessionInterface;
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
     * @var SessionInterface
     */
    protected $session;

    /**
     * Handler constructor.
     * @param Exception $exception
     * @param SessionInterface $session
     */
    public function __construct(Exception $exception, SessionInterface $session)
    {
        $this->exception = $exception;
        $this->session = $session;
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
        $this->session->setMultiple([
            'errors' => $exception->getErrors(),
            'old' => $exception->getOldInput()
        ]);

        return redirect($exception->getPath());
    }
}
