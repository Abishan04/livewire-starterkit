<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\Facades\Rule;
use PowerComponents\LivewirePowerGrid\Facades\PowerGrid;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class AllPosts extends PowerGridComponent
{
    public string $tableName = 'allPostsTable';
    public function header(): array
    {
        return [
            Button::add('bulk-delete')
                ->slot('Bulk Delete')
                ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm hover:bg-red-600 transition-colors duration-200')

                ->dispatch('bulkDelete.' . $this->tableName, []), // Dispatches an event for bulk deletion
        ];
    }

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            PowerGrid::header()
                ->showSearchInput(),
            PowerGrid::footer()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }


    public function datasource(): Builder
    {
        return Post::query();
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('name_lower', fn(Post $model) => strtolower(e($model->title)))
            ->add('created_at')
            ->add('created_at_formatted', fn(Post $model) => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'));
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->searchable()
                ->sortable(),

            Column::make('Name', 'title')
                ->searchable()
                ->sortable(),

            Column::make('Created at', 'created_at')
                ->hidden(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function filters(): array
    {
        return [
            Filter::inputText('name'),
            Filter::datepicker('created_at_formatted', 'created_at'),
        ];
    }

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(Post $row): array
    {
        return [
            Button::add('edit')
                ->slot('Edit: ' . $row->id)
                ->class('bg-indigo-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm hover:bg-indigo-600 transition-colors duration-200')
                ->dispatch('edit', ['rowId' => $row->id])
        ];
    }

    /*
    public function actionRules(Post $row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
