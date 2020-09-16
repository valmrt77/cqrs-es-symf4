<?php

namespace App\Shared;

interface Projection
{
    public function project(DomainEvents $events);
}
