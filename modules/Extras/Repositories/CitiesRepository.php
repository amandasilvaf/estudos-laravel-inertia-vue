<?php declare(strict_types=1);


namespace Modules\Extras\Repositories;


use Illuminate\Support\Collection;
use Illuminate\Contracts\Pagination\Paginator;
use Support\Exceptions\NotFoundException;
use Modules\Extras\Models\City;


class CitiesRepository
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
        $query = City::search($search)->orderBy($order, $sort);

        if ($perPage === 'no-pagination') {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @param int|string $perPage
     * @param string $order
     * @param string $sort
     * @param ?string $search
     * @param ?string $stateAcronym
     * @return Paginator|Collection
     */
    public function fetchByState(int|string $perPage, string $order, string $sort, ?string $search, ?string $stateAcronym): Paginator|Collection
    {
        $query = City::search($search)
            ->where(function ($query) use ($stateAcronym) {
                if (!is_null($stateAcronym)) {
                    $query->where('state_acronym', $stateAcronym);
                }
            })
            ->orderBy($order, $sort);

        if ($perPage === 'no-pagination') {
            return $query->get();
        }

        return $query->paginate($perPage);
    }

    /**
     * @param int $id
     * @return City
     * @throws NotFoundException
     */
    public function find(int $id): City
    {
        $record = City::find($id);

        if (!$record) {
            throw new NotFoundException();
        }

        return $record;
    }
}
