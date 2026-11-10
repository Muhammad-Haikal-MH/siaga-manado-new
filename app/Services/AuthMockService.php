<?php

namespace App\Services;

class AuthMockService
{
    private const SESSION_KEY = 'siagamanado_auth_user';

    public function getInitialUser(): array
    {
        return [
            'id' => 'usr-001',
            'name' => 'Muhammad Haikal',
            'shortName' => 'Haikal',
            'username' => 'haikal',
            'initials' => 'MH',
            'avatarInitial' => 'H',
            'email' => 'haikal@telkomuniversity.ac.id',
            'phone' => '081234567890',
            'role' => 'User',
            'verified' => true,
            'address' => 'Kec. Malalayang, Kota Manado, Sulawesi Utara',
        ];
    }

    public function getCurrentUser(): array
    {
        if (!session()->has(self::SESSION_KEY)) {
            session()->put(self::SESSION_KEY, $this->getInitialUser());
        }

        return session()->get(self::SESSION_KEY);
    }

    public function updateProfile(array $data): array
    {
        $current = $this->getCurrentUser();
        $fullName = trim($data['name'] ?? $current['name']);
        $parts = preg_split('/\s+/', $fullName);
        $shortName = end($parts) ?: $fullName;

        if (count($parts) >= 2) {
            $initials = strtoupper(substr($parts[0], 0, 1) . substr(end($parts), 0, 1));
        } else {
            $initials = strtoupper(substr($fullName, 0, 2));
        }

        $updated = array_merge($current, [
            'name' => $fullName,
            'shortName' => $shortName,
            'initials' => $initials,
            'avatarInitial' => strtoupper(substr($shortName, 0, 1) ?: 'H'),
            'phone' => isset($data['phone']) ? trim($data['phone']) : $current['phone'],
        ]);

        session()->put(self::SESSION_KEY, $updated);

        return $updated;
    }

    public function resetDemoUser(): array
    {
        $initial = $this->getInitialUser();
        session()->put(self::SESSION_KEY, $initial);
        return $initial;
    }
}

