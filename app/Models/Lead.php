<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'source',
        'message',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope для новых заявок
    public function scopeNew($query)
    {
        return $query->where('status', 'new');
    }

    // Scope для обработанных
    public function scopeProcessed($query)
    {
        return $query->where('status', 'processed');
    }

    // Scope для завершенных
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    // Изменение статуса
    public function markAsProcessed(): void
    {
        $this->update(['status' => 'processed']);
    }

    public function markAsCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }

    public function markAsSpam(): void
    {
        $this->update(['status' => 'spam']);
    }

    // Форматированный телефон
    public function getFormattedPhoneAttribute(): string
    {
        $phone = preg_replace('/\D/', '', $this->phone);

        // Белорусские форматы:
        // Мобильные: +375 (29) XXX-XX-XX, +375 (33) XXX-XX-XX и т.д.
        // Городские: +375 (17) XXX-XX-XX

        if (strlen($phone) === 12 && str_starts_with($phone, '375')) {
            // Формат: +375 (XX) XXX-XX-XX
            return '+375 (' . substr($phone, 3, 2) . ') ' . substr($phone, 5, 3) . '-' . substr($phone, 8, 2) . '-' . substr($phone, 10, 2);
        }

        if (strlen($phone) === 11 && str_starts_with($phone, '375')) {
            // Формат без ведущего +: 375XX XXXXXXX
            return '+375 (' . substr($phone, 3, 2) . ') ' . substr($phone, 5, 3) . '-' . substr($phone, 8, 2) . '-' . substr($phone, 10, 1);
        }

        if (strlen($phone) === 9) {
            // Локальный формат: 8 (0XX) XXX-XX-XX или 0XX XXX-XX-XX
            $operatorCode = substr($phone, 0, 2);
            $firstPart = substr($phone, 2, 3);
            $secondPart = substr($phone, 5, 2);
            $thirdPart = substr($phone, 7, 2);

            // Проверяем мобильные операторы Беларуси
            $mobileOperators = ['29', '33', '44', '25'];
            if (in_array($operatorCode, $mobileOperators)) {
                return '+375 (' . $operatorCode . ') ' . $firstPart . '-' . $secondPart . '-' . $thirdPart;
            }

            // Городские номера (Минск 17, другие коды городов)
            return '+375 (' . $operatorCode . ') ' . $firstPart . '-' . $secondPart . '-' . $thirdPart;
        }

        if (strlen($phone) === 7) {
            // Старый 7-значный формат (без кода оператора)
            return '+375 (??) ' . substr($phone, 0, 3) . '-' . substr($phone, 3, 2) . '-' . substr($phone, 5, 2);
        }

        // Если не удалось распознать формат, возвращаем исходный
        return $this->phone;
    }
}
