@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
    
<script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
  <main>

<div id="tree"></div>
    <script>
    
window.onload = function () { 
    var chart = new OrgChart(document.getElementById("tree"), {
        template: "ula",
        enableDragDrop: true,
        menu: {
            pdf: { text: "Export PDF" },
            png: { text: "Export PNG" },
            svg: { text: "Export SVG" },
            csv: { text: "Export CSV" }
        },
        nodeMenu: {
            details: { text: "View" },
            //add: { text: "Add New" },
            edit: { text: "Edit" },
           // remove: { text: "Remove" },
        },
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            field_2: "description",
            field_3: "period",
            img_0: "img",
            //field_number_children: "field_number_children"
        },
        nodes: [
            { id: 1, name: "Sales Objective", title: "In Progress",description: "Sales Target for FY-2020", period: "FY 2020", img: "{!!url('public/img/40.png')!!}" },
            { id: 2, pid: 1, name: "H1 Sales", title: "On Track",description: "Sales Target for H1 FY-2020", period: "H1 FY 2020", img: "{!!url('public/img/75.png')!!}" },
            { id: 3, pid: 1, name: "H2 Sales", title: "Out Of Track",description: "Sales Target for H2 FY-2020", period: "H2 FY 2020", img: "{!!url('public/img/32.png')!!}" },
            { id: 4, pid: 2, name: "Q1 Sales", title: "On Track",description: "Sales Target for Q1 FY-2020", period: "Q1 FY 2020", img: "{!!url('public/img/64.png')!!}" },
            { id: 5, pid: 2, name: "Q2 Sales", title: "On Track", description: "Sales Target for Q2 FY-2020", period: "Q2 FY 2020",img: "{!!url('public/img/40.png')!!}" },
            { id: 6, pid: 3, name: "Q3 Sales", title: "Out Of Track", description: "Sales Target for Q3 FY-2020", period: "Q3 FY 2020",img: "{!!url('public/img/32.png')!!}" },
            { id: 7, pid: 3, name: "Q4 Sales", title: "Out Of Track", description: "Sales Target for Q4 FY-2020", period: "Q4 FY 2020",img: "{!!('public/img/32.png')!!}" }
        ]
    });
};

    </script>

    </main>
@stop