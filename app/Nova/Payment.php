<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Stripe\Event;

class Payment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Payment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),

            Currency::make('Amount')->asMinorUnits()->sortable()->currency($this->currency),

            Currency::make('Fee')->asMinorUnits()->sortable()->currency($this->currency),

            Text::make('Payment Id'),

            Badge::make('Status')->map([
                Event::PAYMENT_INTENT_CREATED => 'info',
                Event::PAYMENT_INTENT_SUCCEEDED => 'success',
                Event::PAYMENT_INTENT_PAYMENT_FAILED => 'danger',
                Event::PAYMENT_INTENT_REQUIRES_ACTION => 'warning',
                Event::PAYMENT_INTENT_CANCELED => 'danger',
            ])->sortable(),

            BelongsTo::make('Contest')->sortable(),

            BelongsTo::make('User')->sortable(),

            DateTime::make('Created At')->format('D-M-yyyy H:m'),

            DateTime::make('Updated At')->format('D-M-yyyy H:m'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
