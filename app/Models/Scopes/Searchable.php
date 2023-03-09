<?php

namespace App\Models\Scopes;

trait Searchable
{
    /**
     * Search paginated items ordering by ID descending
     *
     * @param string $search
     * @param integer $paginationQuantity
     * @return void
     */
    public function scopeSearchLatestPaginated(
        $query,
        string $search,
        $paginationQuantity = 10
    ) {
        return $query
            ->search($search)
            ->orderBy('updated_at', 'desc')
            ->paginate($paginationQuantity);
    }

    /**
     * Adds a scope to search the table based on the
     * $searchableFields array inside the model
     *
     * @param [type] $query
     * @param [type] $search
     * @return void
     */
    public function scopeSearch($query, $search)
    {
        $query->where(function ($query) use ($search) {
            foreach ($this->getSearchableFields() as $field) {
                $query->orWhere($field, 'like', "%{$search}%");
            }
        });

        return $query;
    }

    /**
     * Returns the searchable fields. If $searchableFields is undefined,
     * or is an empty array, or its first element is '*', it will search
     * in all table fields
     *
     * @return array
     */
    protected function getSearchableFields()
    {
        if (isset($this->searchableFields) && count($this->searchableFields)) {
            return $this->searchableFields[0] === '*'
                ? $this->getAllModelTableFields()
                : $this->searchableFields;
        }

        return $this->getAllModelTableFields();
    }

    /**
     * Gets all fields from Model's table
     *
     * @return array
     */
    protected function getAllModelTableFields()
    {
        $tableName = $this->getTable();

        return $this->getConnection()
            ->getSchemaBuilder()
            ->getColumnListing($tableName);
    }
}
