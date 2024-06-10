<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Inertia\Inertia;

class QuizApiController extends Controller
{
    public function fetchInsert(){
        $response = Http::get('https://quizapi.io/api/v1/questions',[
            'apiKey' => '0BHS5CQIIuErqGUtlBwvpnTubl9WKP03dJZqjaOX',
            'limit' => 20,
        ]);

        $questions= json_decode($response->body());

        foreach($questions as $q){
            $question = new Question();
            $question->question = $q->question;
            $question->answer_a = $q->answers->answer_a;
            $question->answer_b = $q->answers->answer_b;
            $question->answer_c = $q->answers->answer_c;
            $question->answer_d = $q->answers->answer_d;
            $question->multiple_correct_answer = $q->multiple_correct_answers;
            $question->answer_a_correct = $q->correct_answers->answer_a_correct;
            $question->answer_b_correct = $q->correct_answers->answer_b_correct;
            $question->answer_c_correct = $q->correct_answers->answer_c_correct;
            $question->answer_d_correct = $q->correct_answers->answer_d_correct;
            $question->explanation = $q->explanation;
            $question->category = $q->category;
            $question->difficulty = $q->difficulty;
            
            $question->save();
        }
        // return($response);
        return("Data Fetched from Api and saved in database");

    }
    public function show() {
        $question = Question::all();
        return Inertia::render('Quiz',[
            'question' => $question
        ]);
    }
    //https://opentdb.com
    public function getQuiz(){
        $response = Http::get('https://opentdb.com/api.php?amount=10&category=12');

        $response= json_decode($response->body());

        // $questions= json_decode($response->body());
        // foreach($questions as $q){
        //     $question = new Question();
        //     $question->question = $q->question;
        //     $question->answer_a = $q->answers->answer_a;
        //     $question->answer_b = $q->answers->answer_b;
        //     $question->answer_c = $q->answers->answer_c;
        //     $question->answer_d = $q->answers->answer_d;
        //     $question->multiple_correct_answer = $q->multiple_correct_answers;
        //     $question->answer_a_correct = $q->correct_answers->answer_a_correct;
        //     $question->answer_b_correct = $q->correct_answers->answer_b_correct;
        //     $question->answer_c_correct = $q->correct_answers->answer_c_correct;
        //     $question->answer_d_correct = $q->correct_answers->answer_d_correct;
        //     $question->explanation = $q->explanation;
        //     $question->category = $q->category;
        //     $question->difficulty = $q->difficulty;
            
        //     $question->save();
        // }
        return($response);
        // return("Data Fetched from Api and saved in database");

    }

    public function index() {
      
        return Inertia::render('Quiz/Index');
    }
}
