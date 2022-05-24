<?php declare(strict_types=1);


namespace Modules\Extras\Repositories;


use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

use Modules\Extras\Models\Media;
use Support\Exceptions\DefaultException;
use Support\Exceptions\NotFoundException;
use Throwable;


class MediasRepository
{
    /**
     * @param string $order
     * @param string $sort
     * @param ?string $search
     * @return Collection
     */
    public function all(string $order, string $sort, ?string $search): Collection
    {
        return Media::search($search)->orderBy($order, $sort)->get();
    }

    /**
     * @param int $perPage
     * @param string $order
     * @param string $sort
     * @param ?string $search
     * @return Paginator
     */
    public function fetch(int $perPage, string $order, string $sort, ?string $search): Paginator
    {
        return Media::search($search)->orderBy($order, $sort)->paginate($perPage);
    }

    /**
     * @param array $attributes
     * @return Media
     * @throws DefaultException
     */
    public function create(array $attributes): Media
    {
        try {
            return Media::create($attributes);
        } catch (Throwable $th) {
            throw new DefaultException(message: 'Failed to create record.', originTh: $th);
        }
    }

    /**
     * @param int $id
     * @return Media
     * @throws NotFoundException
     */
    public function find(int $id): Media
    {
        $record = Media::find($id);
        
        if (!$record) {
            throw new NotFoundException();
        }

        return $record;
    }

    /**
     * @param array $attributes
     * @param int $id
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function update(array $attributes, int $id): void
    {
        $record = Media::find($id);

        if (!$record) {
            throw new NotFoundException();
        }

        try {
            $record->update($attributes);
        } catch (Throwable $th) {
            throw new DefaultException("Failed to update record", originTh: $th);
        }
    }

    /**
     * @param int $id
     * @param bool $force
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function delete(int $id, bool $force = false): void
    {
       // dd($id, 'do MediasRepository');
        $record = Media::find($id);
        

        if (!$record) {
            throw new NotFoundException();
        }

        try {
            if ($force) {
                $record->forceDelete();
            } else {
                $record->delete();
            }
        } catch (Throwable $th) {
            dd($th);
            throw new DefaultException(message: 'Failed to delete record.', originTh: $th);
        }
    }

    /**
     * @param int $id
     * @param string $action
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function situation(int $id, string $action): void
    {
        if ($action !== 'activate' && $action !== 'inactivate') {
            throw new DefaultException('Values accepted: activate | inactivate.');
        }

        $record = Media::find($id);

        if (!$record) {
            throw new NotFoundException();
        }

        $situation = $action === 'activate';

        try {
            $record->situation = $situation;

            $record->save();
        } catch (Throwable $th) {
            throw new DefaultException('Failed to set situation of record.', originTh: $th);
        }
    }

    /**
     * @param int $perPage
     * @param string $order
     * @param string $sort
     * @param ?string $search
     * @return Paginator
     */
    public function trashFetch(int $perPage, string $order, string $sort, ?string $search): Paginator
    {
        return Media::onlyTrashed()
            ->search($search)
            ->orderBy($order, $sort)
            ->paginate($perPage);
    }

    /**
     * @param int $id
     * @throws DefaultException
     * @throws NotFoundException
     */
    public function trashRestore(int $id): void
    {
        $record = Media::onlyTrashed()->find($id);

        if (!$record) {
            throw new NotFoundException();
        }

        try {
            $record->restore();
        } catch (Throwable $th) {
            throw new DefaultException('Failed to restore record.', originTh: $th);
        }
    }
}
