<?php

namespace Modules\Admin\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Admin\Entities\userslist;

use GuzzleHttp\Client;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    private $userlist;
    function __construct()
    {
        $this->userlist=new userslist();
    }

    public function index()
    {
        if (Auth::check())
        {
            return redirect('admin/dashboard');
        } else {
            return view('admin::login');
        }
    }
    public function dashboard(){
        if (Auth::check())
        {
            return view('admin::dashboard');
        } else {
            return redirect('admin/');
        }
    }
    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(array('name' => $username, 'password' => $password)))
        {
            return redirect('admin/dashboard');
        } else {
            return redirect('admin/');
        }
    }
    public function logout(){
        Auth::logout();
        if (Auth::check())
        {
            return view('admin::dashboard');
        } else {
            return redirect('admin/');
        }
    }
    public function ListJson(Request $request){
        $pageindex = $request->input('page')-1;
        $pageSize = $request->input('pageSize');
        $key=$request->input('KeyCode');
        $option = $request->input('Option');
        $result=array();
        $result['Total']=0;
        $result['Data']=[];
        $list = $this->userlist->GetListAll($option,$key,$pageindex,$pageSize);
        if(count($list)>0){
            $result['Total']=$list->total();
            $result['Data']=$list->items();
        }
        $DataSource = (object) [
            'Data' => $result['Data'],
            'Total' => $result['Total'],
            'Errors' => ''
        ];
        return response()->json($DataSource);
    }
    public function Allow(Request $request){
        $ID=$request->input('id');
        $data=$this->userlist->updateAllow($ID);
        if($data == 1){
            $isCall=$this->Call($ID);
            if ($isCall == 1)
            {
                return response()->json([
                    'Message' => 'Đã cho phép tổng đài thực hiện cuộc gọi!!',
                    'Status' => '200',
                ]);
            }
        }
        else
        {
            return response()->json([
                'Message' => 'Lỗi. Yêu cầu duyệt không thành công!!',
                'Status' => '300',
            ]);
        }
    }
    public function Deny(Request $request){
        $ID=$request->input('id');
        $data=$this->userlist->updateDeny($ID);
        if($data == 1){
            return response()->json([
                'Message' => 'Đã hủy cuộc gọi này!!',
                'Status' => '200',
            ]);
        }
        else
        {
            return response()->json([
                'Message' => 'Lỗi. Yêu cầu duyệt không thành công!!',
                'Status' => '300',
            ]);
        }
    }
    public function Call($id){
        $data=$this->userlist->GetDataById($id);
        if($data->iAllow == 1){
            $datepicker=explode(" ",$data->timecall);
            $time=explode(":",$datepicker[1]);
            $hour=$time[0];
            $minute=$time[1];
            $date=explode("-",$datepicker[0]);
            $day=$date[0];
            $month=$date[1];
            $year=$date[2];
            $client = new Client();
            if($data->vFile1!=''){
                $File1="http://45.117.167.4$data->vFile1";
            }
            else{
                $File1="";
            }
            if($data->vFile2!=''){
                $File2="http://45.117.167.4$data->vFile2";
            }
            else{
                $File2="";
            }
            $Url="http://103.237.148.167/modules/test.php?url1=".$File1."&url2=".$File2."&time=".$hour.":".$minute."&day=".$year."-".$month."-".$day."&phoneNumber=".$data->phonereceiver."&id=".$data->id;
            $request = $client->get($Url);
            $response = $request->getBody();
            return 1;
        }
        else{
            return 0;
        }
    }
}
