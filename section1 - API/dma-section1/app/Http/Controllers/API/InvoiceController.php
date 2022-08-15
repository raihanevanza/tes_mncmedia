<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice as InvoiceModels;
use App\Models\Product as ProductModels;
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
    }

    public function show($date)
    {
        // $result = InvoiceModels::where('date', 'LIKE', '%' . $date . '%')->get();
        // $result = InvoiceModels::join('product_schema', 'product_schema.product_id', '=', 'invoice_schema.listofproduct_sold')
        $result = DB::table("product_schema")
            ->select("invoice_schema.invoice_no", "invoice_schema.date", "invoice_schema.customer_name", "invoice_schema.salesperson_name", "invoice_schema.payment_type", "invoice_schema.customer_name", "invoice_schema.notes", "product_schema.item_name", "product_schema.quantity", DB::raw("SUM(product_schema.totalprice_sold - product_schema.totalcostofgoods_sold ) as keuntungan"))
            ->join('invoice_schema', 'product_schema.product_id', '=', 'invoice_schema.listofproduct_sold')
            ->whereDate('date', $date)
            ->groupBy('product_schema.product_id')
            ->get();
        if ($result) {
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

        $invoice->date = $input['date'];
        $invoice->customer_name = $input['customer_name'];
        $invoice->salesperson_name = $input['salesperson_name'];
        $invoice->payment_type = $input['payment_type'];
        $invoice->listofproduct_sold = $input['listofproduct_sold'];
        $invoice->save();
        return response()->json(['message' => 'Update Success']);
    }

    public function delete($id)
    {
        $delete = DB::table('invoice_schema')->where(['invoice_no' => $id])->delete();
        if ($delete) {
            return response()->json([
                'status' => 500,
                'message' => "Delete Success"
            ], 200);
        } else {
            return response()->json(['message' => 'Delete Error']);
        }
    }
}
