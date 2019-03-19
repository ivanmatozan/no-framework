<?php

namespace App\Session;

class Flash
{
    /**
     * @var SessionInterface
     */
    protected $session;

    /**
     * @var array
     */
    protected $messages = [];

    /**
     * Flash constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
        $this->init();
        $this->clear();
    }

    /**
     * @param string $key
     * @param string $value
     */
    public function now(string $key, string $value): void
    {
        $this->session->set('flash', array_merge(
            $this->session->get('flash', []),
            [$key => $value]
        ));
    }

    protected function init(): void
    {
        $this->messages = $this->session->get('flash');
    }

    protected function clear(): void
    {
        $this->session->clear('flash');
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        return $this->messages[$key] ?? null;
    }
}
