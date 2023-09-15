<?php

namespace Matula\WpApiClient\Endpoint;

class FakeEndpoint extends AbstractWpEndpoint
{
    public function getEndpoint()
    {
        return '/foo';
    }
}
