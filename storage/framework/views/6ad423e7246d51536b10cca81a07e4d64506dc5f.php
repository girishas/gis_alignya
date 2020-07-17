<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
    
<?php echo HTML::script('public/balkangraph/OrgChart.js'); ?>

  <main>

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
            img_0: "img",
            //field_number_children: "field_number_children"
        },
        nodes: <?php echo $jsonData; ?>
    });
};

    </script>

    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>