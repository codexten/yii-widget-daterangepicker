<?php

namespace codexten\yii\widgets;

use Moment\Moment;
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
            $startDate = new Moment();
            $endDate = new Moment();
            switch ($this->defaultRange) {
                case self::RANGE_YESTERDAY:
                    $startDate = $startDate->subtractDays(1);
                    $endDate = $endDate->subtractDays(1);
                case self::RANGE_LAST_7_DAYS:
                    $startDate = $startDate->subtractDays(6);
                    break;
                case self::RANGE_LAST_30_DAYS:
                    $startDate = $startDate->subtractDays(30);
                    break;
                case self::RANGE_LAST_6_MONTHS:
                    $startDate = $startDate->subtractMonths(6);
                    break;
                case self::RANGE_THIS_MONTH:
                    $startDate = $startDate->startOf('month');
                    $endDate = $endDate->endOf('month');
                    break;
                case self::RANGE_LAST_MONTH:
                    $startDate = $startDate->subtractMonths(1)->startOf('month');
                    $endDate = $endDate->subtractMonths(1)->endOf('month');
                    break;

            }
            $startDate = $startDate->format('m/d/Y');
            $endDate = $endDate->format('m/d/Y');

            $this->options['value'] = "{$startDate} - {$endDate}";
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
