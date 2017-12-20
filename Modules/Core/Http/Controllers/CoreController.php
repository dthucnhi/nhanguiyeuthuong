<?php

namespace Modules\Core\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Home\Entities\userslist;
use app\helper;
use GuzzleHttp\Client as GuzzleClient;;
use Goutte\Client;
use function PHPSTORM_META\type;
use Illuminate\Support\Facades\Validator;

class CoreController extends Controller
{
    private $helper;
    function __construct()
    {
        $this->helper=new helper();
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('core::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('core::create');
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
        return view('core::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('core::edit');
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
    public function uploadRecording(Request $request){
        $validator = Validator::make($request->all(), [
            'namereceiver' => 'required',
            'phonereceiver' => 'required',
            'namesender' => 'required',
            'phonesender' => 'required',
            'date' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'Message' => 'Vui lòng nhập các thông tin bắt buộc trước khi bắt đầu',
                'Status' => '300',
            ]);
        }
        $userslist = new userslist;
        $filelocation = '/uploads/audio/';
        $vFile1="";
        $vFile2="";
        $i=0;
        if($request->hasFile('audio-blob')){
            $file1 = $request->file('audio-blob');
            $fileName = $request->input('audio-filename');
            $filename1=$filelocation.$fileName;
            $file1->move(public_path().$filelocation,$fileName);
            $randomFileName=rand().".mp3";
            exec("ffmpeg -i /var/www/html/public$filename1 /var/www/html/public$filelocation$randomFileName");
            unlink(public_path().$filename1);
            $vFile1=$filelocation.$randomFileName;
            $i++;
        }
        if($request->hasFile('audio2')){
            $validatorFileAudio= Validator::make($request->all(), [
                'audio2' => 'max:3072|mimes:mpga',
            ]);
            if($validatorFileAudio->fails()){
                return response()->json([
                    'Message' => 'File bạn upload lớn hơn 3MB hoặc không phải là file MP3. Vui lòng thử lại file khác nhé.',
                    'Status' => '300',
                ]);
            }
            $file2 = $request->file('audio2');
            $file2->move(public_path().$filelocation,$file2->getClientOriginalName());
            $filename2=$filelocation.$file2->getClientOriginalName();
            $randomFileName2=rand().".mp3";
            exec("ffmpeg -i /var/www/html/public$filename2 /var/www/html/public$filelocation$randomFileName2");
            unlink(public_path().$filename2);
            $vFile2=$filelocation.$randomFileName2;
            $i++;
        }
        if($request->has('linkfile')){
            $filename2=$request->input('linkfile');
            $randomFileName2=rand().".mp3";
            exec("ffmpeg -i /var/www/html/public$filename2 /var/www/html/public$filelocation$randomFileName2");
            unlink(public_path().$filename2);
            $vFile2=$filelocation.$randomFileName2;
            $i++;
        }
        if($i!=0){
            $data=$userslist->Create(
                [
                    'namereceiver' => $request->get('namereceiver'),
                    'phonereceiver' => $request->get('phonereceiver'),
                    'namesender' => $request->get('namesender'),
                    'phonesender' => $request->get('phonesender'),
                    'vFile1' => $vFile1,
                    'vFile2' => $vFile2,
                    'timecall' => $request->input('date')
                ]
            );
            return response()->json([
                'Message' => 'CloudFone sẽ gửi những yêu thương của bạn đến người ấy trong thời gian sớm nhất!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Vui lòng chọn ghi âm hoặc upload file hoặc thêm link nhạc từ mp3.zing.vn!!',
                'Status' => '300',
            ]);
        }
    }
    public function getLink(Request $request){
        $client = new Client();
        $linkFileDownload=$request->input('link');
        $data=explode('/',$linkFileDownload);
        if($data[0]!='https:')
        {
            return response()->json([
                'Message' => 'Vui lòng thêm https vào link để hệ thống có thể get link bạn nhé !!',
                'Status' => '300',
            ]);
        }

        if($data[2] != 'mp3.zing.vn'){
            return response()->json([
                'Message' => 'Hiện tại chỉ chấp nhận link từ trang nhạc mp3.zing.vn. Vui lòng nhập vào link bài hát từ mp3.zing.vn nhé !!',
                'Status' => '300',
            ]);
        }

        if($data[3] == 'bai-hat')
        {
            $domain=$data[2];
            $type=$data[3];
            $name=$data[4];
            $uri=$data[5];
            $URL="https://mp3.zing.vn/$type/$name/$uri";
            $crawler = $client->request('GET', $URL);
            $result= $crawler->filter('div[id="zplayerjs-wrapper"]')->each(function ($node){
                $data=$node->attr('data-xml');
                $data2=explode("=",$data);
                $key=$data2[2];
                $url="https://mp3.zing.vn/xhr/media/get-source?type=audio&key=$key";
                $client = new Client();
                $crawler = $client->request('GET', $url);
                $data3=json_decode($client->getResponse()->getContent());
                $file=$data3->data->source->{128};
                $linkdownload="https:$file";
                $random=rand();
                $path=public_path()."/uploads/audio/$random.mp3";
                $Final="/uploads/audio/$random.mp3";
                set_time_limit(0);
                $file = file_get_contents($linkdownload);
                if($file != null){
                    file_put_contents($path, $file);
                    return $Final;
                }
                else{
                    return 0;
                }
            });
            if(count($result)>0){
                return response()->json([
                    'Message' => $result[0],
                    'Status' => '200',
                ]);
            }else{
                return response()->json([
                    'Message' => 'Không thể lấy được link này, vui lòng chọn link khác !!',
                    'Status' => '300',
                ]);
            }
        }
        else{
            return response()->json([
                'Message' => 'Không thể lấy file từ link này, bạn vui lòng chọn link bài hát!!',
                'Status' => '300',
            ]);
        }

    }
    public function deleteFile(Request $request){
        $file=$request->input('filedelete');
        $data=explode('/',$file);
        $filemp3=$data[5];
        $url=public_path().'/uploads/audio/'.$filemp3;
        unlink($url);
    }
}
