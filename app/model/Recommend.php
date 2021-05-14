<?php
declare (strict_types = 1);

namespace app\model;

use think\facade\Config;

class Recommend
{
    /**
     * 获取推荐数据
     * @param int $page
     * @param int $limit
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getList(int $page, int $limit) {
        // 获取从 $page 行开始的 $limit 条的数据
        $users = $this->getUsers($page, $limit)->toArray();
        $songs = $this->getSongs($page, $limit)->toArray();
        $articles = $this->getArticles($page, $limit)->toArray();
        $videos = $this->getVideos($page, $limit)->toArray();

        // 获取 $limit 长度的 $models 随机组合的数组
        $models = ['user', 'song', 'article', 'video'];
        $randModels = $this->getRandModels($limit, $models);

        $result = [];
        foreach ($randModels as $key => $value) {
            switch ($value) {
                case $models[0]:
                    // 获取歌手推荐
                    $result[$key][$value.'Entity'] = array_key_exists($key, $users) ? $users[$key] : null;
                    break;
                case $models[1]:
                    // 获取歌曲推荐
                    $result[$key][$value.'Entity'] = array_key_exists($key, $songs) ? $songs[$key] : null;
                    break;
                case $models[2]:
                    // 获取文章推荐
                    $result[$key][$value.'Entity'] = array_key_exists($key, $articles) ? $articles[$key] : null;
                    break;
                case $models[3]:
                    // 获取视频推荐
                    $result[$key][$value.'Entity'] = array_key_exists($key, $videos) ? $videos[$key] : null;
                    break;
            }
        }
        return $result;
    }

    /**
     * @param int $page 开始的行
     * @param int $limit 获取条数
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function getUsers(int $page, int $limit) {
        $user = new User();
        return $user->where('type', Config::get('utils.DQ_SINGER'))->limit($page, $limit)->select();
    }

    /**
     * @param int $page 开始的行
     * @param int $limit 获取条数
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function getSongs(int $page, int $limit) {
        $song = new Song();
        return $song->with('user')->limit($page, $limit)->select();
    }

    /**
     * @param int $page 开始的行
     * @param int $limit 获取条数
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function getArticles(int $page, int $limit) {
        $article = new Article();
        return $article->with('user')->limit($page, $limit)->select();
    }

    /**
     * @param int $page 开始的行
     * @param int $limit 获取条数
     * @return \think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function getVideos(int $page, int $limit) {
        $video = new Video();
        return $video->with('user')->limit($page, $limit)->select();
    }

    /**
     * 获取指定长度的模型随机组合数组
     * @param int $limit 循环长度
     * @param array $models
     * @return array ['article','video','song','video','user','article']
     */
    private function getRandModels(int $limit, array $models) {
        $randModels = [];
        for ($i = 0; $i < $limit; $i++) {
            // 从数组获取随机下标
            $randKey = rand(0, count($models) - 1);
            // 基于下标取数组值
            $randModels[$i] = $models[$randKey];
        }
        return $randModels;
    }
}
