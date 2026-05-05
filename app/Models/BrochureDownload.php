<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BrochureDownload extends Model
{
    protected $fillable = [
        'nome',
        'email',
        'telefone',
    ];

    /**
     * Pesquisa no backoffice (nome por palavras, email/frase inteira e telefone com dígitos agrupados).
     */
    public function scopeAdminSearch(Builder $query, string $search): Builder
    {
        $search = trim(preg_replace('/\s+/u', ' ', $search) ?? '');

        if ($search === '') {
            return $query;
        }

        $tokens = preg_split('/\s+/u', $search, -1, PREG_SPLIT_NO_EMPTY) ?: [];

        $letterTokens = array_values(array_filter(
            $tokens,
            fn (string $t): bool => preg_match('/\p{L}/u', $t) === 1,
        ));

        $digitsCollapsed = preg_replace('/\D+/', '', $search) ?? '';

        return $query->where(function (Builder $outer) use ($search, $letterTokens, $digitsCollapsed): void {
            $likeFull = '%'.static::escapeLike($search).'%';

            $outer->where(function (Builder $q) use ($likeFull): void {
                $q->where('nome', 'like', $likeFull)
                    ->orWhere('email', 'like', $likeFull)
                    ->orWhere('telefone', 'like', $likeFull);
            });

            if (count($letterTokens) > 1) {
                $outer->orWhere(function (Builder $q) use ($letterTokens): void {
                    foreach ($letterTokens as $token) {
                        $q->where('nome', 'like', '%'.static::escapeLike($token).'%');
                    }
                });
            }

            if (strlen($digitsCollapsed) >= 7) {
                $outer->orWhere('telefone', 'like', '%'.static::escapeLike($digitsCollapsed).'%');
            }
        });
    }

    protected static function escapeLike(string $value): string
    {
        return str_replace(
            ['\\', '%', '_'],
            ['\\\\', '\\%', '\\_'],
            $value,
        );
    }
}
