@extends('frontend/layouts/default')

@section('content')
 <main>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<h1>{!! getLabels('email_template_detail') !!}</h1>
				<div class="text-zero top-right-button-container">
					<a href="{!! url($route_prefix, 'templates') !!}" class="steamerst_link btn btn-primary btn-lg top-right-button mr-1 text-uppercase">{!! getLabels('Email_Templates') !!}</a>
				</div>
				<nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
					<ol class="breadcrumb pt-0">
						<li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'dashboard') !!}">{!! getLabels('Dashboard') !!}</a>
						</li>
						  <li class="breadcrumb-item">
							<a class="steamerst_link" href="{!! url($route_prefix, 'templates') !!}">{!! getLabels('Email_Templates') !!}</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{!! getLabels('email_template_detail') !!}</li>
					</ol>
				</nav>
				<div class="separator mb-5"></div>
			</div>
		</div>
	</div>
	
	<div leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0" style="height:auto !important;width:100% !important; font-family: Helvetica,Arial,sans-serif !important; margin-bottom: 40px;">
        <center>
			
            <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0" style="max-width:800px; background-color:#ffffff;border:1px solid #e4e2e2;border-collapse:separate !important; border-radius:4px;border-spacing:0;color:#242128; margin:0;padding:40px;"
                heigth="auto">
                <tbody>
                    <tr>
                        <td align="left" valign="center" style="padding-bottom:40px;border-top:0;height:100% !important;width:100% !important;">
							<h2>Steamer Studio</h2>
                        </td>
                        <td align="right" valign="center" style="padding-bottom:40px;border-top:0;height:100% !important;width:100% !important;">
                            <span style="color: #8f8f8f; font-weight: normal; line-height: 2; font-size: 14px;">{!! date('Y/m/d') !!}</span>
                        </td>
                    </tr>
					<td colspan="2"><h3 class="text-primary" style="font-weight:800;">{!! getLabels('english') !!} : </h3></td>
                    <tr>
                        <td colspan="2" style="padding-top:10px;padding-bottom:10px;border-top:1px solid #e4e2e2">
                            <h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;">{!! $data->subject_en !!}</h3>
							{!! $data->content_en !!}
                        </td>
                    </tr>
					<td colspan="2"><h3 class="text-primary" style="font-weight:800;">{!! getLabels('spanish') !!} : </h3></td>
                    <tr>
                        <td colspan="2" style="padding-top:10px;padding-bottom:10px;border-top:1px solid #e4e2e2">
                            <h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;">{!! $data->subject_sp !!}</h3>
							{!! $data->content_sp !!}
                        </td>
                    </tr>
					
					<td colspan="2"><h3 class="text-primary" style="font-weight:800;">{!! getLabels('french') !!} : </h3></td>
                    <tr>
                        <td colspan="2" style="padding-top:10px;padding-bottom:10px;border-top:1px solid #e4e2e2">
                            <h3 style="color:#303030; font-size:18px; line-height: 1.6; font-weight:500;">{!! $data->subject_fr !!}</h3>
							{!! $data->content_fr !!}
                        </td>
                    </tr>
					<tr>
                        <td align="left" colspan="2" style="padding-top:10px;padding-bottom:10px;border-top:1px solid #e4e2e2">
							<p>Thanks</p>
							Steamer Studio Team
                        </td>
                    </tr>
                    <tr>
                        <td align="left" colspan="2" style="padding-top:10px;border-top:1px solid #e4e2e2">
							<h3>Shortcodes </h3>
							<p>{!! $data->description !!} </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="margin-top:30px; padding-bottom:20px;; margin-bottom: 40px;">
                <tbody>
                    <tr>
                        <td align="center" valign="center">
                            <p style="font-size: 12px; text-decoration: none;line-height: 1; color:#909090; margin-top:0px; ">
								{!! config('constants.COPYRIGHT_MESSAGE') !!}
                            </p>
                           
                        </td>
                    </tr>
                </tbody>
            </table>
        </center>
    </div>
</main>
@stop
