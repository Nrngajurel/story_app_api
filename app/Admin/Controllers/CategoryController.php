<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());
        $grid->column('id', 'ID')->sortable();
        $grid->column('title', 'Title');
        $grid->column('icon', 'Icon')->image('', 200, 100);
        $grid->column('active', 'Active')->switch();
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
        $show = new Show(Category::findOrFail($id));
        $show->field('id', 'ID');
        $show->field('title', 'Title');
        $show->field('icon', 'Icon')->image('', 720, 400);
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());
        $form->text('title', 'Title');
        $form->image('icon', 'Icon')->uniqueName()->move('category');
        $form->switch('active', 'Active');
        return $form;
    }
}
