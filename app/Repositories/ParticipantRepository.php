<?php

namespace App\Repositories;

use App\Models\Participant;
use App\Models\ParticipantReason;
use App\Repositories\Contracts\ParticipantRepositoryInterface;

class ParticipantRepository implements ParticipantRepositoryInterface
{
    public function __construct(private Participant $model) {}

    public function findById(string $id): ?Participant
    {
        return $this->model->find($id);
    }

    public function update(string $id, array $data): Participant
    {
        $participant = $this->model->where('id', $id)->firstOrFail();
        $participant->fill($data)->save();

        return $participant->fresh();
    }

    public function createReason(array $data): ParticipantReason
    {
        return ParticipantReason::create($data);
    }
}
