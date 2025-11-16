<?php

namespace App\Traits;

use App\Traits\Uuid;

trait AdditionalUuid {
    

    use Uuid;

    public function newUniqueId(): string
    {
        return (string) Uuid::uuid4();
    }

    public function uniqueIds(): array
    {
        return ['uuid', ];
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }
}
