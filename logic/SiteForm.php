<?php

namespace app\logic;

use Yii;
use yii\base\Model;

/**
 * SiteForm is the model behind the contact form.
 */
class SiteForm extends Model
{
    public static function getMenu()
    {
        $menu = [
            [
                'name' => '项目管理',
                'icon' => 'am-icon-cubes',
                'group' => 'project',
				'route' => 'project/index',
            ],
            [
                'name' => '客户管理',
                'icon' => 'am-icon-user',
                'group' => 'customer',
				'route' => 'customer/index',
            ],
            [
                'name' => '工作日志',
                'icon' => 'am-icon-wpforms',
                'group' => 'daily',
                'route' => 'daily/index',
            ],
            [
                'name' => '数据管理',
                'icon' => 'am-icon-wpforms',
                'group' => 'data',
                'sub' => [
                    [
                        'name' => '日志数据',
                        'icon' => 'am-icon-wpforms',
                        'group' => 'data',
                        'route' => 'data/index',
                    ],
                    [
                        'name' => '日志记录',
                        'icon' => 'am-icon-wpforms',
                        'group' => 'data',
                        'route' => 'data/daily-record',
                    ],
                    [
                        'name' => '项目数据',
                        'icon' => 'am-icon-wpforms',
                        'group' => 'data',
                        'route' => 'data/project',
                    ],
                ]
            ],
        ];
        if(\Yii::$app->user->identity->department == 1)
            array_push($menu, [
                'name' => '员工管理',
                'icon' => 'am-icon-users',
                'group' => 'staff',
				'route' => 'staff/index',
            ],
			[
				'name' => '欢迎词库',
				'icon' => 'am-icon-file-text-o',
				'group' => 'welcome',
				'route' => 'welcome/index',
			]);
        return $menu;
    }
}
