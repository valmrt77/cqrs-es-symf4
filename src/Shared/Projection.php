<?php

namespace App\Shared;

interface Projection
{
    public function project(\App\Shared\DomainEvents $recordedEvents);
}
