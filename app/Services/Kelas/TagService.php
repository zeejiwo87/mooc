<?php

namespace App\Services\Kelas;

use App\Models\Tag;
use Illuminate\Support\Collection;

final class TagService
{
    public function getListData(): Collection
    {
        return Tag::orderBy('id_tag')->get();
    }

    public function getListDataOrdered(): Collection
    {
        return Tag::select('id_tag', 'nama')->get();
    }

    public function create(array $data): Tag
    {
        return Tag::create($data);
    }

    public function getDetailData(string $id): ?Tag
    {
        return Tag::find($id);
    }

    public function findById(string $id): ?Tag
    {
        return Tag::find($id);
    }

    public function update(Tag $Tag, array $data): Tag
    {

        $Tag->update($data);

        return $Tag;
    }

    public function delete(Tag $Tag): void
    {
        $Tag->delete();
    }

    public function checkDuplicateForStore(string $slug): bool
    {
        return Tag::where('slug', $slug)->exists();
    }

    public function checkDuplicateForUpdate(int $id_tag, string $slug): bool
    {
        return Tag::where('slug', $slug)
            ->where('id_tag', '!=', $id_tag)
            ->exists();
    }
}
