<?php
namespace app;

use app\model\User;
use think\Model;

/**
 * @mixin \think\Model
 */
class BaseModel extends Model
{
    /**
     * 关联模型 相对关联
     * @return \think\model\relation\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'userId', 'id');
    }
}