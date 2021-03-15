<?php

declare(strict_types=1);

namespace App;

use EventSauce\LaravelEventSauce\AggregateRootRepository;
//use EventSauce\LaravelEventSauce\Jobs\HandleConsumerWithoutOverlap;

/** @method \App\Counter retrieve(\App\CounterId $aggregateRootId) */
final class CounterRepository extends AggregateRootRepository
{
    protected string $aggregateRoot = Counter::class;

    protected string $table = 'counter_domain_messages';

    protected string $queue = 'es';

    protected array $consumers = [
        CountConsumer::class
    ];
}
