<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Disputes;
use App\Models\DisputesFiles;
use App\Models\Shipments;
use App\Models\Audit;
use App\Models\Customers;
use App\Models\kustomers;
use App\Models\Referral;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;



class DashController extends Controller
{
   
    public function generateUniqueID($email)
    {
        if (!is_null($email)) {
            $arr = explode("@", $email);
            return $arr[0] .'-'.time();
        }
        return '-'.time();
    }

    public function generateReferralCode($l = 8)
    {
        return substr(md5(uniqid(mt_rand(), true)), 0, $l);
    }


    public function dashboard()
    {
        $totalCustomers = DB::table('customers')->count();
        $customerLastWeek  = DB::table('customers')
            ->whereBetween(
                'reg_date',
                [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
            )
            ->count();


        $customerThisWeek  = DB::table('customers')
            ->whereBetween('reg_date', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()->format("Y-m-d H:i:s")])
            ->count();



        if ($customerLastWeek < 1) {
            $percentChange = 0;
        } else {
            $percentChange = ($customerThisWeek - $customerLastWeek) / $customerLastWeek * 100;
        }



        $totalOrders = DB::table('orders')->count();
        $lastWeekOrder = DB::table('orders')
            ->whereBetween(
                'created_at',
                [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
            )->count();


        $thisWeekOrders =  DB::table('orders')
            ->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()->format("Y-m-d H:i:s")])
            ->count();


        if ($lastWeekOrder < 1) {
            $percentChangeOrder = 0;
        } else {
            $percentChangeOrder = ($thisWeekOrders - $lastWeekOrder) / $lastWeekOrder * 100;
        }

        $totalOrderTransactions =   $totalOrders = DB::table('order_transactions')->count();
        $totalOrderTransactionsLastWeek = DB::table('order_transactions')
            ->whereBetween(
                'created_at',
                [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()]
            )->count();

        $totalOrderTransactionsThisWeek =  DB::table('order_transactions')
            ->whereBetween('created_at', [Carbon::now()->subWeek()->format("Y-m-d H:i:s"), Carbon::now()->format("Y-m-d H:i:s")])
            ->count();


        if ($totalOrderTransactionsLastWeek < 1) {
            $percentChangeT = 0;
        } else {
            $percentChangeT = ($totalOrderTransactionsThisWeek -  $totalOrderTransactionsLastWeek) /  $totalOrderTransactionsLastWeek * 100;
        }



