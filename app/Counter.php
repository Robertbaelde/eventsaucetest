<?php

declare(strict_types=1);

namespace App;

use App\Events\CountIncremented;
use EventSauce\EventSourcing\AggregateRoot;
use EventSauce\EventSourcing\AggregateRootBehaviour;

final class Counter implements AggregateRoot
{
    use AggregateRootBehaviour;
    public int $count = 0;

    public function count()
    {
        $this->recordThat(new CountIncremented($this->count + 1));
    }

    public function applyCountIncremented(CountIncremented $countIncremented): void
    {
        $this->count = $countIncremented->getNewCount();
    }
}
