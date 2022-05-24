<?php declare(strict_types=1);


namespace Modules\Extras\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;

use Support\Exceptions\NotFoundException;
use Modules\Extras\Models\State;


class StatesRepository
{
    /**
     * @param int|string $perPage
     * @param string $order
     * @param string $sort
     * @param ?string $search
     * @return Paginator|Collection
     */
    public function fetch(int|string $perPage, string $order, string $sort, ?string $search): Paginator|Collection
    {
        $query = State::search($search)->orderBy($order, $sort);

        if ($perPage === 'no-pagination') {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @param string $acronym
     * @return State
     * @throws NotFoundException
     */
    public function find(string $acronym): State
    {
        $record = State::find($acronym);

        if (!$record) {
            throw new NotFoundException();
        }

        return $record;
    }
}
