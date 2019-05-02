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
                'sub' => [
                    [
                        'name' => '项目管理',
                        'route' => 'project/index',
                    ],
                    [
                        'name' => '创建项目',
                        'route' => 'project/add'
                    ],
                ]
            ],
            [
                'name' => '客户管理',
                'icon' => 'am-icon-user',
                'group' => 'customer',
                'sub' => [
                    [
                        'name' => '客户管理',
                        'route' => 'customer/index',
                    ],
                    [
                        'name' => '创建客户',
                        'route' => 'customer/add'
                    ],
                ]
            ],
            [
                'name' => '工作日志',
                'icon' => 'am-icon-wpforms',
                'group' => 'daily',
                'route' => 'daily/index',
            ],
        ];
        if(\Yii::$app->user->identity->department == 1)
            array_push($menu, [
                'name' => '员工管理',
                'icon' => 'am-icon-users',
                'group' => 'staff',
                'sub' => [
                    [
                        'name' => '员工管理',
                        'route' => 'staff/index',
                    ],
                    [
                        'name' => '创建员工',
                        'route' => 'staff/add'
                    ],
                    [
                        'name' => '欢迎词库',
                        'route' => 'staff/welcome'
                    ]
                ]
            ]);
        return $menu;
    }
}
