<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Recommend as RecommendModel;
use app\validate\PageLimit;
use think\facade\Request;

// 推荐
class Recommend
{
    /**
     * 获取推荐数据
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getList() {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $recommendModel = new RecommendModel();
        $page = $recommendModel->getList($page, $limit);
        return json([
            'code'  =>  0,
            'msg'   =>  'success',
            'page'  =>  $page
        ]);
    }
}
