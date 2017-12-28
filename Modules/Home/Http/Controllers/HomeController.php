<?php

namespace Modules\Home\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Home\Entities\userslist;
use Illuminate\Support\Facades\Validator;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use app\helper;

class HomeController extends Controller
{
    private $helper;
    function __construct()
    {
        $this->helper=new helper();
    }

    public function saveinfo(Request $request)
    {
        $userslist = new userslist;
        $validator = Validator::make($request->all(), [
            'namereceiver' => 'required',
            'phonereceiver' => 'required',
            'namesender' => 'required',
            'phonesender' => 'required',
            'file1' => 'required|max:3072|mimes:mpga',
            'file2' => 'required|max:3072|mimes:mpga',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Message' => json_encode($validator->errors()),
                'Status' => '300',
            ]);
        }
        else{
            $file1 = $request->file1;
            $filelocation = '/uploads/audio/';
            $file1->move(public_path().$filelocation,strtolower($this->helper->removeDau($file1->getClientOriginalName())));
            $filename1=$filelocation.strtolower($this->helper->removeDau($file1->getClientOriginalName()));

            $file2 = $request->file2;
            $filelocation = '/uploads/audio/';
            $file2->move(public_path().$filelocation,strtolower($this->helper->removeDau($file2->getClientOriginalName())));
            $filename2=$filelocation.strtolower($this->helper->removeDau($file2->getClientOriginalName()));


            if( strpos($request->get('phonereceiver'), ',') !== false ) {
                $arr=explode(',',$request->get('phonereceiver'));
                foreach ($arr as $value){
                    $data=$userslist->Create(
                        [
                            'namereceiver' => $request->get('namereceiver'),
                            'phonereceiver' => $value,
                            'namesender' => $request->get('namesender'),
                            'phonesender' => $request->get('phonesender'),
                            'vFile1' => $filename1,
                            'vFile2' => $filename2,
                            'timecall' => $request->input('date')
                        ]
                    );
                }
            }else{
                $data=$userslist->Create(
                    [
                        'namereceiver' => $request->get('namereceiver'),
                        'phonereceiver' => $request->get('phonereceiver'),
                        'namesender' => $request->get('namesender'),
                        'phonesender' => $request->get('phonesender'),
                        'vFile1' => $filename1,
                        'vFile2' => $filename2,
                        'timecall' => $request->input('date')
                    ]
                );
            }
            $datepicker=explode(" ",$request->input('date'));
            $time=explode(":",$datepicker[1]);
            $hour=$time[0];
            $minute=$time[1];
            $date=explode("-",$datepicker[0]);
            $day=$date[0];
            $month=$date[1];
            $year=$date[2];
            if($data != null){
//                $client = new Client();
//                $Url="http://103.237.148.29/modules/test.php?url1=http://45.117.167.4".$data->vFile1."&url2=http://45.117.167.4".$data->vFile2."&time=".$hour.":".$minute."&day=".$year."-".$month."-".$day."&phoneNumber=".$data->phonereceiver."&id=".$data->id;
//                $request = $client->get($Url);
//                $response = $request->getBody();
//                dd($response);
//                $req=file_get_contents($Url);
                return response()->json([
                    'Message' => 'CloudFone sẽ gửi những yêu thương của bạn đến người ấy trong thời gian sớm nhất!!',
                    'Status' => '200',
                ]);
            }
            else{
                return response()->json([
                    'Message' => 'Không thể gửi!!',
                    'Status' => '300',
                ]);
            }
        }


    }
    public function updateIsCall($id){
        $userslist = new userslist;
        $data=$userslist->where('id', '=',$id)
            ->update(
            [
                'iCall' => 1,
            ]
        );
        $infoUser=$userslist->GetDataById($id);
        $client = new Client();
        $Url="http://103.237.148.167/modules/noticeaftercall.php?phoneNumber=$infoUser->phonesender";
        $request = $client->get($Url);
        $response = $request->getBody();
        if($data==1){
            return response()->json([
                'Message' => 'Update id '.$id.' thành công!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Update id '.$id.' thất bại!!',
                'Status' => '300',
            ]);
        }
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function popup(){
        return view('home::popup');
    }

    public function index()
    {
        return view('home::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('home::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('home::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('home::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
