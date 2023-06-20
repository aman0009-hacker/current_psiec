<?php

namespace App\Admin\Controllers;

use App\Models\Records;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Illuminate\Support\Facades\Redirect;
use Encore\Admin\Show;
use Carbon\Carbon;
use Illuminate\Support\Facades\Route;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Auth\Permission;


class YardSupervisorManagementController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Records';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Records());

        // $grid->column('id', __('Id'));
        // $grid->column('supervisor_id', __('Supervisor id'));
        $grid->column('product', __('Product'));
        $grid->column('quantity', __('Quantity'));
        $grid->column('description', __('Description'));
        $grid->column('created_at', __('Created at'))->display(function ($value) {
           // return Carbon::parse($value)->format('Y-m-d H:i:s');
           return Carbon::parse($value)->format('d-m-Y');
        });
        // $grid->column('updated_at', __('Updated at'));


        $grid->filter(function ($filter) {
            // $filter->notIn('id', __('Id'));
            $filter->disableIdFilter();
            //$filter->like('email', __('Email'));
            $filter->column(1 / 2, function ($filter) {
              $filter->like('product', __('Product'));
              $filter->like('description', __('Description'));
      
            });
            $filter->column(1 / 2, function ($filter) {
              $filter->like('quantity', __('Quantity'));
              // $filter->like('created_at', __('Created at'));
            });
          });

          
        $grid->actions(function ($actions) {
          $actions->disableEdit();
          // $actions->disableView();
          // $actions->disableDelete();
          //new code
          if (Admin::user()->can('create-post')) {
            Permission::check('create-post');
           }
          //new code
        });

          //new code
          //$grid->model()->where('supervisorid', Admin::user()->id)->orderBy('created_at', 'desc');
        //   if (Admin::user()->inRoles(['admin', 'administrator', 'Administartor'])) {
        //     // If user has one of the specified roles, show all records
        //     $grid->model()->orderBy('created_at', 'desc');
        // } else {
        //     // Otherwise, show only records where supervisorid matches the login ID
        //     $grid->model()->where('supervisor_id', Admin::user()->id)->orderBy('created_at', 'desc');
        // }
        //new code

        $grid->model()->orderBy('created_at', 'desc');

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Records::findOrFail($id));

        // $show->field('id', __('Id'));
        // $show->field('supervisor_id', __('Supervisor id'));
        $show->field('product', __('Product'));
        $show->field('quantity', __('Quantity'));
        $show->field('description', __('Description'));
        $show->field('created_at', __('Created at'));
        // $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    //protected function form():\Illuminate\Contracts\View\View
    protected function form()
    {
        $form = new Form(new Records());

        // $form->number('supervisor_id', __('Supervisor id'));
        // $form->text('product', __('Product'));
        // $form->text('quantity', __('Quantity'));
        // $form->text('description', __('Description'));

        return $form;

        //return view('supervisor_records');
        //return view('supervisor');
        //return Route::redirect('');
    }
}