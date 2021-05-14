<?php
declare (strict_types = 1);

namespace app\model;

use think\exception\HttpException;
use think\facade\Config;
use think\Model;

/**
 * @mixin \think\Model
 */
class User extends Model
{
    /**
     * 用户分页查询
     * @param int $page
     * @param int $limit
     * @return \think\Paginator
     * @throws \think\db\exception\DbException
     */
    public function getList(int $page, int $limit, string $type) {
        $types = [
            Config::get('utils.NORMAL_USER'),
            Config::get('utils.DQ_SINGER'),
            Config::get('utils.DQ_OFFICIAL_ACCOUNT'),
        ];
        if (in_array($type, $types, true)) {
            return $this->where('type', $type)->paginate([
                'list_rows' =>  $limit,
                'page'      =>  $page
            ]);
        } else {
            return $this->paginate([
                'list_rows' =>  $limit,
                'page'      =>  $page
            ]);
        }

    }

    /**
     * 用户信息
     * @param int $id
     * @return array|Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getInfo(int $id) {
        $info = self::find($id);
        if (!$info) {
            throw new HttpException(404, '当前用户不存在');
        }
        return $info;
    }
}
