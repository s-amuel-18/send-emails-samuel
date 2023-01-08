<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PayRequest;
use App\Http\Resources\PayResource;
use App\Models\HistoryPay;
use App\Models\Pay;
use Illuminate\Http\Request;
use App\Models\Image as ModelImage;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments =  PayResource::collection(
            auth()
                ->user()
                ->pay()
                // ->with("history_pay")
                ->paginate(10)
        );
        return ($payments)->additional(
            ["msg" => "dsadas "]
        );
        // ? ->response()
        // ? ->setStatusCode(Aqui colocamos el status de la consulta);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PayRequest $request)
    {
        $file_img = $request->file("image");

        if ($file_img) {
            $resize = [
                "fit" => [
                    "fit_x" => 100,
                    "fit_y" => 100
                ],
            ];


            $url_img = ModelImage::store_image($file_img, $resize, "pagos");
        }

        $data_insert = [
            "name" => $request["name"],
            "payment_amount" => $request["payment_amount"],
            "description" => $request["description"],
            "type" => $request["type"],
            "image_url" => $url_img ?? null
        ];

        $pay = auth()->user()->pay()->create($data_insert);
        return (new PayResource($pay))->additional([
            "message" => "El pago se ha creado correctamente.",
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function show(Pay $pay)
    {
        $this->authorize("view", $pay);

        return (new PayResource($pay));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pay $pay)
    {
        $this->authorize("view", $pay);
        $file_img = $request->file("image");

        $data_insert = [
            "name" => $request["name"],
            "payment_amount" => $request["payment_amount"],
            "description" => $request["description"],
            "type" => $request["type"],
        ];

        if ($file_img) {
            $resize = [
                "fit" => [
                    "fit_x" => 100,
                    "fit_y" => 100
                ],
            ];

            $url_img = ModelImage::store_image($file_img, $resize, "pagos");

            $data_insert["image_url"] = $url_img;
        }

        $pay->update($data_insert);
        return (new PayResource($pay))->additional([
            "message" => "El pago se ha actualizado correctamente.",
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pay  $pay
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pay $pay)
    {
        $this->authorize("view", $pay);

        $pay->delete();
        return (new PayResource($pay))->additional([
            "message" => "El pago se ha eliminado correctamente.",

        ]);
    }
}
