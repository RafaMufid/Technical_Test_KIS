<?php

namespace App\Services;

use App\Repositories\Contracts\ParticipantRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Exception;

class ParticipantVerificationService
{
    public function __construct(
        protected ParticipantRepositoryInterface $participantRepo
    ) {}
    /**
     * Memproses verifikasi peserta lelang
     *
     * @param string $participantId
     * @param string $statusPayload
     * @param string|null $catatan
     * @param string|null $alasan
     * @return void
     * @throws Exception
     */
    public function verify(string $participantId, string $statusPayload, ?string $catatan, ?string $alasan): void
    {
        DB::transaction(function () use ($participantId, $statusPayload, $catatan, $alasan) {

            $participant = $this->participantRepo->findById($participantId);

            if (!$participant) {
                throw new Exception("Peserta dengan ID tersebut tidak ditemukan.", 404);
            }

            $pin = null;
            $statusReason = '';

            if ($statusPayload === 'TERIMA') {
                $pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
                $statusReason = 'BIDDING';
            } elseif ($statusPayload === 'TOLAK') {
                $pin = null;
                $statusReason = 'DITOLAK';
            } else {
                throw new Exception("Status verifikasi tidak valid.", 400);
            }

            $this->participantRepo->update($participantId, [
                'pin' => $pin
            ]);

            $this->participantRepo->createReason([
                'id_peserta' => $participantId,
                'status'     => $statusReason,
                'catatan'    => $catatan,
                'alasan'     => $alasan
            ]);
        });
    }
}
