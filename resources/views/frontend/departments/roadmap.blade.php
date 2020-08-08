@extends('frontend/layouts/default')
<?php use App\Traits\SortableTrait;  ?>

@section('content')
    
{!! HTML::script('public/balkangraph/orgchart.js') !!}
  <main>
<div class="col-12">
                    <h1> <span class="align-middle d-inline-block pt-1">RoadMap</span>   </h1>
</div>					
                
<div id="tree"></div>
    <script>
    
window.onload = function () { 
    var chart = new OrgChart(document.getElementById("tree"), {
        template: "polina",
        //enableDragDrop: true,
		scaleInitial: OrgChart.match.boundary,
        //scaleInitial: 0.5,
		scaleMin: 0.2,
		scaleMax: 5,
        mouseScrool: OrgChart.action.zoom,
        
       menu: {
            pdf: { text: "Export PDF" },
            png: { text: "Export PNG" },
            svg: { text: "Export SVG" },
            csv: { text: "Export CSV" }
        },
       /* nodeMenu: {
            details: { text: "View" },
            //add: { text: "Add New" },
            edit: { text: "Edit" },
           // remove: { text: "Remove" },
        },*/
        nodeBinding: {
            field_0: "name",
            field_1: "title",
            field_2: "description",
            field_3: "period",
           // img_0: "img",
            //field_number_children: "field_number_children"
        },
        nodes: <?php echo $jsonData; ?>
    });
};

    </script>

    </main>
@stop