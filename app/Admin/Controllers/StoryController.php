<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use App\Models\Story;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Row;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\Label;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\InfoBox;

class StoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Story';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Story());
        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('slug', __('Slug'));
        $grid->column('content', __('Content'));
        $grid->column('image', __('Image'))->image();
        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->like('title', 'Title');
        });
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
        $show = new Show(Story::findOrFail($id));
        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('slug', __('Slug'));
        $show->field('content', __('Content'));
        $show->field('image', __('Image'))->image();
        $show->field('category.title', __('Category'))->as(function ($category) {
            return $category->title??'Uncategorized';
        })->label('info');
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Story());
        $form->text('title', __('Title'));
        $form->text('slug', __('Slug'));
        $form->textarea('content', __('Content'));
        $form->image('image', __('Image'));
        $form->select('category_id', __('Category'))->options(Category::all()->pluck('title', 'id'));
        return $form;
    }
}
