<?php

namespace App\Http\Controllers\Word;

use App\Http\Controllers\Controller;
use App\Models\Word;
use Illuminate\Http\Request;

class AnswerQuestionController extends Controller
{
    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'word_id' => 'required|exists:words,id',
            'answer'  => 'required'
        ]);

        $word = Word::find($request->word_id);
        $user = $request->user();
        $correct = true;

        if (strtolower($request->answer) !== strtolower($word->word)) {
            $user->score -= 5;
            $correct = false;
        } else {
            $user->score += 10;
        }

        $user->words()->attach($word->id, ['is_correct' => $correct]);
        $user->save();

        return $user;
    }
}
