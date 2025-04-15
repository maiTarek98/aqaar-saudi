 <style type="text/css">
    <?php echo $template->css_styles;?>
 </style>

{!! str_replace(['{order_no}', '{total_amount}'], [$invoice->order_no, $invoice->total], $template->html_template) !!}