<?php

namespace CrCms\Permission\Repositories\Constants;

class CommonConstant
{
    const STATUS_NORMAL = 1;
    const STATUS_NORMAL_TEXT = '正常';

    const STATUS_FORBID = 2;
    const STATUS_FORBID_TEXT = '禁用';

    const STATUS_LIST = [
        self::STATUS_NORMAL => self::STATUS_NORMAL_TEXT,
        self::STATUS_FORBID => self::STATUS_FORBID_TEXT,
    ];

    const SUPER_NO = 0;
    const SUPER_NO_TEXT = '否';

    const SUPER_YES = 1;
    const SUPER_YES_TEXT = '是';

    //角色表---是否管理员
    const SUPER_LIST = [
        self::SUPER_NO => self::SUPER_NO_TEXT,
        self::SUPER_YES => self::SUPER_YES_TEXT,
    ];

    //权限表--http请求方法
    const ACTION_GET = 'GET';
    const ACTION_POST = 'POST';
    const ACTION_PUT = 'PUT';
    const ACTION_PATCH = 'PATCH';
    const ACTION_DELETE = 'DELETE';

    const ACTION_LIST = [
        self::ACTION_GET => self::ACTION_GET,
        self::ACTION_POST => self::ACTION_POST,
        self::ACTION_PUT => self::ACTION_PUT,
        self::ACTION_PATCH => self::ACTION_PATCH,
        self::ACTION_DELETE => self::ACTION_DELETE,
    ];
}