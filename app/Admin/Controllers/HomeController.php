<?php

namespace App\Admin\Controllers;

use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Callout;
use App\Admin\Controllers\Dashboard\HomeDashboardController1;
use App\Admin\Controllers\Dashboard\HomeDashboardController2;
use App\Admin\Controllers\Dashboard\HomeDashboardController3;
use Encore\Admin\Facades\Admin;


class HomeController extends Controller
{
    public function myChart(Content $content){

        return $content
            ->title($title = Admin::user()->isRole('super-admin') || Admin::user()->isRole('admin')? 'The Admin Dashboard': 'Showing your Dashboard')
        
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(HomeDashboardController2::indexx());
                });

                $bar = view('admin.chartjs.pie');
                $row->column(1/3, new Box('Quality Assurance Statistics\' Pie Chart', $bar));

                $bar = view('admin.chartjs.bar');
                $row->column(1/3, new Box('Marktet place Statistics\' Bar Graph', $bar));

                $bar = view('admin.chartjs.line');
                $row->column(1/3, new Box('Marktet place Statistics\' Bar Graph', $bar));

                $row->column(4, function (Column $column) {
                    $column->append(HomeDashboardController2::indexx2());
                });

                $row->column(4, function (Column $column) {
                    $column->append(HomeDashboardController2::indexx3());
                });
            }); return $content
            ->title($title = Admin::user()->isRole('super-admin') || Admin::user()->isRole('admin')? 'The Admin Dashboard': 'Showing your Dashboard')
        
            ->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(HomeDashboardController2::indexx());
                });

                $bar = view('admin.chartjs.pie');
                $row->column(1/3, new Box('Quality Assurance Statistics\' Pie Chart', $bar));

                $bar = view('admin.chartjs.bar');
                $row->column(1/3, new Box('Marktet place Statistics\' Bar Graph', $bar));

                $bar = view('admin.chartjs.line');
                $row->column(1/3, new Box('Marktet place Statistics\' Bar Graph', $bar));

                // $row->column(4, function (Column $column) {
                //     $column->append(HomeDashboardController2::indexx2());
                // });

                // $row->column(4, function (Column $column) {
                //     $column->append(HomeDashboardController2::indexx3());
                // });
            }); 
    }
        

    public function tab(Content $content)
    {
        $content->title('Your Dashboard');

        // $this->showFormParameters($content);

        $tab = new Widgets\Tab();

        // $box5 = new Widgets\Box('', $this->myChart($content));
        $box1 = new Widgets\Box('', HomeDashboardController2::indexx());
        
        $box2 = new Widgets\Box('', view('admin.chartjs.pie'), 'For latest data, kindly refresh the page!');
        $box3 = new Widgets\Box('', view('admin.chartjs.bar'), 'For latest data, kindly refresh the page!');
        $box4 = new Widgets\Box('', view('admin.chartjs.line'), 'For latest data, kindly refresh the page!');            

       
        // $tab->add('Application Forms', $box5);    // tab 5
        $tab->add('Overview Table', $box1);    // tab 1
        $tab->add('Quality Assurance', $box2);    // tab 2
        $tab->add('Seed Stock', $box4);    // tab 4
        $tab->add('Marketplace', $box3);    // tab 3
        

        $content->row($tab);

        return $content;
    }

    protected function showFormParameters($content)
    {
        $parameters = request()->except(['_pjax', '_token']);

        if (!empty($parameters)) {

            ob_start();

            dump($parameters);

            $contents = ob_get_contents();

            ob_end_clean();

            $content->row(new Widgets\Box('Form parameters', $contents));
        }
    }
}

