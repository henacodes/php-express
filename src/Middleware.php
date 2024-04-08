<?php

namespace Henacodes\Pexpress;

require_once "Request.php";
require_once "Response.php";



class Middleware
{
    private Request $request;
    private Response $response;
    private bool $stopExecution = true;
    private int $callCount = 0;
    private array $stack = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function add(callable $middleware)
    {
        $this->stack[] = $middleware;
    }

    public function continueExecution()
    {
        $this->stopExecution = false;
    }
    public function handle()
    {
        foreach ($this->stack as $middleware) {

            if ($this->callCount >= 1 && $this->stopExecution === true) {
                return 0;
            } else {
                $this->stack[$this->callCount]($this->request, $this->response, [$this, 'continueExecution']);
            }
            $this->callCount++;
        }
    }
}
