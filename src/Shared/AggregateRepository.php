<?php

namespace App\Shared;

interface AggregateRepository
{
    public function add(RecordsEvents $aggregate);

    public function get(AggregateId $id): RecordsEvents;
}
