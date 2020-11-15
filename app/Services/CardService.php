<?php 

namespace App\Services;

use App\Models\Card;
use Storage;

class CardService 
{
    public function updateOrCreate($data)
    {
        $card = Card::where('id', $data->id)->first();
        if (!$card) {
            $card = new Card;
            $card->id = $data->id;
        }

        $card->name = $data->name;
        $card->maxLevel = $data->maxLevel;
        $card->setType();
        $card->save();

        $url = $data->iconUrls->medium;
        $content = file_get_contents($url);
        $name = 'images/cards/card_' . $card->id . '.png';
        Storage::disk('public')->put($name, $content);
    }
}