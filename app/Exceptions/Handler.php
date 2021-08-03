<?php

namespace App\Exceptions;

use App\Traits\ApiResponse;
use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    use ApiResponse;

    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception
     * @return void
     * @throws Exception
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception $exception
     * @return Handler|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return $this->renderValidationException($request, $exception);
        }

        if ($exception instanceof ErrorException) {
            return $this->renderErrorException($request, $exception);
        }

        if (is_admin_request($request) || is_mini_request($request) || is_pc_request($request)) {
            if ($exception instanceof NotFoundHttpException) {
                return $this->error('访问的地址不存在');
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->error('请检查请求方法');
            }

            if ($exception instanceof \Illuminate\Auth\AuthenticationException) {
                return $this->error('请登录', 401);
            }

            return $this->error($exception->getMessage());
        }

        return parent::render($request, $exception);
    }

    /**
     * 处理参数验证错误异常
     * @param $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function renderValidationException($request, Exception $exception)
    {
        $error = array_first($exception->errors())[0];
        return $this->error($error);
    }

    /**
     * 处理自己的错误异常类
     * @param $request
     * @param Exception $exception
     * @return \Illuminate\Http\JsonResponse
     */
    private function renderErrorException($request, Exception $exception)
    {
        return $this->error($exception->getMessage());
    }
}
