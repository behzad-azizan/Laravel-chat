<?php

namespace App\Http\Resources;

use App\Http\Resources\PaginationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MessageCollection extends ResourceCollection
{
    public $collects = MessageResource::class;
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $pagination = new PaginationResource($this);

        return [
            'data' => $this->collection,
            $pagination::$wrap => $pagination,
        ];
    }
}
