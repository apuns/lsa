<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<?= $this->Html->css('lsa-datatables.css') ?>

<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<h2>Ceremony Night <?= $ceremony->night ?> - <?= date("l M j, Y g:ia", strtotime($ceremony->date)) ?></h2>
<h3>Ceremony Awards Summary</h3>

<div>
    <?php
        echo $this->Form->button('Non-Personalized', ['type' => 'button',  'onclick' => 'updateFilter(false)', 'class' => 'btn btn-primary', 'id' => 'button-off']);
        echo '&nbsp;';
        echo $this->Form->button('Personalized', ['type' => 'button',  'onclick' => 'updateFilter(true)', 'class' => 'btn btn-secondary', 'id' => 'button-on']);
    ?>


</div>
<div class="datatable-container">
    <?= $this->Flash->render() ?>
    <table id="data-table-1" class="display ceremony-datatable" style="font-size: 12px; width:100%">

    </table>
</div>


<?php

echo $this->Form->button('Cancel', array(
    'type' => 'button',
    'onclick' => 'location.href=\'/registrations/attendingrecipients/' . $ceremony_id . '\'',
    'class' => 'btn btn-secondary',
));

?>

<script>
    var registrations=<?php echo json_encode($recipients); ?>;
    var edit = true;
    var toolbar = true;
    var attending=<?php echo $attending ? 1 : 0; ?>;
    var personalizedStatus = "non-personalized";
    var datestr="<?php echo date("Y-m", strtotime($ceremony->date)); ?>";

    console.log(attending);

    $(document).ready(function() {

        for (i = 0; i < registrations.length; i++) {
            // options = JSON.parse(registrations[i].award_options)
            // registrations[i].optionsDisplay = "";
            // for (j = 0; j < options.length; j++) {
            //     if (i > 0) {
            //         registrations[i].optionsDisplay += "<BR>";
            //     }
            //     registrations[i].optionsDisplay += "- " + options[j];
            // }
            if (registrations[i].award_id == 0) {
                registrations[i].award_name = "PECSF Donation";
            }
        }

        console.log(registrations);

        var cols;

            cols = [
                {data: "award_personalized", title: "Personalized"},
                {data: "award_name", title: "Award"},
                {data: "count", title: "Total"}
            ];


        $('#data-table-1').DataTable( {
            data: registrations,
            columns: cols,
            // stateSave: true,
            pageLength: 15,
            lengthChange: false,
            // order: [[ 1, "asc" ]],

            dom: '<"toolbar">Bfrtip',
            buttons: [
                {
                    extend: 'csv',
                    text: 'Export to CSV',
                    filename: function () {
                        return datestr + 'award-summary-' + personalizedStatus;
                    },
                },
                {
                    extend: 'excel',
                    text: 'Export to Excel',
                    filename: function () {
                        return datestr + 'award-summary-' + personalizedStatus;
                    },
                }
            ],


            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search..."
            },

            initComplete: function () {
            }


        } );

        // only show buttons for users with appropriate permissions
        if (!toolbar) {
            $("div.toolbar").hide();
            $(".dt-buttons").hide();
        }


        $('#data-table-1').DataTable().columns(0).search('false');
        $('#data-table-1').DataTable().draw();

    } );


    function dataExport() {
        console.log('dataExport');
    }


    function updateFilter(personalized) {
        var table = $('#data-table-1').DataTable();

        if (personalized) {
            console.log("personalized - YES");
            $('#data-table-1').DataTable().columns(0).search('true');
            $('#data-table-1').DataTable().draw();
            $("#button-on").removeClass('btn-secondary').addClass('btn-primary');
            $("#button-off").removeClass('btn-primary').addClass('btn-secondary');
            personalizedStatus = "personalized";
        }
        else {
            console.log("personalized - NO");
            $('#data-table-1').DataTable().columns(0).search('false');
            $('#data-table-1').DataTable().draw();
            $("#button-off").removeClass('btn-secondary').addClass('btn-primary');
            $("#button-on").removeClass('btn-primary').addClass('btn-secondary');
            personalizedStatus = "non-personalized";
        }
    }

</script>

