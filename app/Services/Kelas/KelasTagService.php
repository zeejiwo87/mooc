<?php

namespace App\Services\Kelas;

use App\Models\KelasTag;
use Illuminate\Support\Collection;

final class KelasTagService
{
    public function getListData(string $id, ?array $filters = []): Collection
    {
        return KelasTag::query()
            ->leftJoin('tag', 'tag.id_tag', '=', 'kelas_tag.id_tag')
            ->leftJoin('kelas', 'kelas.id_kelas', '=', 'kelas_tag.id_kelas')
            ->select(
                'kelas_tag.*',
                'tag.nama as tag_nama',
                'tag.slug as tag_slug',
                'kelas.judul as kelas_judul'
            )
            ->where('kelas_tag.id_kelas', $id)
            ->when(! empty($filters['id_pemilik']), fn ($q) => $q->where('kelas.id_pemilik', $filters['id_pemilik']))
            ->orderBy('kelas_tag.id_kelas')
            ->get();
    }

    public function create(array $data): KelasTag
    {
        return KelasTag::create($data);
    }

    public function findByIds(int $id_kelas, int $id_tag): ?KelasTag
    {
        return KelasTag::where('id_kelas', $id_kelas)
            ->where('id_tag', $id_tag)
            ->first();
    }

    public function update(KelasTag $kelasTag, array $data): KelasTag
    {
        $kelasTag->update($data);

        return $kelasTag;
    }

    public function delete(KelasTag $kelasTag): void
    {
        KelasTag::where('id_kelas', $kelasTag->id_kelas)
            ->where('id_tag', $kelasTag->id_tag)
            ->delete();
    }

    public function exists(int $id_kelas, int $id_tag): bool
    {
        return KelasTag::where('id_kelas', $id_kelas)
            ->where('id_tag', $id_tag)
            ->exists();
    }
}