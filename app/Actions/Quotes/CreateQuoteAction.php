<?php

namespace App\Actions\Quotes;

use App\Models\Quote;
use Illuminate\Support\Facades\DB;

class CreateQuoteAction
{
    /**
     * @throws \Throwable
     */
    public static function execute(mixed $request): Quote
    {
        return DB::transaction(function () use ($request) {
            $quote = Quote::create($request);
            SyncTagsAction::execute($quote, $request['tags']);

            return $quote;
        });
    }
}
