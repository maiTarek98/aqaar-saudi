<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\About\StoreQuestionAnswerRequest;
use App\Models\QuestionAnswer;
use Illuminate\Http\Request;
class QuestionAnswerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:question_answer-list|question_answer-create|question_answer-edit|question_answer-delete', ['only' => ['index','store']]);
        $this->middleware('permission:question_answer-list', ['only' => ['show']]);
        $this->middleware('permission:question_answer-create', ['only' => ['create','store']]);
        $this->middleware('permission:question_answer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:question_answer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $request = request();
        $fields = ['question','answer'];
        $searchQuery = trim($request->query('search'));

        $question_answers = QuestionAnswer::query();

        if($request->query('from_date')){
            $question_answers = $question_answers->whereDate('created_at','>=',date($request->query('from_date')));
        }
        if($request->query('to_date')){
            $question_answers = $question_answers->whereDate('created_at','<=',date($request->query('to_date')));
        }

        $question_answers = $question_answers->where('question_'.app()->getLocale(), 'like',  '%' . $searchQuery .'%')->orWhere('answer_'.app()->getLocale(), 'like',  '%' . $searchQuery .'%');
            
        $question_answers = $question_answers->orderBy('id', 'asc')->paginate(30);

        return view('admin.question_answers.index', compact('question_answers'));
    }


    public function create()
    {
        $question_answer = new QuestionAnswer() ;
        return view('admin.question_answers.create' , compact('question_answer'));
    }


    public function store(StoreQuestionAnswerRequest $request)
    {
        $data = $request->validated();
        $question_answer = QuestionAnswer::create($data);        
        return redirect()->route('question_answers.index')->with('success',trans('messages.AddSuccessfully'));
    }

    public function show(QuestionAnswer $question_answer)
    {
        return view('admin.question_answers.show', compact('question_answer') );
    }

    public function edit(QuestionAnswer $question_answer)
    {
        return view('admin.question_answers.edit' , compact('question_answer'));
    }

    public function update(StoreQuestionAnswerRequest $request,QuestionAnswer $question_answer)
    {
       $data = $request->validated();
        $question_answer->update($data);
        return redirect()->route('question_answers.index')->with('success',trans('messages.UpdateSuccessfully'));
    }


    public function destroy(QuestionAnswer $question_answer)
    {
        $question_answer->delete();
        return redirect()->route('question_answers.index')->with('success',trans('messages.DeleteSuccessfully'));
    }
    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        QuestionAnswer::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=> trans('messages.RecordsDeleteSuccessfully')]);
    }

    public function changeStatus(QuestionAnswer $question_answer){
        $is_logged = (request('is_logged') == 'on')? 'yes' :'no';
        $question_answer->update(['is_logged' =>$is_logged]);      
        return redirect()->route('question_answers.index')->with('success',trans('messages.UpdateSuccessfully'));

    }
}