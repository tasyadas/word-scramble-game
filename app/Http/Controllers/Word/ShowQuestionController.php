<?php

namespace App\Http\Controllers\Word;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class ShowQuestionController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function __invoke(Request $request)
    {
        $word = null;
        $history = $request->user()->words;

        if (count($history)) {
            $word = Word::whereNotIn('id', $history->pluck('id'))->inRandomOrder()->first();

            if (null == $word) {
                $kata = $this->generate();
                $word = Word::create(['word' => $kata]);
            }
        }
        else {
            $word = Word::inRandomOrder()->first();
        }
        dd($word);

        return [
            'word_id'  => $word->id,
            'question' => str_shuffle($word->word)
        ];
    }

    /**
     * @return mixed|string
     */
    private function generate()
    {
        $pspell_link = pspell_new("en");
        $kata = $this->readableRandomString();

        if (!pspell_check($pspell_link, $kata)) {
            $kata = pspell_suggest($pspell_link, $kata);
            $kata = $kata[array_rand($kata)];
        }

        return $kata;
    }

    /**
     * @param int $length
     *
     * @return string
     */
    private function readableRandomString($length = 6)
    {
        $string = '';
        $vowels = array("a","e","i","o","u");
        $consonants = array(
            'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm',
            'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
        );

        $max = $length / 2;
        for ($i = 1; $i <= $max; $i++)
        {
            $string .= $consonants[rand(0,19)];
            $string .= $vowels[rand(0,4)];
        }

        return $string;
    }
}
