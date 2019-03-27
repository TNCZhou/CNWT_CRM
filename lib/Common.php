<?php
/**
 * Created by PhpStorm.
 * User: zhoutian
 * Date: 2019/3/24
 * Time: 19:40
 */

namespace app\lib;

use yii\data\Pagination;

class Common
{
    public static function getDisplayPagination(Pagination $pagination)
    {
        return \yii\widgets\LinkPager::widget([
            'pagination' => $pagination,
            'options' => ['class' => 'am-pagination tpl-pagination'],
            'activePageCssClass' => 'am-active',
            'disabledPageCssClass' => 'am-disabled'
        ]);
    }
}