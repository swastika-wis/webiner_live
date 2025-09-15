<?php

namespace App\Http\Controllers;

use App\Models\QNAModel;
use Illuminate\Http\Request;

class QNAController extends Controller
{
    public function user_qna_submission(Request $request)
    {
        QNAModel::create([
            'meeting_id'=>$request->meeting_id,
            'ask_by'=>$request->participant_id,
            'question'=>$request->user_question
        ]);

        return response(['message' => 'success'], 200);
    }

    public function vendor_qna_submission(Request $request)
    {
        QNAModel::where('id',$request->record_id)
            ->update(['answer'=>$request->answer]);
        return response(['message' => 'success'], 200);
    }
}
