<?php

namespace App\Http\Controllers;

use App\Actions\Quotes\CreateQuoteAction;
use App\Actions\Quotes\UpdateQuoteAction;
use App\Http\Requests\StoreQuoteRequest;
use App\Http\Resources\QuoteResource;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Quote::with('tags')->orderBy('created_at', 'desc');

        if ($request->has('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%'.$search.'%')
                    ->orWhere('text', 'like', '%'.$search.'%');
            });
        }
        $quotes = $query->paginate(10);

        return response(QuoteResource::collection($quotes), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuoteRequest $request)
    {
        try {
            $quote = CreateQuoteAction::execute($request->validated());

            return new QuoteResource($quote);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $quote = Quote::with('tags')->findOrFail($id);

            return new QuoteResource($quote);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Ошибка, такая цитата не существует.',
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreQuoteRequest $request, Quote $quote)
    {
        try {
            $quote = UpdateQuoteAction::execute($request->validated(), $quote);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 422);
        }

        return response(new QuoteResource($quote));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        try {
            $quote = Quote::findOrFail($id);
            Gate::authorize('delete', $quote);

            $quote->delete();

            return response()->json([
                'message' => 'Цитата успешно удалена.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        }
    }
}
