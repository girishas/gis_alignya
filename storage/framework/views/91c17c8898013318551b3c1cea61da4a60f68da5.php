<?php use App\Traits\SortableTrait;  ?>

<?php $__env->startSection('content'); ?>
<main>
    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1>Thank you ! Your membership has been activated. </h1>
                     <div class="float-md-right">
                         <a onclick="window.print(); return false;" class="btn btn-primary" href="#">Print</a>
                         <button type="button" class="btn btn-outline-primary mb-1">Edit</button>
                            
                        </div> 
                    <div class="separator mb-5"></div>
                </div>
            </div>

             

            <div class="row invoice">
                <div class="col-12">
                    <div class="invoice-contents" leftmargin="0" marginwidth="0" topmargin="0" marginheight="0"
                        offset="0"
                        style="background-color:#ffffff; height:1200px; max-width:830px; font-family: Helvetica,Arial,sans-serif !important; position: relative;">
                        <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                            style="width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px;"
                            heigth="auto">

                            <tbody>
                                <tr>
                                    <td align="left" valign="center"
                                        style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;">
                                        <img src="<?php echo url('public/img/logo.png'); ?>" />
                                    </td>
                                    <td align="right" valign="center"
                                        style="padding-bottom:35px; padding-top:15px; border-top:0;width:100% !important;">
                                        <p
                                            style="color: #8f8f8f; font-weight: normal; line-height: 1.2; font-size: 12px; white-space: nowrap; ">
                                            ColoredStrategies Inc<br> 35 Little Russell St. Bloomsburg London,UK<br>784
                                            451 12 47
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" style="padding-top:30px; border-top:1px solid #f1f0f0">
                                        <table style="width: 100%;">
                                            <tbody>
                                                <tr>
                                                    <td
                                                        style="vertical-align:middle; border-radius: 3px; padding:30px; background-color: #f9f9f9; border-right: 5px solid white;">
                                                        <p
                                                            style="color:#303030; font-size: 14px;  line-height: 1.6; margin:0; padding:0;">
                                                            Customer Company Address<br>100-148 Warwick Trfy, Kansas City, USA
                                                        </p>
                                                    </td>

                                                    <td
                                                        style="text-align: right; padding-top:0px; padding-bottom:0; vertical-align:middle; padding:30px; background-color: #f9f9f9; border-radius: 3px; border-left: 5px solid white;">
                                                        <p
                                                            style="color:#8f8f8f; font-size: 14px; padding: 0; line-height: 1.6; margin:0; ">
                                                            Invoice #: 741<br>
                                                            02.02.2019
                                                        </p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <table style="width: 100%; margin-top:40px;">
                                            <thead>
                                                <tr>
                                                    <th
                                                        style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        ITEM NAME
                                                    </th>
                                                    <th
                                                        style="text-align:left; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                       LIMIT
                                                    </th>
                                                    <th
                                                        style="text-align:right; font-size: 10px; color:#8f8f8f; padding-bottom: 15px;">
                                                        PRICE
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="padding-top:0px; padding-bottom:5px;">
                                                        <h4
                                                            style="font-size: 16px; line-height: 1; margin-bottom:0; color:#303030; font-weight:500; margin-top: 10px;">
                                                          Basic Monthly plan </h4>
                                                    </td>
                                                    <td>
                                                        <p href="#"
                                                            style="font-size: 13px; text-decoration: none; line-height: 1; color:#909090; margin-top:0px; margin-bottom:0;">
                                                            3 members
                                                            </p>
                                                    </td>
                                                    <td style="padding-top:0px; padding-bottom:0; text-align: right;">
                                                        <p
                                                            style="font-size: 13px; line-height: 1; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap;">
                                                            $
                                                            14.82</p>
                                                    </td>
                                                </tr>
                                                  </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                        <table bgcolor="#ffffff" border="0" cellpadding="0" cellspacing="0"
                            style="position:absolute; bottom:0; width:100%; background-color:#ffffff;border-collapse:separate !important; border-spacing:0;color:#242128; margin:0;padding:30px; padding-top: 20px;"
                            heigth="auto">
                            <tr>
                                <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        Subtotal : </p>
                                </td>
                                <td style="padding-top:0px; text-align: right;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                        $
                                        61.82</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        Tax : </p>
                                </td>
                                <td style="padding-top:0px; text-align: right;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                        $
                                        2.18</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 100%">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        Shipping : </p>
                                </td>
                                <td style="padding-top:0px; text-align: right;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                        $
                                        3.21</p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style=" width: 100%; padding-bottom:15px;">
                                    <p href="#"
                                        style="font-size: 13px; text-decoration: none; line-height: 1.6; color:#909090; margin-top:0px; margin-bottom:0; text-align: right;">
                                        <strong>Total : </strong></p>
                                </td>
                                <td style="padding-top:0px; text-align: right; padding-bottom:15px;">
                                    <p
                                        style="font-size: 13px; line-height: 1.6; color:#303030; margin-bottom:0; margin-top:0; vertical-align:top; white-space:nowrap; margin-left:15px">
                                        <strong>$
                                            68.14</strong></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" style="border-top:1px solid #f1f0f0">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="3" style="text-align:center;">
                                    <p style="color: #909090; font-size:11px; text-align:center;">Invoice was created
                                        on a computer and
                                        is valid without the signature and seal. </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend/layouts/default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>