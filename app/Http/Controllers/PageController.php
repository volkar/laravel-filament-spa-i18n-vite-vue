<?php

namespace App\Http\Controllers;

use App\Http\Resources\PageResource;
use App\Models\Page;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): AnonymousResourceCollection
    {
        return PageResource::collection(Page::all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page): PageResource
    {
        return new PageResource($page);
    }
}
