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
    public function index2(){
        return view('core::index2');
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
                'Message' => 'Vui lo??ng nh????p ca??c th??ng tin b????t bu????c tr??????c khi b????t ??????u',
                'Status' => '300',
            ]);
        }
        if($request->input('phonereceiver') == $request->input('phonesender')){
            return response()->json([
                'Message' => 'H???? th????ng pha??t hi????n ba??n ??ang t???? ky??, vui lo??ng nh????p s???? ng??????i nh????n va?? s???? ng??????i g????i kha??c nhau ba??n nhe?? !!',
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
                'audio2' => 'max:3072|mimes:mpga,mp3,mpeg',
            ]);
            if($validatorFileAudio->fails()){
                return response()->json([
                    'Message' => 'File ba??n upload l????n h??n 3MB ho????c kh??ng pha??i la?? file MP3. Vui lo??ng th???? la??i file kha??c nhe??.'.$request->file('audio2')->guessExtension(),
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
            if( strpos($request->get('phonereceiver'), ',') !== false ) {
                $arr=explode(',',$request->get('phonereceiver'));
                foreach ($arr as $value){
                    if(!empty($value))
                    {
                        $data=$userslist->Create(
                            [
                                'namereceiver' => $request->get('namereceiver'),
                                'phonereceiver' => $value,
                                'namesender' => $request->get('namesender'),
                                'phonesender' => $request->get('phonesender'),
                                'vFile1' => $vFile1,
                                'vFile2' => $vFile2,
                                'timecall' => $request->input('date')
                            ]
                        );
                    }
                }
            }else{
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
            }

            return response()->json([
                'Message' => 'CloudFone se?? g????i nh????ng y??u th????ng cu??a ba??n ??????n ng??????i ????y trong th????i gian s????m nh????t!!',
                'Status' => '200',
            ]);
        }
        else{
            return response()->json([
                'Message' => 'Vui lo??ng cho??n ghi ??m ho????c upload file ho????c th??m link nha??c t???? mp3.zing.vn!!',
                'Status' => '300',
            ]);
        }
    }
    public function getLink(Request $request){
        $client = new Client();
        $linkFileDownload=$request->input('link');
        if(!filter_var($linkFileDownload,FILTER_VALIDATE_URL)){
            return response()->json([
                'Message' => 'URL ba??n nh????p va??o kh??ng h????p l????. Vui lo??ng nh????p va??o URL h????p l???? nh?? sau: https://mp3.zing.vn/bai-hat/Da-Lo-Yeu-Em-Nhieu-JustaTee/ZW8W6UEF.html !!',
                'Status' => '300',
            ]);
        }

        $data=explode('/',$linkFileDownload);
        if($data[0]!='https:')
        {
            return response()->json([
                'Message' => 'Vui lo??ng th??m https va??o link ?????? h???? th????ng co?? th???? get link ba??n nhe?? !!',
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
                    'Message' => 'H???? th????ng kh??ng th???? ti??m th????y file nha??c t???? link na??y, vui lo??ng nh????p link kha??c !!',
                    'Status' => '300',
                ]);
            }
        }
        else{
            return response()->json([
                'Message' => 'H???? th????ng kh??ng th???? ti??m th????y file nha??c t???? link na??y, ba??n vui lo??ng cho??n link da??ng ba??i ha??t. VD: https://mp3.zing.vn/bai-hat/Da-Lo-Yeu-Em-Nhieu-JustaTee/ZW8W6UEF.html',
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
