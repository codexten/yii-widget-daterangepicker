<?php

namespace codexten\yii\widgets;

use yii\web\JsExpression;

class DateRangePicker extends \jino5577\daterangepicker\DateRangePicker
{
    public function init()
    {
        $this->pluginOptions = [
            'ranges' => new JsExpression("
                {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'Last 6 Months': [moment().subtract(6, 'month'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
                    "),
            'autoUpdateInput' => false,
            'locale' => [
                'cancelLabel' => 'Clear',
            ],
        ];
        $this->template = '
            <div class="input-group">
                <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span>
                </span>
                {input}
            </div>
        ';
        parent::init();
    }

}
