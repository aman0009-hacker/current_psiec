<?php

namespace App\Admin\Controllers;

use App\Models\State;
use App\Models\Yard;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
// use App\Models\Yard;
use App\Models\AdminUser;
use App\Models\Role;
use App\Models\RoleUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Admin\Actions\AddYardSupervisor;    

class YardController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Yard';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        try {
            $grid = new Grid(new Yard());
            // $grid->model()->groupBy('yards.yardstate, yards.yardcity, yards.yardplace, COUNT(*)');
            // $grid->column('id', __('Id'));   
            // $grid->column('yardcountry', __('Country'));
            $grid->column('yardstate', __('State'));
            $grid->column('yardcity', __('City'));
            $grid->column('yardplace', __('Place'));
            $grid->column('supervisorid', __('Yard Supervisor'))->display(function ($supervisorid) {
                if ($supervisorid === 0 || $supervisorid === null) {
                    return "N/A";
                } else {
                    $supervisorName = AdminUser::where('id', $supervisorid)->first()->username;
                    return $supervisorName ?? "N/A";
                }
            });
            $grid->column('created_at', __('Created at'))->display(function ($value) {
                //  return Carbon::parse($value)->format('Y-m-d H:i:s');
                //   return Carbon::parse($value)->format('d-m-Y');
                //return Carbon::parse($value)->format('Y-m-d H:i');
                return Carbon::parse($value)->format('Y-m-d');
            });
            $grid->filter(function ($filter) {
                $filter->disableIdFilter();
                $filter->column(1 / 2, function ($filter) {
                    $filter->like('yardstate', __('State'));
                    //$filter->like('yardcountry', __('Country'));
                    //$filter->like('yardcity', __('City'));
                });
                $filter->column(1 / 2, function ($filter) {
                    $filter->like('yardcity', __('City'));
                    //$filter->like('yardplace', __('Place'));
                });
            });
            // $grid->actions(function ($actions) {
            //    $actions->disableEdit();
            //    $actions->disableDelete();
            //     //$actions->disableView();
            // //    if (Admin::user()->can('create-post')) {
            // //         Permission::check('create-post');
            // //     }
            // });
            $grid->actions(function ($actions) {
                $actions->disableView();
                $actions->add(new AddYardSupervisor);
                $actions->disableEdit();
                $actions->disableDelete();
            });
            //$grid->disableActions();
            //$grid->disableRowSelector();
            $grid->model()->orderBy('created_at', 'desc');
            return $grid;
        } catch (\Throwable $ex) {
            Log::info($ex->getMessage());
            return $grid;
        }
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Yard::findOrFail($id));
        // $show->field('id', __('Id'));
        // $show->field('yardcountry', __('Yardcountry'));
        $show->field('yardstate', __('Yardstate'));
        $show->field('yardcity', __('Yardcity'));
        $show->field('yardplace', __('Yardplace'));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Yard());
        // $form->text('yardcountry', __('Country'))->default('India')->rules('required');
        $form->text('yardstate', __('State'))->default('Punjab')->rules('required');
        // $form->select('yardstate', __('State'))->options(['' => 'Select State', 'Punjab' => 'Punjab'])
        //     ->default('')
        //     ->load('yardcity', '/admin/get-cities')
        //     ->rules('required');
        $punjabCities = [
            'Ludhiana' => 'Ludhiana',
            'Amritsar' => 'Amritsar',
            'Jalandhar' => 'Jalandhar',
            'Patiala' => 'Patiala',
            'Bathinda' => 'Bathinda',
            'Mohali' => 'Mohali',
            'Pathankot' => 'Pathankot',
            'Hoshiarpur' => 'Hoshiarpur',
            'Batala' => 'Batala',
            'Moga' => 'Moga',
            'Khanna' => 'Khanna',
            'Phagwara' => 'Phagwara',
            'Rajpura' => 'Rajpura',
            'Firozpur' => 'Firozpur',
            'Kapurthala' => 'Kapurthala',
            'Faridkot' => 'Faridkot',
            'Sangrur' => 'Sangrur',
            'Fatehgarh Sahib' => 'Fatehgarh Sahib',
            'Gurdaspur' => 'Gurdaspur',
            'Muktsar' => 'Muktsar'
        ];
        $form->select('yardcity', __('City'))->options($punjabCities)->default('Mohali')->rules('required');
        $form->text('yardplace', __('Place'))->rules('required');
        // $supervisors = AdminUser::whereHas('roles', function ($query) {
        //     $query->where('name', 'YardCreator');
        // })->pluck('name', 'id');
        $supervisors = AdminUser::whereHas('roles', function ($query) {
            $query->where('name', 'YardCreator');
        })
            ->whereNotIn('id', function ($query) {
                $query->select('supervisorid')
                    ->from('yards')->whereNotNull('supervisorid');
            })
            ->pluck('name');
        $form->select('supervisorid', "__Supervisor UserName")->options($supervisors);
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
        });
        return $form;
    }
}