<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterTimeRequest;
use App\Http\Requests\ImportRequest;
use App\Http\Requests\UpdateSpamTimeRequest;
use App\Models\Customer;
use App\Models\CustomerPage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    public function view_import()
    {
        return view('import');
    }

    public function view_filter_fb_send_time()
    {
        return view('filter_fb_send_time');
    }

    public function view_filter_all_time()
    {
        return view('filter_all_time');
    }

    public function view_filter_spam_time()
    {
        return view('filter_spam_time');
    }

    public function view_index()
    {
        return view('index');
    }

    public function view_update_spam_time()
    {
        return view('update_spam_time');
    }

    public function import(ImportRequest $request)
    {
        try {
            $data = (convert_data($request->user_data));
            if (count($data) > 2000) {
                return 'Chỉ nhập <= 2000 bản ghi';
            }
            $customerIds = [];
            foreach ($data as $item) {
                array_push($customerIds, $item[0]);
            }
            foreach ($data as $item) {
                if (in_array($item[0], $this->checkUserExist($customerIds))) {
                    $dataUpdateCustomer = [
                        'name' => $item[1],
                        'gender' => $item[4],
                    ];

                    $dataUpdateCustomerPage = [
                        'fb_user_inbox_id' => $item[2],
                        'fb_send_time' => $item[3],
                    ];

                    Customer::where('code', $item[0])->update($dataUpdateCustomer);
                    CustomerPage::where('fb_user_id', $item[0])->update($dataUpdateCustomerPage);
                } else {
                    $customer = new Customer();
                    $customer->code = $item[0];
                    $customer->name = $item[1];
                    $customer->gender = $item[4];
                    $customer->spam_time = config('constants.SPAM_TIME_DEFAULT');
                    $customer->save();

                    $page = new CustomerPage();
                    $page->fb_user_id = $item[0];
                    $page->page_code = $request->page_id;
                    $page->fb_user_inbox_id = $item[2];
                    $page->fb_send_time = $item[3];
                    $page->save();
                }
            }
            return back()->with('import', 'Import thành công ');
        } catch (\Exception $exception) {
            Log::error($exception);
            return 'Dữ liệu sai format!';
        }

    }

    public function checkUserExist($customerIds)
    {
        try {
            $customers = CustomerPage::whereIn('fb_user_id', $customerIds)->get();
            $customerExistIds = [];
            foreach ($customers as $value) {
                array_push($customerExistIds, $value->fb_user_id);
            }
            return $customerExistIds;
        } catch (\Exception $exception) {
            return 'Lỗi server';
        }
    }

    public function update_spam_time(UpdateSpamTimeRequest $request)
    {
        try {
            $data = (convert_data($request->user_data));
            if (count($data) > 1500) {
                return 'Chỉ nhập <= 1500 bản ghi';
            }
            $dataSpamTime = ['spam_time' => $request->spam_time];
            foreach ($data as $item) {
                Customer::where('code', $item[0])->update($dataSpamTime);
            }
            return back()->with('update', 'Update spam time thành công!');
        } catch (\Exception $exception) {
            Log::error($exception);
            return 'Dữ liệu sai format!';
        }
    }

    public function fill_spam_time(FilterTimeRequest $request)
    {
        try {
            $response = DB::table('customers')
                ->select('customers.code', 'customers.name', 'customer_pages.fb_user_inbox_id', 'customer_pages.fb_send_time', 'customers.gender')
                ->join('customer_pages', 'customers.code', '=', 'customer_pages.fb_user_id')
                ->where('customer_pages.page_code', $request->page_id)
                ->whereBetween('customers.spam_time', [$request->begin_time, $request->end_time])
                ->limit($request->limit)
                ->get();
            foreach ($response as $item) {
                echo implode("|", (array)$item) . "<br>";
            }
        } catch (\Exception $exception) {
            Log::error($exception);
            return 'Lỗi server';
        }
    }

    public function fill_all(FilterTimeRequest $request)
    {
        try {
            $response = DB::table('customers')
                ->select('customers.code', 'customers.name', 'customer_pages.fb_user_inbox_id', 'customer_pages.fb_send_time', 'customers.gender')
                ->join('customer_pages', 'customers.code', '=', 'customer_pages.fb_user_id')
                ->where('customer_pages.page_code', $request->page_id)
                ->whereBetween('customers.spam_time', [$request->begin_time, $request->end_time])
                ->whereBetween('customer_pages.fb_send_time', [$request->begin_time, $request->end_time])
                ->limit($request->limit)
                ->get();
            foreach ($response as $item) {
                echo implode("|", (array)$item) . "<br>";
            }
        } catch (\Exception $exception) {
            Log::error($exception);
            return 'Lỗi server';
        }
    }

    public function fill_fb_send_time(FilterTimeRequest $request)
    {
        try {
            $response = DB::table('customers')
                ->select('customers.code', 'customers.name', 'customer_pages.fb_user_inbox_id', 'customer_pages.fb_send_time', 'customers.gender')
                ->join('customer_pages', 'customers.code', '=', 'customer_pages.fb_user_id')
                ->where('customer_pages.page_code', $request->page_id)
                ->whereBetween('customer_pages.fb_send_time', [$request->begin_time, $request->end_time])
                ->limit($request->limit)
                ->get();
            foreach ($response as $item) {
                echo implode("|", (array)$item) . "<br>";
            }
        } catch (\Exception $exception) {
            Log::error($exception);
            return 'Lỗi server';
        }
    }

}
