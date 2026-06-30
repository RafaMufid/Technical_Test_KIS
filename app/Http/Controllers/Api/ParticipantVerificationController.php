<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\VerifyParticipantRequest;
use App\Services\ParticipantVerificationService;
use Illuminate\Http\JsonResponse;
use Exception;

class ParticipantVerificationController extends Controller
{
    public function __construct(private ParticipantVerificationService $verificationService) {}

    public function verify(VerifyParticipantRequest $request): JsonResponse
    {
        try {
            $this->verificationService->verify(
                $request->input('peserta'),
                $request->input('status'),
                $request->input('catatan'),
                $request->input('alasan')
            );

            return response()->json([
                'status_code' => 200,
                'message'     => 'Berhasil memproses verifikasi peserta lelang',
            ], 200);
        } catch (Exception $e) {
            $statusCode = ($e->getCode() >= 400 && $e->getCode() <= 500) ? $e->getCode() : 500;

            return response()->json([
                'status_code' => $statusCode,
                'message'     => $e->getMessage(),
            ], $statusCode);
        }
    }
}
