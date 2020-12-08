<?php

namespace App\DataTables;

use App\Model\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MemberDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', '<a href="{{route(\'backend.member.detail\',$id)}}" class="btn btn-info" style="color:white"><i class="fas fa-info"></i></a> 
            <a href="{{route(\'backend.member.update\',$id)}}" style="color:white" class="btn btn-success"><i class="fas fa-edit"></i></a> 
            <form method="post" action="{{route(\'backend.member.delete\',$id)}}" style="display:inline-block">
                @csrf
                <button type="submit" style="color:white" class="btn btn-danger"><i class="fas fa-trash"></i></button>
            </form>');       
        }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Member $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where("level",2)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('member-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->parameters([
                        'buttons' => ['create','excel','csv','print'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('phone_no'),
            Column::make('email'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(150)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Member_' . date('YmdHis');
    }
}
