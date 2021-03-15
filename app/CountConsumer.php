<?php

declare(strict_types=1);

namespace App;

use App\Events\CountIncremented;
use App\Models\CountHistory;
use App\Models\LatestCount;
use EventSauce\EventSourcing\Message;
use EventSauce\LaravelEventSauce\Consumer;
use Illuminate\Contracts\Queue\ShouldQueue;

final class CountConsumer extends Consumer implements ShouldQueue
{
    public function handleCountIncremented(CountIncremented $countIncremented, Message $message)
    {
        LatestCount::updateOrCreate(
            ['count_id' => $message->aggregateRootId()->toString()],
            ['count' => $countIncremented->getNewCount()]
        );

        CountHistory::create([
            'count_id' => $message->aggregateRootId()->toString(),
            'count' => $countIncremented->getNewCount()
        ]);
    }
}
