<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<?php echo HTML::script('public/balkangraph/OrgChart.js'); ?>

 
 <main>
<div id="tree"></div>
<style>
[node-id] rect {
        fill: #FFC945;
    }
[node-id] circle {
        fill: #3984C6;
    }	
[link-id] path {
        stroke: #636363;
    }
[control-expcoll-id] circle {
        //fill: #750000;
    }
[control-node-menu-id] circle {
        fill: #bfbfbf;
    }	

</style>
    <script>
    

window.onload = function () {
    OrgChart.templates.company = Object.assign({}, OrgChart.templates.ana);
    OrgChart.templates.company.size = [200, 200];
    OrgChart.templates.company.node =
        '<circle cx="100" cy="100" r="100" fill="#ffffff" stroke-width="1" stroke="#636363"></circle>';
        
	OrgChart.templates.company.field_0 = '<text width="230" style="font-size: 100%;" text-overflow="multiline" fill="#ffffff" x="100" y="100" text-anchor="middle">{val}</text>';
	OrgChart.templates.company.field_1 = '<text width="230" style="font-size: 90%;" text-overflow="multiline" fill="#ffffff" x="100" y="115" text-anchor="middle">{val}</text>';

    OrgChart.templates.company.ripple = {
        radius: 100,
        color: "#636363",
        rect: null
    };

    OrgChart.templates.department = Object.assign({}, OrgChart.templates.ana);
    OrgChart.templates.department.size = [330, 50];
    OrgChart.templates.department.node =
        '<rect x="0" y="0" width="330" height="50" fill="#ffffff" stroke-width="1" stroke="#636363"></rect>';
    OrgChart.templates.department.field_0 = '<text style="font-size: 100%;" fill="#ffffff" x="165" y="30" text-anchor="middle">{val}</text>';
    OrgChart.templates.department.field_1 = '<text style="font-size: 90%;" fill="#ffffff" x="165" y="45" text-anchor="middle">{val}</text>';

    OrgChart.templates.department.ripple = {
        radius: 0,
        color: "#636363",
        rect: null
    };

    OrgChart.templates.staff = Object.assign({}, OrgChart.templates.ana);
    OrgChart.templates.staff.size = [50, 300];
    OrgChart.templates.staff.node =
        '<rect x="0" y="0" width="50" height="300" fill="#ffffff" stroke-width="1" stroke="#636363"></rect>';
    OrgChart.templates.staff.field_0 = '<text transform="rotate(90)"  style="font-size: 100%;" fill="#ffffff" x="150" y="-20" text-anchor="middle">{val}</text>';
    OrgChart.templates.staff.field_1 = '<text transform="rotate(90)"  style="font-size: 90%;" fill="#ffffff" x="150" y="-5" text-anchor="middle">{val}</text>';

    OrgChart.templates.staff.ripple = {
        radius: 0,
        color: "#636363",
        rect: null
    };

    var chart = new OrgChart(document.getElementById("tree"), {
        scaleInitial: OrgChart.match.boundary,
        //scaleInitial: 0.5,
		scaleMin: 0.2,
		scaleMax: 5,
        mouseScrool: OrgChart.action.zoom,
        //mouseScrool: false,
        nodeBinding: {
            field_0: "name",
            field_1: "smallName"
        },
        tags: {
            "Company": {
                template: "company"
            },
            "Department": {
                template: "department"
            },
            "Staff": {
                template: "staff"
            }
        },
        nodes: <?php echo $jsonData; ?>
    });
};

    </script>
    </main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>