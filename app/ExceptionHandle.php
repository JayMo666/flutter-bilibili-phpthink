<?php
namespace app;

use think\db\exception\DataNotFoundException;
use think\db\exception\ModelNotFoundException;
use think\exception\Handle;
use think\exception\HttpException;
use think\exception\HttpResponseException;
use think\exception\ValidateException;
use think\Response;
use Throwable;

/**
 * 应用异常处理类
 */
class ExceptionHandle extends Handle
{
    // 自定义默认返回值
    private $status = 200;
    private $code = 500;
    private $msg = '';

    /**
     * 不需要记录信息（日志）的异常类列表
     * @var array
     */
    protected $ignoreReport = [
        HttpException::class,
        HttpResponseException::class,
        ModelNotFoundException::class,
        DataNotFoundException::class,
        ValidateException::class,
    ];

    /**
     * 记录异常信息（包括日志或者其它方式记录）
     *
     * @access public
     * @param  Throwable $exception
     * @return void
     */
    public function report(Throwable $exception): void
    {
        // 使用内置的方式记录异常日志
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @access public
     * @param \think\Request   $request
     * @param Throwable $e
     * @return Response
     */
    public function render($request, Throwable $e): Response
    {
        // 添加自定义异常处理机制
        if ($e instanceof ValidateException) {
            // 参数验证错误
            $this->msg = $e->getError();
        } elseif ($e instanceof HttpException) {
            // 请求异常
            $this->status = $e->getStatusCode();
            $this->msg = $e->getMessage();
        } else {
            // 其他异常
            $this->msg = $e->getMessage() ? $e->getMessage() : '未知异常，请联系管理员！';
        }

        return json([
            'code' => $this->code,
            'msg'  => $this->msg
        ], $this->status);
    }
}