        return view('dashboard.dashboard', ['percentChangeT' => $percentChangeT,  'OrderTransactionsThisWeek' => $totalOrderTransactionsThisWeek,  'OrderTransactionsLastWeek' => $totalOrderTransactionsLastWeek,   'OrderTransactions' => $totalOrderTransactions, 'percentChangeOrder' => $percentChangeOrder,  'thisWeekOrders' => $thisWeekOrders, 'lastWeekOrder' => $lastWeekOrder,  'totalorders' => $totalOrders,  'percentChange' => ceil($percentChange), 'customersLastWeek' => $customerLastWeek, 'totalCustomers' => $totalCustomers, 'customersThisWeek' => $customerThisWeek]);
    }

    public function index()
    {
        $collection = DB::table('transactions')->orderBy('id', 'desc')
            ->get(['id', 'pepperest_fee', 'customer_email', 'merchant_email', 'amount', 'description', 'posting_date']);

        return view('dashboard.transactions', ['records' => collect($collection)]);
    }
    public function details($id)
    {
        $details = DB::table('transactions')->find($id);


        return view('dashboard.details', ['details' => collect($details)]);
    }


    public function payments()
    {
        $payments = DB::table('payment_transactions')
            ->join('users', 'payment_transactions.user_id', '=', 'users.id')
            ->select('payment_transactions.id', 'users.name as customer', 'payment_transactions.channel', 'payment_transactions.trans_status', 'payment_transactions.created_at')
            ->orderBy('payment_transactions.id', 'desc')
            ->get();
        // $payments = DB::table('payment_transactions')->get(['id', 'cust_id', 'channel', 'trans_status']);
        return view('dashboard.payments', ['payments' => collect($payments)]);
    }

    public function paymentDetails($id)
    {
        $details = DB::table('payment_transactions')
            ->join('customers', 'payment_transactions.user_id', '=', 'customers.id')
            ->select('payment_transactions.*', 'customers.name as customer')
            ->where('payment_transactions.id', $id)
            ->get()->first();
        //$details = DB::table('payment_transactions')->find($id);

        //dd($details);
        return view('dashboard.pdetails', ['details' => collect($details)]);
    }





    public function order()
    {
        $orders = DB::table('orders')
            ->join('customers', 'user_id', '=', 'customers.id')
            ->join('users', 'merchant_id', '=', 'users.id')
            ->select('orders.id', 'orders.pepperestfees', 'orders.total', 'orders.totalprice', 'orders.orderRef', 'orders.created_at',  'customers.name', 'users.name as merchant')
            ->orderBy('orders.id', 'desc')
            ->get();

        //$orders = DB::table('orders')->get(['id', 'buyer_id', 'pepperestfees', 'total', 'totalprice', 'merchant_id', 'orderRef']);
        return view('dashboard.orders', ['collection' => $orders]);
    }


    public function orderDetails($id)
    {

        //$details = DB::table('orders')->find($id);
        $details = DB::table('orders')
            ->join('customers', 'user_id', '=', 'customers.id')
            ->join('users', 'merchant_id', '=', 'users.id')
            ->select('orders.*',  'customers.name as buyer', 'users.name as merchant', 'customers.address as address')
            ->where('orders.id', $id)
            ->get()->first();
        $items = DB::table('order_items')->where('order_id', $id)->get(['order_id', 'productname', 'price', 'quantity']);


        return view('dashboard.odetails', ['details' => collect($details), 'items' => $items]);
    }

    public function invoices()
    {
        $invoices = DB::table('invoices')->orderBy('id', 'desc')->get(['id', 'totalcost', 'merchantName', 'customerName', 'pepperest_fee', 'vat', 'totalcost', 'subTotal', 'created_at']);
        return view('dashboard.invoices', ['invoices' => $invoices]);
    }

    public function inDetails($id)
    {

        $details = collect(DB::table('invoices')->find($id));


        return view('dashboard.indetails', ['details' => $details, 'files' => collect(DB::table('invoices_files')->where('invoice_id', $id))]);
    }





    public function disputes()
    {
        $data = DB::table('disputes')->orderBy('id', 'desc')->get(['id', 'placed_order_id', 'created_at', 'customer_email', 'arbitrator_name', 'dispute_referenceid', 'dispute_status', 'dispute_category', 'merchant_email']);
        return view('dashboard.disputes', ['data' => $data]);
    }

    public function disputeDetails($id)
    {
        $details = collect(Disputes::where('id', $id)->firstorfail());
        return view('dashboard.disputedetails', ['details' => $details, 'files' => DisputesFiles::where('dispute_id', $id)->get()]);
    }

    public function resolveDispute(Request $request)
    {
        $dis = Disputes::find($request->did);
        $dis->final_resolution =  $request->resolution;
        $dis->dispute_status = 1;
        $dis->resolution_date = date('Y-m-d H:i:s');

        $up = $dis->save();
        if ($up) {
            return redirect()->back()->with('success', 'Dispute resolution data saved');
        } else {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }



    public function shipment()
    {
        $data = DB::table('order_logistics')->orderBy('id', 'desc')->get(['id', 'order_id', 'estimated_days', 'amount', 'delivery_status', 'updated_at', 'type']);
        return view('dashboard.shipment', ['data' => $data]);
    }
    public function shipmentBooked($md)
    {

        $data = collect(Shipments::where('delivery_status', $md)->orderBy('id', 'desc')->get());

        return view('dashboard.booked_shipment', ['data' => $data]);
    }



    public function shipmentDetails($id)
    {
        $details = collect(Shipments::where('id', $id)->first());
        return view('dashboard.shipment_details', ['details' => $details]);
    }




    public function audit_trails()
    {

        $data = DB::table('audit_trails')->orderBy('id', 'desc')->get(['id', 'user_ip', 'user_id', 'event', 'location', 'created_at']);
        return view('dashboard.audit', ['data' => $data]);
    }



    public function auditDetails($id)
    {
        $details = collect(Audit::where('id', $id)->first());
        return view('dashboard.audit_detail', ['details' => $details]);
    }



    public function customers($type)
    {
        // dd($type);
        //$customers = kustomers::orderBy('id', 'desc')->get(['id', 'businessname', 'usertype', 'phone', 'name', 'email', 'reg_date'])->where('usertype', $type);

        $customers = DB::table('customers')
            ->join('users', function ($join) use ($type) {
                $join->on('users.customerID', '=', 'customers.id')
                    ->where('customers.usertype', '=', $type);
            })->orderBy('users.created_at', 'desc')
            ->get();

        return view('dashboard.customers', ['collection' => $customers]);
    }

    public function addCustomerForm(){
        return view('dashboard.customer_add');
    }

    public function addCustomer(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'phone_no' => 'nullable|numeric',
            'acct_type' => 'required|string',
            'businessName' => 'nullable|string|max:255',
            'referral_code' => 'nullable|string|max:25',
        ]);

        try{
            $name = $request->input('name');
            $name_arr = explode (" ", $name);
            $user = Customers::create([
                'name' => $request->input('name'),
                'firstName' =>  isset($name_arr[0]) ? $name_arr[0] : null,
                'lastName' =>  isset($name_arr[1]) ? $name_arr[1] : null,
                'phoneNo' => $request->input('phone_no'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            //dd($user);

            $customer = kustomers::create([
                  'email' => $request->input('email'),
                  'name' => $user->name,
                  'businessname' => $request->input('businessName'), 
                  'phone' => $request->input('phone_no'), 
                  'usertype' => $request->input('acct_type'),
                  'merchantid' => $this->generateUniqueID($request->input('email')),
                  'referral_code' => $this->generateReferralCode()
            ]);

            if (!is_null($customer)) {
              $user->update(['customerID' => $customer->id]);
              
              if ($request->filled('referral_code')) {
                $referrer = kustomers::where('referral_code', $request->input('referral_code'))->first();
                if (!is_null($referrer)) {
                  Referral::create(['referrer_id' => $referrer->id, 
                    'customer_id' => $customer->id, 
                    'customer_type' => $customer->usertype
                  ]);
                }
                
              }
            }

            if ($user && !is_null($customer)) {
                return redirect()->route('customers', ['type' => 'both'])->with('success', 'Customer was Created Successfully. Inform the customer to change the password after login.');
            } else {
                return redirect()->back()->with('error', 'Customer Creation Failed. Please try again.');
            }
            
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Customer Creation Failed with error: '. $e->getMessage());
        }
        
    }

    public function customerdetails($id)
    {
        $data = DB::table('customers')
            ->join('users', 'customers.id', '=', 'users.customerID')
            ->select('customers.*', 'customers.phone', 'users.created_at')
            ->where('users.id', $id)
            ->get()->first();
        $customer = collect($data);
        $customer->forget('pwd');
        //$customer = collect(kustomers::findorfail($id));
        $orders = DB::table('orders')->where('buyer_id', $id)->count();
        return view('dashboard.cdetails', ['collection' => collect($customer), 'orders' => $orders]);
    }


    public function block(Request $request)
    {
        $request->validate(['id' => 'required']);

        $customer = kustomers::find($request->id);
        if ($customer->accountstatus == 0) {
            DB::table('customers')->where('id', $request->id)->update(['accountstatus' => 1]);
            //$customer->accountstatus = 1;
            $action = 'blocked';
        } else {
            $action = 'unblocked';
            DB::table('customers')->where('id', $request->id)->update(['accountstatus' => 0]);
        }

        return back()->with('message', 'Successfully ' . $action . ' customer');
    }

    public function filterTransaction(Request $request)
    {

        $collection = DB::table('orders')
            ->join('customers', 'user_id', '=', 'customers.id')
            ->join('users', 'merchant_id', '=', 'users.id')
            ->select('orders.*', 'customers.name', 'customers.address as address', 'users.name as merchant')
            ->whereBetween('orders.created_at', [$request->from, $request->to])
            ->get();
        //$collection = DB::table($request->table)->whereBetween('created_at', [$request->from, $request->to])->get();

        return view('dashboard.ddorder', ['collection' => $collection]);
    }



    public function downloadOrder(Request $request)
    {
        $fileName = 'order' . $request->from . '-' . $request->to;

        $table = DB::table('orders')
            ->join('customers', 'user_id', '=', 'customers.id')
            ->join('users', 'merchant_id', '=', 'users.id')
            ->select('orders.id', 'orders.pepperestfees', 'orders.total', 'orders.totalprice', 'orders.orderRef',  'customers.name', 'users.name as merchant')
            ->whereBetween('orders.created_at', [$request->from, $request->to])
            ->orderBy('orders.id', 'desc')
            ->get();
        //prepare file
        $output = '';
        foreach ($table as $row) {
            $output .=  implode(",", $row->toArray());
        }
        $headers = array(
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ExportFileName.csv"',
        );
        return response()->stream($output, 200, $headers);
        //        return Response::make(rtrim($output, "\n"), 200, $headers);
    }
}
