<?php

namespace App\Actions\Quotes;

use App\Models\Quote;
use Illuminate\Support\Facades\DB;

class UpdateQuoteAction
{
    /**
     * @throws \Throwable
     */
    public static function execute(mixed $request, Quote $quote): Quote
    {
        return DB::transaction(function () use ($request, $quote) {
            $quote->update($request);
            SyncTagsAction::execute($quote, $request['tags']);

            return $quote;
        });
    }
}
