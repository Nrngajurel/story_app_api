<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Slider;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class SliderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Slider';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Slider());
        $grid->column('id', 'ID')->sortable();
        $grid->column('title', 'Title');
        $grid->column('image', 'Image')->image('', 200, 100);
        $grid->column('active', 'Active')->switch();
        $grid->column('category.title', __('Category'))->display(function ($category) {
            return $category??'Uncategorized';
        })->label();
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
        $show = new Show(Slider::findOrFail($id));
        $show->field('id', 'ID');
        $show->field('title', 'Title');
        $show->field('image', 'Image')->image('', 720, 400);
        $show->field('active', 'Active')->switch();
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Slider());
        $form->text('title', 'Title')->required();
        $form->image('image', 'Image')->uniqueName()->move('slider')->required();
        $form->switch('active', 'Active');
        $form->select('category_id', __('Category'))->options(Category::all()->pluck('title', 'id'));
        return $form;
    }
}
