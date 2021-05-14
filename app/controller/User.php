<?php

namespace app\controller;

use app\validate\IntNum;
use app\model\User as UserModel;
use app\validate\PageLimit;
use think\facade\Request;

class User
{
    /**
     * 用户分页查询
     * @return \think\response\Json
     * @throws \think\db\exception\DbException
     */
    public function getList() {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');
        $type = (string)Request::post('type');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $userModel = new UserModel();
        $page = $userModel->getList($page, $limit, $type);
        return json([
            'code'  =>  0,
            'msg'   =>  'success',
            'page'  =>  $page
        ]);
    }

    /**
     * 用户信息
     * @param int $id
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getInfo(int $id) {
        Validate(IntNum::class)->check(['num' => $id]);

        $info = UserModel::getInfo($id);

        return json([
            'code' => 0,
            'msg' => 'success',
            'info' => $info
        ]);
    }
}