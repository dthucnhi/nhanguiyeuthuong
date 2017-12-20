<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class userslist extends Model
{
    protected $table = "userslist";
    protected $fillable = ['namereceiver', 'phonereceiver', 'namesender', 'phonesender','vFile1','vFile2','timecall'];
    public function GetListAll($option,$key,$pageindex,$pageSize){
        Paginator::currentPageResolver(function () use ($pageindex) {
            return $pageindex;
        });
        $data="";
        switch ($option){
            case 0:
                $data= $this->where('iSeen','=','0')
                    ->where('iAllow','=','0')
                    ->where('namereceiver','like','%'.$key.'%')
                    ->where('phonereceiver','like','%'.$key.'%')
                    ->where('namesender','like','%'.$key.'%')
                    ->where('phonesender','like','%'.$key.'%')
                    ->where('created_at','like','%'.$key.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageSize);
                break;
            case 1:
                $data= $this->where('iSeen','=','1')
                    ->where('iAllow','=','1')
                    ->where('namereceiver','like','%'.$key.'%')
                    ->where('phonereceiver','like','%'.$key.'%')
                    ->where('namesender','like','%'.$key.'%')
                    ->where('phonesender','like','%'.$key.'%')
                    ->where('created_at','like','%'.$key.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageSize);
                break;
            case 2:
                $data= $this->where('namereceiver','like','%'.$key.'%')
                    ->Orwhere('phonereceiver','like','%'.$key.'%')
                    ->Orwhere('namesender','like','%'.$key.'%')
                    ->Orwhere('phonesender','like','%'.$key.'%')
                    ->Orwhere('created_at','like','%'.$key.'%')
                    ->orderBy('created_at', 'desc')
                    ->paginate($pageSize);
                break;
        }
        return $data;

    }
    public function GetDataById($id){
        return $this->where('id','=',$id)->first();
    }
    public function updateAllow($id){
        return $this
            ->where('id','=',$id)
            ->update(
                [
                    'iAllow' => 1,
                    'userAllow' => Auth::user()->name,
                    'iSeen' => 1
                ]
            );
    }
    public function updateDeny($id){
        return $this
            ->where('id','=',$id)
            ->update(
                [
                    'iAllow' => 0,
                    'userAllow' => Auth::user()->name,
                    'iSeen' => 1
                ]
            );
    }
}
