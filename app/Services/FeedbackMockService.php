<?php

namespace App\Services;

class FeedbackMockService
{
    private const SESSION_KEY = 'siagamanado_feedbacks';

    public function getAllFeedbacks(): array
    {
        if (!session()->has(self::SESSION_KEY)) {
            session()->put(self::SESSION_KEY, [
                [
                    'id' => 'FB-001',
                    'userName' => 'Muhammad Haikal',
                    'message' => 'Aplikasi SiagaManado sangat membantu untuk memantau peringatan dini cuaca dan debit sungai di Tikala.',
                    'createdAt' => '2025-05-26 19:20:00',
                ],
            ]);
        }

        return session()->get(self::SESSION_KEY, []);
    }

    public function submitFeedback(string $message, array $user): array
    {
        $list = $this->getAllFeedbacks();

        $newEntry = [
            'id' => 'FB-' . rand(100, 999),
            'userName' => $user['name'] ?? 'Warga Manado',
            'message' => trim($message),
            'createdAt' => date('Y-m-d H:i:s'),
        ];

        array_unshift($list, $newEntry);
        session()->put(self::SESSION_KEY, $list);

        return $newEntry;
    }
}

