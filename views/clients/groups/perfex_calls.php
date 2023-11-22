<?php
defined('BASEPATH') or exit('No direct script access allowed');
if(isset($client)){ ?>

    <h4 class="customer-profile-group-heading"><?php echo _l('perfex_calls'); ?></h4>

    <?php if( has_permission('perfex_calls','','create') || is_customer_admin($client->userid) ){ ?>
    <button class="btn btn-primary new-call mbot15" data-toggle="modal" data-target="#perfex_calls-modal"><i class="fa-regular fa-plus tw-mr-1"></i> <?php echo _l('new_call_entry'); ?></button>
    <?php } ?>




    <div class="tw-border tw-border-solid tw-border-neutral-200 tw-rounded-md tw-overflow-hidden tw-mb-3 last:tw-mb-0 panel-vault">
    <div class="tw-flex tw-justify-between tw-items-center tw-px-6 tw-py-3 tw-border-b tw-border-solid tw-border-neutral-200 tw-bg-neutral-50" id="vaultEntryHeading-1">
        <span class="tw-font-semibold tw-my-0 tw-text-lg">test</span>
        <div class="tw-flex-inline tw-items-center tw-space-x-2">
            <a href="#" onclick="edit_call_entry(1); return false;" class="text-muted">
                <i class="fa-regular fa-pen-to-square"></i>
            </a>
            <a href="#" class="text-danger _delete">
                <i class="fa fa-remove"></i>
            </a>
        </div>
    </div>
    <div id="vaultEntry-1" class="tw-p-6">
        <div class="row">
            <div class="col-md-12">
                <p class="tw-mb-1"><b>Server Address: </b>test</p>
            </div>
        </div>
    </div>
</div>





    <script>
    // Set variables for the datatable
    var companyid = <?php echo $client->userid; ?>
    </script>


    <?php
    // Hook the JS script in the footer after all other js loaded
    hooks()->add_action('app_admin_footer','perfex_calls_script_innit');
    function perfex_calls_script_innit(){ ?>
    <script>
    // JS Render the Datatable
    //initDataTable('.TABLECLASS', AJAX URL, NOTSUREHERE, TableNotSortableID's, ServerParams, [INDEX COLUMN ID, 'asc/desc']);
    initDataTable('.table-callbooktbl', admin_url + 'perfex_calls/table/' + companyid, undefined,[6], 'undefined', [0, 'asc']);

    var $entryModal = $('#perfex_calls-modal');
    $(function(){
        _validate_form($entryModal.find('form'),{
           product:'required',
           price:'required',
           startdate:'required',
           renewdate:'required',
       });
        setTimeout(function(){
          $($entryModal.find('form')).trigger('reinitialize.areYouSure');
        },1000)
       $entryModal.on('hidden.bs.modal',function(){
           var $form = $entryModal.find('form');
           $form.attr('action',$form.data('create-url'));
           $form.find('input[type="text"]').val('');
           $form.find('input[type="number"]').val('');
           $form.find('input[type="radio"]:first').prop('checked',true);
           $form.find('textarea').val('');
           $form.find('#product').val('');
           $form.find('#product').selectpicker('refresh');
           $form.find('#renew_period').val('');
           $form.find('#renew_period').selectpicker('refresh');
           $form.find('#status').val('');
           $form.find('#status').selectpicker('refresh');
       });
    });


    // Change the modal into an update modal with values entered
    function edit_perfex_calls_entry(id){
       $.get(admin_url+'perfex_calls/get_perfex_calls_entry/'+id,function(response){
           var $form = $entryModal.find('form');
           console.log(response);
           $form.attr('action',$form.data('update-url')+'/'+id);
           $form.find('#product').val(response.product);
           $form.find('#product').selectpicker('refresh');
           $form.find('#reference').val(response.reference);
           $form.find('#price').val(response.price);
           $form.find('#username').val(response.username);
           $form.find('#startdate').val(formatDate(response.startdate));
           $form.find('#startdate').datepicker('refresh');
           $form.find('#renewdate').val(formatDate(response.renewdate));
           $form.find('#renewdate').datepicker('refresh');
           $form.find('#renew_period').val(response.renew_period);
           $form.find('#renew_period').selectpicker('refresh');
           $form.find('#status').val(response.status);
           $form.find('#status').selectpicker('refresh');
           $form.find("input[name='client_id']").val(response.client_id);
           $entryModal.modal('show');
       },'json');
    }
    init_selectpicker();

    </script>
    <?php } ?>
    <!-- End Page -->
    <?php
}
