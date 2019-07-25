<?php

namespace codexten\yii\widgets;

use yii\web\JsExpression;

class DateRangePicker extends \jino5577\daterangepicker\DateRangePicker
{
    // ranges
    const RANGE_TODAY = 'today';
    const RANGE_YESTERDAY = 'yesterday';
    const RANGE_LAST_7_DAYS = 'last_7_days';
    const RANGE_LAST_30_DAYS = 'last_30_days';
    const RANGE_LAST_6_MONTHS = 'last_6_months';
    const RANGE_THIS_MONTH = 'this_month';
    const RANGE_LAST_MONTH = 'last_month';

    public $defaultRange;

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

        if ($this->defaultRange) {
            $startDate = 'moment()';
            $endDate = 'moment()';
            switch ($this->defaultRange) {
                case self::RANGE_YESTERDAY:
                    $startDate = "moment().subtract(1, 'days')";
                    $endDate = "moment().subtract(1, 'days')";
                    break;
                case self::RANGE_LAST_7_DAYS:
                    $startDate = "moment().subtract(6, 'days')";
                    break;
                case self::RANGE_LAST_30_DAYS:
                    $startDate = "moment().subtract(30, 'days')";
                    break;
                case self::RANGE_LAST_6_MONTHS:
                    $startDate = "moment().subtract(6, 'months')";
                    break;
                case self::RANGE_THIS_MONTH:
                    $startDate = "moment().startOf('month')";
                    $endDate = "moment().endOf('month')";
                    break;
                case self::RANGE_LAST_MONTH:
                    $startDate = "moment().subtract(1, 'month').startOf('month')";
                    $endDate = "moment().subtract(1, 'month').endOf('month')";
                    break;

            }
            $this->pluginOptions['startDate'] = '03/01/2014';
            $this->pluginOptions['endDate'] = '03/01/2014';
//            $this->options['value'] = '01/25/2019 - 07/25/2019';

//            $this->pluginOptions['startDate'] = new JsExpression($startDate);
//            $this->pluginOptions['endDate'] = new JsExpression($endDate);
//            $this->callback=new JsExpression("
//                function (start, end){
//                    console.log(start.format('MMMM D, YYYY') )
//                }
//            ");
        }

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
