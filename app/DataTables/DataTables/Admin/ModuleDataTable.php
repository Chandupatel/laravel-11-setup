<?php

namespace App\DataTables\DataTables\Admin;

use App\Libraries\DataTableHelper;
use App\Models\Module;
use App\Services\ModuleService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Http\Request;

class ModuleDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    protected $dataTableId = 'moduleDataTable';
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function($row) {
            $actions = [
                'dataTableId'=>$this->dataTableId,
                'edit_url' => route('admin.modules.edit',$row->id),
                'delete_url' => route('admin.modules.destroy',$row->id)
            ];
            return view('layouts.admin.datatable.actions',compact('actions'));
        })
        ->addColumn('parent_module', function($row) {
            $parent_module = "---";
            if (!empty($row->parent_module)) {
                $parent_module = $row->parent_module->name;
            }
            return $parent_module ;
        })
        ->editColumn('status', function ($row) {
            $actions = [
                'dataTableId'=>$this->dataTableId,
                'type'=>'switch',
                'status_url' => route('admin.modules.status', $row->id),
                'input_id'=>$row->id,
                'status' => $row->status,
            ];
            return view('layouts.admin.datatable.inputes',compact('actions'));
        })
        ->editColumn('created_at', function ($row) {
            return date('d-m-Y H:i:s', strtotime($row->created_at));
        })
            //->smart(true)
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Module $model): QueryBuilder
    {
        $request = request()->all();

        $request['with_relation'] = 1;
        $query = ModuleService::getList($request);
        
        return  $query; 
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        
        return $this->builder()
            ->setTableId($this->dataTableId)
            ->parameters(DataTableHelper::getDataTableParameters())
            ->ajax(DataTableHelper::getDataTableAjax(['url'=>route('admin.modules.index'), 'method'=>'GET']))
            ->columns($this->getColumns())
            // ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::computed('parent_module')
            ->orderable(true)
            ->searchable(false),
            Column::make('name'),
            Column::make('route_name')->title('Route')->data('route_name'),
            Column::make('route_params'),
            Column::make('status'),
            Column::make('created_at')->title('Date')->data('created_at'),
            Column::computed('action')
                  ->exportable(true)
                  ->printable(true)
                  //->searchable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];

        
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Module_' . date('YmdHis');
    }
}
