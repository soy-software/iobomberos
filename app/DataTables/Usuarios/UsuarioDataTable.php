<?php

namespace iobom\DataTables\Usuarios;

use iobom\User;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
class UsuarioDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables($query)
            ->addColumn('roles',function($user){
                return view('usuario.usuarios.roles',['user'=>$user])->render();
            })
            ->editColumn('estado',function($user){
               
                 return view('usuario.usuarios.estado',['user'=>$user])->render();                          
            })
            ->addColumn('action', function($user){
                return view('usuario.usuarios.acciones',['user'=>$user])->render();
            })->rawColumns(['roles','estado','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \cactu\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where('id','!=',Auth::user()->id)->select($this->getColumns());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->columns($this->getColumnsTable())
                    ->minifiedAjax()
                     ->addAction(['width' => '80px','printable' => false, 'exportable' => false,'title'=>'Acciones'])
                    ->parameters($this->getBuilderParameters());
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'id',
            'name',
            'telefono',
            'estado',
            'email',
        ];
    }


    protected function getColumnsTable()
    {
        return [
            'name'=>['title'=>'Usuario'],
             'telefono'=>['title'=>'Teléfono'],
            'email',
            'estado',
            'roles'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Usuario_Usuarios_' . date('YmdHis');
    }
}
