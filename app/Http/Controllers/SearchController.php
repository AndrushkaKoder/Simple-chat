<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\SearchResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{

    public function __invoke(SearchRequest $request): AnonymousResourceCollection
    {
        $searchValue = $request->validated('body');

        $searchUsers = User::query()
            ->where('email', 'like', '%' .$searchValue .'%')
            ->orWhere('name', 'like', '%' .$searchValue .'%')
//            ->orWhere('phone', 'like', '%' .$searchValue .'%')
            ->get();

        return SearchResource::collection($searchUsers);
    }
}
