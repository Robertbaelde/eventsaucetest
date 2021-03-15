<?php
declare(strict_types=1);

namespace App\Events;


use EventSauce\EventSourcing\Serialization\SerializablePayload;

class CountIncremented implements SerializablePayload
{
    private int $newCount;

    public function __construct(int $newCount)
    {
        $this->newCount = $newCount;
    }

    public function toPayload(): array
    {
        return [
            'newCount' => $this->newCount
        ];
    }

    public static function fromPayload(array $payload): SerializablePayload
    {
        return new self($payload['newCount']);
    }

    public function getNewCount(): int
    {
        return $this->newCount;
    }

}
