<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Article as ArticleModel;
use app\validate\IntNum;
use app\validate\PageLimit;
use think\facade\Request;

class Article
{
    /**
     * 文章分页查询
     * @return \think\response\Json
     * @throws \think\db\exception\DbException
     */
    public function getList() {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $articleModel = new ArticleModel();
        $page = $articleModel->getList($page, $limit);
        return json([
            'code'  =>  0,
            'msg'   =>  'success',
            'page'  =>  $page
        ]);
    }

    /**
     * 文章详情
     * @param int $id
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getInfo(int $id) {
        Validate(IntNum::class)->check(['num' => $id]);

        $info = ArticleModel::getInfo($id);

        return json([
            'code' => 0,
            'msg' => 'success',
            'info' => $info
        ]);
    }
}
