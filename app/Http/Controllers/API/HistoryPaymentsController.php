<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistoryPaymentsRequest;
use App\Http\Resources\HistoryPaymentsResource;
use App\Models\HistoryPayments;
use Illuminate\Http\Request;

class HistoryPaymentsController extends Controller
{

    public function store(HistoryPaymentsRequest $request)
    {
        $data_insert = [
            "pay_id" => $request["pay_id"],
            "payment_amount" => $request["payment_amount"],
            "description" => $request["description"],
            "type" => $request["type"],
        ];

        $history_pay = auth()->user()->history_pay()->create($data_insert);

        return (new HistoryPaymentsResource($history_pay))->additional([
            "message" => $history_pay->messageType("se ha creado correctamente.")
        ]);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(HistoryPayments $historyPayments)
    {
        $this->authorize("view", $historyPayments);
        return (new HistoryPaymentsResource($historyPayments));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HistoryPaymentsRequest $request, HistoryPayments $historyPayments)
    {
        $this->authorize("view", $historyPayments);

        $data_insert = [
            "pay_id" => $request["pay_id"],
            "payment_amount" => $request["payment_amount"],
            "description" => $request["description"],
            "type" => $request["type"],
        ];

        $historyPayments->update($data_insert);

        return (new HistoryPaymentsResource($historyPayments))->additional([
            "message" => $historyPayments->messageType("se ha actualizado correctamente.")
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(HistoryPayments $historyPayments)
    {
        $this->authorize("view", $historyPayments);
        $historyPayments->delete();
        return (new HistoryPaymentsResource($historyPayments))->additional([
            "message" => $historyPayments->messageType("se ha eliminado correctamente.")
        ]);
    }
}
