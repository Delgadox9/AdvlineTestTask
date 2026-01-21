<?php

namespace App\Actions\Quotes;

use App\Models\Quote;
use App\Models\Tag;

final class SyncTagsAction
{
    /**
     * @throws \Throwable
     */
    public static function execute(Quote $quote, array $tags): void
    {
        if (empty($tags)) {
            return;
        }

        $existingTags = Tag::whereIn('name', $tags)->get();

        if ($existingTags->count() !== count($tags)) {
            $missing = array_diff(
                $tags,
                $existingTags->pluck('name')->all()
            );

            $errorMessage = count($missing) == 1 ? 'Ошибка, тэга с таким названием не существует - '
                                                 : 'Ошибка, тэги с такими названиями не существуют - ';
            $errorMessage .= implode(', ', $missing);

            throw new \Exception($errorMessage);
        }

        $quote->tags()->sync($existingTags->pluck('id'));
    }
}
