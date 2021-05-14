<?php
declare (strict_types = 1);

namespace app\model;

use app\BaseModel;
use think\exception\HttpException;

class Video extends BaseModel
{
    /**
     * 视频分页查询
     * @param int $page
     * @param int $limit
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getList(int $page, int $limit) {
        return $this->with('user')->paginate([
            'list_rows' =>  $limit,
            'page'      =>  $page
        ]);
    }

    /**
     * 视频详情
     * @param int $id
     * @return array|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getInfo(int $id) {
        $info = self::with('user')->find($id);
        if (!$info) {
            throw new HttpException(404, '视频资源不存在');
        }
        return $info;
    }
}
