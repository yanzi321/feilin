<?php
/**
 * Created by PhpStorm.
 * User: rovast
 * Date: 2019-01-26
 * Time: 22:02
 */

namespace App\Http\Controllers\AdminV2;


use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

abstract class BaseController extends Controller
{
    use ApiResponse;
}
