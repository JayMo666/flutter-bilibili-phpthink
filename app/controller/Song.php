<?php
declare (strict_types = 1);

namespace app\controller;

use app\model\Song as SongModel;
use app\validate\IntNum;
use app\validate\PageLimit;
use think\facade\Request;

class Song
{
    /**
     * 歌曲分页查询
     * @return \think\response\Json
     * @throws \think\db\exception\DbException
     */
    public function getList() {
        $page = (int)Request::post('page');
        $limit = (int)Request::post('limit');

        validate(PageLimit::class)->check(['page' => $page, 'limit' => $limit]);

        $songModel = new SongModel();
        $page = $songModel->getList($page, $limit);
        return json([
            'code'  =>  0,
            'msg'   =>  'success',
            'page'  =>  $page
        ]);
    }

    /**
     * 歌曲详情
     * @param int $id
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getInfo(int $id) {
        Validate(IntNum::class)->check(['num' => $id]);

        $info = SongModel::getInfo($id);

        return json([
            'code' => 0,
            'msg' => 'success',
            'info' => $info
        ]);
    }
}
