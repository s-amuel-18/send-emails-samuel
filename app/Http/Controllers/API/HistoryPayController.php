<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistoryPayRequest;
use App\Http\Resources\HistoryPayResource;
use App\Models\HistoryPay;
use App\Models\Pay;

class HistoryPayController extends Controller
{
    public function store(HistoryPayRequest $request)
    {
        // $data_insert = [
        //     // "pay_id" => 1,
        //     "payment_amount" => 0.33,
        //     "description" => "actualizado perro",
        //     "type" => 1,
        // ];

        // $history_pay = auth()->user()->history_pay()->create($data_insert);
        // dd(HistoryPay::orderBy("id", "DESC")->first());
        // // $history_pay = new HistoryPay;
        // // $history_pay->description = "Desc";
        // // $history_pay->save();
        // dd($history_pay->id);
        // return (new HistoryPayResource($history_pay))->additional([
        //     "message" => $history_pay->messageType("se ha creado correctamente.")
        // ]);
    }

    public function show(HistoryPay $historyPay)
    {
        dd($historyPay);
        $this->authorize("view", $historyPay);
    }

    public function update(HistoryPayRequest $request, HistoryPay $historyPay)
    {
        //
    }

    public function destroy(HistoryPay $historyPay)
    {
        //
    }
}
