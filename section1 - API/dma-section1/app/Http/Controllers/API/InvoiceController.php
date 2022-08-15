<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice as InvoiceModels;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Invoice as InvoiceResource;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class InvoiceController extends Controller
{

    public function index()
    {
        $invoice = InvoiceModels::all();
        return response()->json(['data' => $invoice]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'invoice_no' => 'required|numeric|min:1',
            'date' => 'required',
            'customer_name' => 'required|string|min:2',
            'salesperson_name' => 'required|string|min:2',
            'payment_type' => 'required|in:CASH,CREDIT',
            'notes' => 'string|min:5',
            'listofproduct_sold' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => $validator->getMessageBag()
            ], 200);
        }

        foreach ($request->listofproduct_sold as $product_id) {
            $input['listofproduct_sold'] = $product_id;
            $invoice = InvoiceModels::create($input);
        }

        return response()->json(['message' => 'Insert Success']);
    }

    public function show($date)
    {
        $result = InvoiceModels::where('date', 'LIKE', '%' . $date . '%')->get();
        if (count($result)) {
            return Response()->json($result);
        } else {
            return response()->json(['Result' => 'No Data not found'], 404);
        }
    }

    public function update(Request $request, InvoiceModels $invoice)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'date' => 'required',
            'customer_name' => 'required|string|min:2',
            'salesperson_name' => 'required|string|min:2',
            'payment_type' => 'required|in:CASH,CREDIT',
            'notes' => 'string|min:5',
            'listofproduct_sold' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'message' => $validator->getMessageBag()
            ], 200);
        }

        DB::table('invoice_schema')->where(['invoice_no' => $request->invoice_no])->delete();

        foreach ($request->listofproduct_sold as $product_id) {
            $input['listofproduct_sold'] = $product_id;
            $invoice = InvoiceModels::create($input);
        }

        // $invoice->invoice_name = $input['invoice_name'];
        $invoice->date = $input['date'];
        $invoice->customer_name = $input['customer_name'];
        $invoice->salesperson_name = $input['salesperson_name'];
        $invoice->payment_type = $input['payment_type'];
        $invoice->listofproduct_sold = $input['listofproduct_sold'];
        $invoice->save();
        return response()->json(['message' => 'Update Success']);
    }
}
