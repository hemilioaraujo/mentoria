<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\Contracts\AnimalRepositoryInterface;

class RespostaDTO
{
    public bool $ok;

    public function __construct(public int $status_code, public mixed $data)
    {
        $this->status_code = $status_code;
        $this->data = $data;
        $this->ok = $status_code < 300 && $status_code >= 200;
    }
}
