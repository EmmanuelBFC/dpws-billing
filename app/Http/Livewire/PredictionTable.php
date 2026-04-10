<?php

namespace App\Http\Livewire;

use App\Models\Prediction;
use Illuminate\Support\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class PredictionTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Exportable::make('export')
                ->striped()
                ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            Header::make()->showSearchInput()
                      ->showToggleColumns(),
           
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Prediction>
    */
    public function datasource(): Builder
    {
        return Prediction::query()->join('users','predictions.user_id','=','users.id')
                                  ->select('predictions.*','users.name as username')->orderBy('created_at', 'desc');
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('id')
            ->addColumn('partenaire')
            ->addColumn('partenaire_lower', fn (Prediction $model) => strtolower(e($model->container_number)))
            ->addColumn('operation')
            ->addColumn('tractor')
            ->addColumn('trailer')
            ->addColumn('container_number')
            ->addColumn('seal_number')
            ->addColumn('loader')
            ->addColumn('product')
            ->addColumn('head_guerite_entry')
            ->addColumn('guerite_entry')
            ->addColumn('weighing_in')
            ->addColumn('head_geurite_output')
            ->addColumn('geurite_output')
            ->addColumn('date_weighing_output')
            ->addColumn('weighing_out')
            ->addColumn('weighing_status')
            ->addColumn('seen_entry_control')
            ->addColumn('name_controleur_input')
            ->addColumn('date_entry')
            ->addColumn('seen_exit_control')
            ->addColumn('name_controleur_ouput')
            ->addColumn('date_exit')
            ->addColumn('weighbridge_entry')
            ->addColumn('weighbridge_exit')
            ->addColumn('user_id')
            ->addColumn('created_at')
            ->addColumn('created_at_formatted', fn (Prediction $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('partenaire', 'partenaire')
                ->searchable()
                ->makeInputText('partenaire')
                ->sortable(),
                
            Column::make('operation', 'operation')
                ->searchable()
                ->makeInputText('operation')
                ->sortable(),
            Column::make('Vehicule', 'tractor')
                ->searchable()
                ->makeInputText('tractor')
                ->sortable(),
            Column::make('Remorque', 'trailer')
                ->searchable()
                ->makeInputText('trailer')
                ->sortable(),
            Column::make('N° conteneur', 'container_number')
                ->searchable()
                ->makeInputText('container_number')
                ->sortable(),
            Column::make('N° Plomb', 'seal_number')
                ->searchable()
                ->makeInputText('seal_number')
                ->sortable(),
            Column::make('Chargeur', 'loader')
                ->searchable()
                ->makeInputText('loader')
                ->sortable(),
            Column::make('Produit', 'product')
                ->searchable()
                ->makeInputText('product')
                ->sortable(),
            Column::make('Chef de guerite entrée', 'head_guerite_entry')
                ->searchable()
                ->makeInputText('head_guerite_entry')
                ->sortable(),
            Column::make('Guerite entrée', 'guerite_entry')
                ->searchable()
                ->makeInputText('guerite_entry')
                ->sortable(),
            Column::make('Date pesée entrée', 'date_weighing_entry')
                ->searchable()
                ->makeInputText('date_weighing_entry')
                ->sortable(),
            Column::make('Pesée sortie', 'weighing_out')
                ->searchable()
                ->makeInputText('weighing_out')
                ->sortable(),
            Column::make('statut pesée', 'weighing_status')
                ->searchable()
                ->makeInputText('weighing_status')
                ->sortable(),
            Column::make('Vu contrôle entrée', 'seen_entry_control')
                ->searchable()
                ->makeInputText('weighing_status')
                ->sortable(),
            Column::make('Nom contrôleur entrée', 'name_controleur_input')
                ->searchable()
                ->makeInputText('name_controleur_input')
                ->sortable(),
            Column::make('Date contrôle entrée', 'date_entry')
                ->searchable()
                ->makeInputText('date_entry')
                ->sortable(),
            Column::make('Vu contrôle sortie', 'seen_exit_control')
                ->searchable()
                ->makeInputText('seen_exit_control')
                ->sortable(),
            Column::make('Nom contôleur sortie', 'name_controleur_ouput')
                ->searchable()
                ->makeInputText('name_controleur_ouput')
                ->sortable(),
            Column::make('Date sortie', 'date_exit')
                ->searchable()
                ->makeInputText('name_controleur_ouput')
                ->sortable(),
            Column::make('Ajouté par', 'username')
                ->searchable()
                ->makeInputText('user_id')
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Enregistré le', 'created_at_formatted', 'created_at')
                ->makeInputDatePicker()
                ->searchable()
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Prediction Action Buttons.
     *
     * @return array<int, Button>
     */

   
    public function actions(): array
    {
       return [
           Button::make('edit', 'Edit')
               ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2.5 m-1 rounded text-sm')
               ->route('prediction.edit', ['prediction' => 'id']),

        //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('prediction.destroy', ['prediction' => 'id'])
        //        ->method('delete')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Prediction Action Rules.
     *
     * @return array<int, RuleActions>
     */

  
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($prediction) => $prediction->id === 1)
                ->hide(),
        ];
    }
    
}
