<?php

namespace App\Http\Controllers\Admin\Traits;

use Illuminate\Support\Str;

trait Sorters
{
    private function transformInputSorters(string|null $sorters): array
    {
        if ($sorters === null) {
            return [];
        }

        return array_map(function (string $sorter) {
            return [
                mb_substr($sorter, 1),
                mb_substr($sorter, 0, 1) === '+' ? 'asc' : 'desc'
            ];
        }, explode(',', $sorters));
    }

    private function sortsQuery(mixed $query, array $sorters, array $fields): mixed
    {
        foreach ($sorters as [$column, $sortType]) {
            $field = $fields[$column] ?? null;
            if ($field === null) {
                continue;
            }

            if (!Str::contains($field, '.')) {
                $query = $query->orderBy($field, $sortType);
            }
        }

        return $query;
    }

    private function getSortByColumn(string $column, array $sorters): array|null
    {
        foreach ($sorters as $sorter) {
            if ($column === $sorter[0]) {
                return $sorter;
            }
        }

        return null;
    }
}
