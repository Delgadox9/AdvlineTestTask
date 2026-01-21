<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'text' => $request->routeIs('quotes.index') ? Str::limit($this->text, 300) : $this->text,
            'tags' => TagResource::collection($this->tags->sortBy('name')),
            'createdAt' => $this->created_at->locale('ru_RU')->translatedFormat('d F Y'),
        ];
    }
}
