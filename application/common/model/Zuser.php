<?php 
namespace app\common\model;

use think\Model;

class Zuser extends Model
{
    public function add($data){
        $data['sex'] = 1;
        $data['name'] = 'bobo888';
        return $this->save($data);
    }
}
