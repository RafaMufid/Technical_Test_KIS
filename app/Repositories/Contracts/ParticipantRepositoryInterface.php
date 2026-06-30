<?php

namespace App\Repositories\Contracts;

use App\Models\Participant;
use App\Models\ParticipantReason;

interface ParticipantRepositoryInterface
{
    public function findById(string $id): ?Participant;
    public function update(string $id, array $data): Participant;
    public function createReason(array $data): ParticipantReason;
}
