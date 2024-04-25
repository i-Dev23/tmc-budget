            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2023 © PT. Tritunggal Multi Cemerlang All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    {{-- @include('../vendor/sweetalert/alert') --}}
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- latest jquery-->
    <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/bootstrap/bootstrap.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('assets/js/config.js')}}"></script>
    <!-- Plugins JS start-->
    <script src="{{asset('assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('assets/js/chart/chartist/chartist-plugin-tooltip.js')}}"></script>
    <script src="{{asset('assets/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('assets/js/chart/knob/knob-chart.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/apex-chart.js')}}"></script>
    <script src="{{asset('assets/js/chart/apex-chart/stock-prices.js')}}"></script>
    <script src="{{asset('assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <!-- <script src="{{asset('assets/js/dashboard/default.js')}}"></script> -->
    <script src="{{asset('assets/js/notify/index.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.en.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.custom.js')}}"></script>
    <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
    <!-- Plugins JS Ends-->


    <script src="https://unpkg.com/slick-loader@1.1.20/slick-loader.min.js"></script>


    <!-- DataTable -->
    <!-- <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/custom.js')}}"></script>
    <script src="{{asset('assets/js/tooltip-init.js')}}"></script> -->
    <!-- End DataTable -->

    <!-- DataTable II -->
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('assets/js/tooltip-init.js')}}"></script>
    <!-- End DataTable II -->

    <!-- Date Range -->
    <script src="{{asset('assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>
    <!-- End Date Range -->

    <!-- Theme js-->
    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- <script src="{{asset('assets/js/theme-customizer/customizer.js')}}"></script> -->
    <!-- login js-->
    <!-- Plugin used-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        Chart.defaults.color = '#fff';
        var ctx = "";
        var count_hasil = $('#count_hasil').val()
        var nilai_awal = 0;
        for(var i = 0; i<count_hasil; i++){
            // var arr_data = []
            window['arr_data' + i] = [];
            ctx = document.getElementById('myChart'+i);
            var data_persen = $('#persen'+i).val();
            nilai_awal = 100 - parseInt(data_persen);
            window['arr_data' + i].push(nilai_awal)
            window['arr_data' + i].push(parseInt(data_persen))
            new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels:['Sisa Budget', 'Budget Digunakan'],
                datasets: [{
                    label: ['Persen '],
                    fontColor : "rgb(255,255,255)",
                    fillColor : "rgba(255, 89, 114, 0.6)",
                    strokeColor : "rgba(51, 51, 51, 1)",
                    pointColor : "rgba(255, 89, 114, 1)",
                    pointStrokeColor : "#fff",
                    pointHighlightFill : "#fff",
                    pointHighlightStroke : "rgba(151,187,205,1)",
                    data: window['arr_data' + i],
                    borderWidth: 1,
                    hoverBackgroundColor: "rgba(232,105,90,0.8)",
                    hoverBorderColor: "orange",
                    backgroundColor: ['#8673A1', '#B32821']
                }]
            },
            options: {
                legend:{
                    labels: {
                    fontColor: "white",
                    fontSize: 200,
                }
                },
                responsive: true,
                scales: {
                    y: {
                    // beginAtZero: true,
                    ticks: { color: 'white', beginAtZero: true }
                    }
                }
            }
        });
        arr_data = []
        }

        $(document).on("click", ".detail_master_division", function(){
            var idData = $(this).data('id');
            $('#body_sub').empty();
            SlickLoader.enable()
            $.ajax({
                url:"{{url('getDetailDivisi')}}" + "/" + idData,
                type:"GET",
                success:function(response){
                    var table = jQuery('#customers').DataTable({
                    fixedHeader: true,
                    destroy:true,
                    processing: true,
                    pageLength: 10,
                    data:response,
                    columnDefs: [{
                        targets: [0],
                        data: null,
                        orderable: true,
                        className: 'details-control',
                        defaultContent: ''
                    }],
                        columns:[
                            {
                                data:"nama_sub_divisi",
                                render:function(data,type,row){
                                    return `<span class="badge badge-primary">`+row.nama_sub_divisi+`&nbsp;&nbsp;<i class="fa fa-eye"></i></span>`
                                }
                            },
                            {
                                data:"status",
                                render:function(data,type,row){
                                    return `<div><h6 class="text-center" style="font-size:12px">`+row.status+`</h6></div>`
                                }
                            },
                            {
                                data:"status",
                                render:function(data,type,row){
                                    var sts_sj = '';
                                    if(row.status== 'NonActive'){
                                        sts_sj = '<button style="margin:0 auto" class="btn btn-danger btn-xs" title="Active kan" onclick="status_edit('+row.id_sub_divisi+')"><i class="fa fa-lock"></i></button>';
                                    }else{
                                        sts_sj = '<button style="margin:0 auto" class="btn btn-success btn-xs" title="Nonactive kan" onclick="status_edit('+row.id_sub_divisi+')"><i class="fa fa-lock"></i></button>';
                                        // sts_sj = '<div style="text-align: center;"><button style="margin:0 auto" class="btn btn-success btn-xs" title="Nonactive kan" onclick="status_edit('+row.id_sub_divisi+')"><i class="fa fa-lock"></i></button></div>';
                                    }
                                    // var sts_sj_rename = '<button class="btn btn-primary edit edit_budget_sub_divisi" title="Edit Data" data-toggle="modal" data-id="'+row.id_budget+'|^|'+row.id_sub_divisi+'|^|'+row.nama_divisi+'|^|'+row.amount+'|^|'+budget_int_send+'|^|'+row.nama_sub_divisi+'|^|'+hasil+'" data-target="#editDataSub" style="margin-right:2px"><i class="fa fa-pencil"></i></button>'
                                    var sts_sj_rename = '<button class="btn btn-primary edit rename_master_division" data-id="'+row.nama_sub_divisi+'|'+row.id_sub_divisi+'" style="margin-right:2px;" data-toggle="modal" data-target="#renameData" title="Rename Data"><i class="fa fa-pencil"></i></button>';
                                    var button_edit = sts_sj_rename + sts_sj
                                    return button_edit
                                }
                            },    
                        ],
                        createdRow: function(row, data, index) {
                            jQuery(row).addClass('tr-header');
                            jQuery(row).attr('data-division', data.id_sub_divisi);
                        },
                    });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });
        });

        jQuery('#customers').on("click", ".details-control", function(e) {
        e.preventDefault();
        // SlickLoader.enable();
        let dt = jQuery('#customers').DataTable();
        let tr  = jQuery(this).closest('tr');
        // console.log(tr)
        division   = tr.data('division');
        let row = dt.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            jQuery('.shown').each(function(i, obj) {
                newtr = jQuery(this).closest('tr');
                newrow = dt.row(newtr);
                newrow.child.hide();
                newtr.removeClass('shown');
            });

            row.child(formatHtml(division)).show();
            // SlickLoader.disable();
            tr.addClass('shown');

            tr.next('tr').children('td:first').css('max-width', '0px');
            tr.next('tr').addClass('tr-detail');
        }

        jQuery('#tableInfoDetail').DataTable({
            pageLength: 10,
            destroy: true,
            columnDefs: [{
                targets: [1],
                orderable: false,
                defaultContent: ''
            }]
        });

    });

    $(document).ready(function(){
        $('.examplecok').DataTable({
            responsive: {
                details: {
                    renderer: function ( api, rowIdx, columns ) {
                        var data = $.map( columns, function ( col, i ) {
                            return col.hidden ?
                                '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
                                    '<td>'+col.title+':'+'</td> '+
                                    '<td>'+col.data+'</td>'+
                                '</tr>' :
                                '';
                        } ).join('');
    
                        return data ?
                            $('<table/>').append( data ) :
                            false;
                    }
                }
            }
        });
    });

    function formatHtml(division) {
        let htmlInner = '';
            htmlInner =
                '<div class="panel">' +
                '<div class="panel-heading">' +
                '<h6 style="color:#000" class="pull-left">Detail Sub Breakdown</h6>' +
                '<div class="clearfix"></div>' +
                '</div>' +
                '<div class="ibox-content table-responsive">' +
                '<div class="text-center animated fadeInRight" style="padding-top:1%; padding-bottom:1%" hidden id="loader">' +
                '<span class="btn btn-primary shadow"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</span>' +
                '</div>' +
                '<table class="table table-striped table-hover" id="tableInfoDetail">' +
                '<thead>' +
                '<tr>' +
                '<th class="all">No</th>' +
                '<th class="all">Nama Sub Breakdown</th>' +
                '<th class="all">Status</th>' +
                '<th class="all">Action</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
        jQuery.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('list-detail-sub_brekdown') }}",
            data: {
                'division': division,
            },
            async: false,
            success: (function(data) {
                jQuery.each(data, function(key, val) {
                    let no_urut_detail = key + 1;
                            var sts_sj = '';
                            if(val.status== 'NonActive'){
                                sts_sj = '<button style="margin:0 auto" class="btn btn-danger btn-xs" title="Active kan" onclick="status_edit_sub('+val.id+')"><i class="fa fa-lock"></i></button>';
                            }else{
                                sts_sj = '<button style="margin:0 auto" class="btn btn-success btn-xs" title="Nonactive kan" onclick="status_edit_sub('+val.id+')"><i class="fa fa-lock"></i></button>';
                            }
                            // var sts_sj_rename = '<button class="btn btn-primary edit rename_master_division" data-id="'+val.nama_sub_divisi+'|'+val.id+'" style="margin-right:2px;" data-toggle="modal" data-target="#renameData" title="Rename Data"><i class="fa fa-pencil"></i></button>';
                            var button_edit = sts_sj
                        htmlInner += '<tr>' +
                        '<td>' + no_urut_detail + '</td>' +
                        '<td>' + val.nama_sub_breakdown + '</td>' +
                        '<td>' + val.status + '</td>' +
                        '<td>' + button_edit + '</td>' +
                        '</tr>';
                    });
            }),
            error: function(data) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Failed to load data',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
            },
            dataType: 'json'
        });

        htmlInner += '</tbody>' +
            '</table>' +
            '</div>' +
            '</div>';

        return htmlInner;
    }

    function status_edit_sub(id){
        SlickLoader.enable();
            $.ajax({
                url:"{{url('status_update_sub')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    Swal.fire({
                    icon: 'success',
                    text : 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                location.reload()
                },
                error : function(response){
                    Swal.fire({
                    icon: 'error',
                    text : 'error',
                    title: response.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            }); 
    }

        $(document).on('click', '.rename_master_division', function(){
            $('#dinamis_division_brekdown').empty()
            $('#Detail').modal('hide');
            var hasil = $(this).data('id');
            var explode = hasil.split('|');
            $('#idDivisiSubEdit').val(explode[1])
            $('#subrenamedivision').val(explode[0])
        })

        function rename_division(){
            SlickLoader.enable();
            var id = $('#idDivisiSubEdit').val()
            var name = $('#subrenamedivision').val()
            var inpt = document.getElementsByName('subrenamebreakdown[]');
            var arr_input = []
            for(var io=0; io<inpt.length; io++){
                var io_data = inpt[io].id;
                // arr_input.push($('#subrenamebreakdown'+io).val());
                arr_input.push($('#'+io_data).val());
            }
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('rename_division') }}",
                data: {
                    'id':id,
                    'name' : name,
                    'child' : arr_input,
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil Update Sub Name',
                        icon: 'info',
                        confirmButtonText: 'Oke',

                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'Gagal Update Sub Name',
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                        setTimeout(() => {
                            // location.reload();
                        }, 1000);
                        },complete: function (data) {
                    SlickLoader.disable(); 
                }
            })
        }

        var dinamic_division = `<option value="" selected disabled>-- Pilih --</option>
                                <option id="selec0" value="Active">Active</option>
                                <option id="selec1" value="NonActive">Non Active</option>`
        
        var type_dinamic = `<option value="" selected disabled>-- Pilih --</option>
                            <option id="type_dinamic0" value="type1">type1</option>
                            <option id="type_dinamic1" value="type2">type2</option>`
        $(document).ready(function(){
            $(document).on("click", ".edit_master_division", function(){
                var hasil = $(this).data('id')
                var explode = hasil.split("|^|");
                console.log(explode)
                $('#divisi_ril').val(explode[0])
                $('#idDivisiEdit').val(explode[2])
                var arr_select = ['Active','NonActive'];
                var arr_select_type = ['type1','type2'];
                $('#select_division').empty();
                $('#select_division').append(dinamic_division);
                $('#type_edit').empty();
                $('#type_edit').append(type_dinamic);

                for(var d=0; d<arr_select.length; d++){
                    if(arr_select[d] == explode[1]){
                        $('#selec'+d).attr('selected','selected')
                    }
                }

                for(var kl=0; kl<arr_select_type.length; kl++){
                    if(arr_select_type[kl] == explode[3]){
                        $('#type_dinamic'+kl).attr('selected','selected')
                        // return false
                        break
                    }
                }
            });

            $(document).on("click", ".edit_budget_divisi", function(){
                var hasil = $(this).data('id');
                var explode = hasil.split("|^|");
                console.log(explode);
                $('#divisi_edit_budget_divisi').val('');
                $('#amount_edit_divisi').val('');
                var numbner = explode[2]
                $('#divisi_edit_budget_divisi').val(explode[3]);
                $('#amount_edit_divisi').val(parseInt(numbner).toLocaleString('en-US'));
                $('#id_budget_update').val(explode[0]);
                $('#divisi_id_update').val(explode[1]);

                // date('m/d/Y')
                var periode_edit_from = explode[4].split('-');
                var periode_from_fix = periode_edit_from[1]+'/'+periode_edit_from[2]+'/'+periode_edit_from[0];
                var periode_edit_end = explode[5].split('-');
                var periode_end_fix = periode_edit_end[1]+'/'+periode_edit_end[2]+'/'+periode_edit_end[0];
                $('#periode_edit').val(periode_from_fix+' - '+periode_end_fix);

        });

        //jsconcarency
        $("input[data-type='currency']").on({
            keyup: function() {
            formatCurrency($(this));
            },
            blur: function() { 
            formatCurrency($(this), "blur");
            }
        });


        function formatNumber(n) {
        // format number 1000000 to 1,234,567
        return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
        }


        function formatCurrency(input, blur) {
        // appends $ to value, validates decimal side
        // and puts cursor back in right position.
        
        // get input value
        var input_val = input.val();
        
        // don't validate empty input
        if (input_val === "") { return; }
        
        // original length
        var original_len = input_val.length;

        // initial caret position 
        var caret_pos = input.prop("selectionStart");
            
        // check for decimal
        if (input_val.indexOf(".") >= 0) {

            // get position of first decimal
            // this prevents multiple decimals from
            // being entered
            var decimal_pos = input_val.indexOf(".");

            // split number by decimal point
            var left_side = input_val.substring(0, decimal_pos);
            var right_side = input_val.substring(decimal_pos);

            // add commas to left side of number
            left_side = formatNumber(left_side);

            // validate right side
            right_side = formatNumber(right_side);
            
            // On blur make sure 2 numbers after decimal
            if (blur === "blur") {
            right_side += "00";
            }
            
            // Limit decimal to only 2 digits
            right_side = right_side.substring(0, 2);

            // join number by .
            input_val = left_side + "." + right_side;

        } else {
            // no decimal entered
            // add commas to number
            // remove all non-digits
            input_val = formatNumber(input_val);
            input_val = input_val;
            
            // final formatting
            if (blur === "blur") {
            input_val += ".00";
            }
        }
        
        // send updated string to input
        input.val(input_val);

        // put caret back in the right position
        var updated_len = input_val.length;
        caret_pos = updated_len - original_len + caret_pos;
        input[0].setSelectionRange(caret_pos, caret_pos);
        }

            var danaVOucer = 0;
            var NewDana = 0;
            var division_temp = ''

            $(document).on("click", ".edit_budget", function(){
                var hasil = $(this).data('id')
                var explode = hasil.split("|^|");
                $('#divisi_edit_budget').val('');
                $('#amount_edit').val('');
                danaVOucer = explode[2];
                NewDana = explode[2];
                division_temp = explode[1]
                $('#divisi_edit_budget').val(explode[3]);
                // $('#amount_edit').val(explode[2]);
                $('#amount_edit').val(parseInt(explode[2]).toLocaleString('en-US'))
                $('#id_budget').val(explode[0]);
                get_master_sub_divisi(hasil);
        });



        

        $('#amount_add_sub').on('keyup focus', function(){
            get_amount = parseInt(NewDana)
            get_amount_parent = parseInt(danaVOucer)
            $('#temp_amount').val(get_amount_parent)
            send_bgt = parseInt($('#amount_add_sub').val().replace(/\D/g, ""))
            get_number = get_amount-send_bgt;

            // $('#amount_edit').val(get_number.toLocaleString('en-us'))
            $('#sisa_hasil').val(get_number)
            $('#division_temp').val(division_temp)

            if(isNaN(get_number)){
                $('#amount_edit').val(get_amount.toLocaleString('en-us'))
                $('#amount_add_sub').val('')
                $('#sisa_hasil').val(get_amount)
                return false
            }

            if(get_number < 0){
                Swal.fire({
                icon: 'error',
                title: 'error',
                text : 'budget yang ada input melebihi budget yang tersedia',
                showConfirmButton: false,
                timer: 1500
            });

                $('#amount_edit').val(get_amount.toLocaleString('en-us'))
                $('#amount_add_sub').val('')
                $('#sisa_hasil').val(get_amount)
                return false
            }
            $('#amount_add_sub').val(autoFormatPhoneNumber(send_bgt))
            $('#amount_edit').val(get_number.toLocaleString('en-us'))
            $('#sisa_hasil').val(get_number)
        })

        $(document).on("click", ".detail_budget", function(){
            var hasil = $(this).data('id')
            $('#body_sub_budget').empty();
            SlickLoader.enable()
            $.ajax({
                url:"{{url('get_detail_budget')}}/"+hasil,
                type:"GET",
                success:function(data){

                    if(data == null || data == ''){
                        SlickLoader.disable();
                    }else{

                        $('#budget_cant_shared').html(parseInt(data[0].amount).toLocaleString('en-US'))
                        console.log(data)
                        $('#budget_detail').DataTable({
                            fixedHeader: true,
                            destroy:true,
                            processing: true,
                            pageLength: 10,
                            data:data,
                            columnDefs: [{
                                targets: [3],
                                data: null,
                                orderable: true,
                                className: 'details-control',
                                defaultContent: ''
                            }],
                            columns:[
                                {
                                    "data": null,"sortable": false, 
                                    render: function (data, type, row, meta) {
                                        return meta.row + meta.settings._iDisplayStart + 1;
                                    }   
                                },
                                {data:"nama_divisi"},
                                // {
                                //     "data": "amount", 
                                //     render: function (data, type, row, meta) {
                                //         return parseInt(row.amount).toLocaleString('en-us');
                                //     }   
                                // },
                                {
                                    "data": "nama_sub_divisi",
                                    render: function (data, type, row, meta) {
                                        return row.nama_sub_divisi;
                                    } 
                                },
                                {
                                    "data": "budget_all", 
                                    render: function (data, type, row, meta) {
                                        var budget_int = 0;
                                        if(row.budget_all == "" || row.budget_all == null){
                                            budget_int = 0;
                                            // budget_int = row.budget;
                                        }else{
                                            budget_int = row.budget_all;
                                        }
                                        // else{
                                        //     budget_int = parseInt(row.budget_all).toLocaleString('en-us')
                                        // }
                                        // if(budget_int == null || budget_int == 0){
                                        //     budget_int = 0;
                                        // }
                                        if(row.budget == "" || row.budget == null){
                                            row.budget = 0;
                                        }
                                        // var bugdet_all_fixed = parseInt(budget_int) + parseInt(row.budget);
                                        var bugdet_all_fixed = parseInt(budget_int);
                                        console.log(bugdet_all_fixed)
                                        return `<span class="badge badge-primary">`+parseInt(bugdet_all_fixed).toLocaleString('en-us')+`&nbsp;&nbsp;<i class="fa fa-eye"></i></span>`
                                        // return budget_int;
                                    }   
                                },
                                {data:"created_date"},
                                {
                                    "data": null, 
                                    render: function (data, type, row, meta) {
                                        var budget_int_send = 0;
                                        if(row.budget == "" || row.budget == null){
                                            budget_int_send = 0;
                                        }else{
                                            budget_int_send = row.budget;
                                        }
                                        var dinamic_check = ""
                                        if (row.ada == 1)
                                        {
                                            dinamic_check = `<i class="fa fa-check-circle-o" aria-hidden="true"></i>`
                                        }else{
                                            dinamic_check = `<i class="fa fa-circle-o" aria-hidden="true"></i>`
                                        }   
                                        return '<button class="btn btn-primary edit edit_budget_sub_divisi" title="Edit Data" data-toggle="modal" data-id="'+row.id_budget+'|^|'+row.id_sub_divisi+'|^|'+row.nama_divisi+'|^|'+row.amount+'|^|'+budget_int_send+'|^|'+row.nama_sub_divisi+'|^|'+hasil+'" data-target="#editDataSub" style="margin-right:2px"><i class="fa fa-pencil"></i></button><button class="btn btn-danger delete delete_budget_sub" style="margin-right:2px" data-id="'+row.id_sub_divisi+'" title="Delete"><i class="fa fa-trash"></i></button><button class="btn btn-warning transfer transfer_budget_sub_breakdown" data-id="'+row.id_budget+'|^|'+row.id_divisi+'|^|'+row.id_sub_divisi+'|^|'+row.nama_divisi+'|^|'+row.nama_sub_divisi+'" data-toggle="modal" data-target="#trans_dana" title="Transfer Budget"><i class="fa fa-exchange"></i></button>'
                                    }   
                                },
                            ],createdRow: function(row, data, index) {
                                jQuery(row).addClass('tr-header');
                                jQuery(row).attr('data-division', data.id_sub_divisi);
                            },
                        });
                    }
                },complete: function (data) {
                    SlickLoader.disable(); 
                }
            });
        });

        jQuery('#budget_detail').on("click", ".details-control", function(e) {
        e.preventDefault();
        let dt = jQuery('#budget_detail').DataTable();
        let tr  = jQuery(this).closest('tr');
        // console.log(tr)
        division   = tr.data('division');
        let row = dt.row(tr);

        if (row.child.isShown()) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            jQuery('.shown').each(function(i, obj) {
                newtr = jQuery(this).closest('tr');
                newrow = dt.row(newtr);
                newrow.child.hide();
                newtr.removeClass('shown');
            });

            row.child(formatChildBudget(division)).show();
            // SlickLoader.disable();
            tr.addClass('shown');

            tr.next('tr').children('td:first').css('max-width', '0px');
            tr.next('tr').addClass('tr-detail');
        }

        jQuery('#tableInfoDetail').DataTable({
            pageLength: 10,
            destroy: true,
            columnDefs: [{
                targets: [1],
                orderable: false,
                defaultContent: ''
            }]
        });

        });

        function formatChildBudget(division) {
        let htmlInner = '';
            htmlInner =
                '<div class="panel">' +
                '<div class="panel-heading">' +
                '<h6 style="color:#000" class="pull-left">Detail Sub Breakdown</h6>' +
                '<div class="clearfix"></div>' +
                '</div>' +
                '<div class="ibox-content table-responsive">' +
                '<div class="text-center animated fadeInRight" style="padding-top:1%; padding-bottom:1%" hidden id="loader">' +
                '<span class="btn btn-primary shadow"><span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...</span>' +
                '</div>' +
                '<table class="table table-striped table-hover" id="tableInfoDetail">' +
                '<thead>' +
                '<tr>' +
                '<th class="all">No</th>' +
                '<th class="all">Nama Sub Breakdown</th>' +
                '<th class="all">Amount</th>' +
                '<th class="all">Action</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>';
        jQuery.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('list-detail-sub_brekdown_budget') }}",
            data: {
                'division': division,
            },
            async: false,
            success: (function(data) {
                console.log(data)
                jQuery.each(data, function(key, val) {
                    let no_urut_detail = key + 1;
                            var sts_sj = '';
                            if(val.status== 'NonActive'){
                                sts_sj = '<button style="margin:0 auto" class="btn btn-danger btn-xs" title="Active kan" onclick="status_edit_sub('+val.id+')"><i class="fa fa-lock"></i></button>';
                            }else{
                                sts_sj = '<button style="margin:0 auto" class="btn btn-success btn-xs" title="Nonactive kan" onclick="status_edit_sub('+val.id+')"><i class="fa fa-lock"></i></button>';
                            }
                            var button_edit = '';
                            // var sts_sj_rename = '<button class="btn btn-primary edit rename_master_division" data-id="'+val.nama_sub_divisi+'|'+val.id+'" style="margin-right:2px;" data-toggle="modal" data-target="#renameData" title="Rename Data"><i class="fa fa-pencil"></i></button>';
                            var button_edit = '<button class="btn btn-primary edit edit_budget_sub_breakdown" title="Edit Data" data-toggle="modal" data-id="'+val.id+'|^|'+val.id_sub_divisi+'|^|'+val.nama_sub_breakdown+'|^|'+val.amount_sub+'|^|'+val.amount+'" data-target="#editDataSubBreakdown" style="margin-right:2px"><i class="fa fa-pencil"></i></button><button class="btn btn-danger delete delete_budget_sub_breakdown" data-id="'+val.id+'" title="Delete" style="margin-right:2px"><i class="fa fa-trash"></i></button>'

                            var totalSubBreakdown = 0;
                            if(val.amount == null){
                                totalSubBreakdown = 0;
                            }else{
                                totalSubBreakdown = parseInt(val.amount)
                            }
                        htmlInner += '<tr>' +
                        '<td>' + no_urut_detail + '</td>' +
                        '<td>' + val.nama_sub_breakdown + '</td>' +
                        '<td>' + totalSubBreakdown.toLocaleString('en-us') + '</td>' +
                        '<td>' + button_edit + '</td>' +
                        '</tr>';
                    });
            }),
            error: function(data) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Failed to load data',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
            },
            dataType: 'json'
        });

        htmlInner += '</tbody>' +
            '</table>' +
            '</div>' +
            '</div>';

        return htmlInner;
        }

        $(document).on('click', '.delete_budget_sub_breakdown', function(){
            var id = $(this).data('id')
            Swal.fire({
            title: 'Are you sure?',
            text: "Delete this budget?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {
                delete_budget_sub_breakdown(id)
            }
            })
        })

        function delete_budget_sub_breakdown(id){
            SlickLoader.enable();
            $.ajax({
                url:"{{url('delete_budget_sub_breakdown')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    Swal.fire({
                    icon: 'success',
                    title : 'success',
                    text: 'Success Hapus Budget',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(()=>{
                    location.reload()
                },1000)
                },
                error : function(response){
                    Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text : 'Gagal Hapus Budget',
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });   
        }

        var dinams_break_sub = 0;
        var dinams_break_sub2 = 0;
        $(document).on("click", ".edit_budget_sub_breakdown", function(){
            var hasil = $(this).data('id')
            $('#Detail').modal('hide')
            var explode = hasil.split("|^|");
            console.log(explode)
            $('#id_sub_breakdown').val(explode[0])
            $('#breakdown_sub').val()
            $('#amount_edit_break').val(parseInt(explode[3]).toLocaleString('en-us'))
            $('#given_name_sub_break').val(explode[2])
            $('#amount_sub_break').val(parseInt(explode[4]).toLocaleString('en-us'))
            dinams_break_sub = explode[3];
            dinams_break_sub2 = explode[4]
        });

        $(document).on('keyup focus', '#amount_sub_break', function(){
            var hasil_sisa = 0;
            var dana_temp = 0;
            var dana_utama = parseInt(dinams_break_sub);
            var dana_sub = parseInt(dinams_break_sub2);
            dana_temp = dana_utama + dana_sub;
            var number_dinamis = parseInt($('#amount_sub_break').val().replace(/\D/g, ""));
            
            if(dana_sub < number_dinamis){
                hasil_sisa = dana_temp - number_dinamis;
            }else{
                hasil_sisa = dana_temp - number_dinamis;
            }
            if(isNaN(hasil_sisa)){
                $('#amount_edit_break').val(dana_temp.toLocaleString('en-us'))
                $('#amount_sub_break').val('')
                return false
            }else{
                $('#amount_edit_break').val(hasil_sisa.toLocaleString('en-us'))
            }
            if(hasil_sisa < 0){
                Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text : 'budget yang ada input melebihi budget yang tersedia',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#amount_sub_break').val('')
                number_dinamis = parseInt($('#amount_sub_break').val());
                dana_temp = dana_utama + dana_sub;
                $('#amount_edit_break').val(dana_temp.toLocaleString('en-us'))
                return false
            }
            $('#amount_sub_break').val(autoFormatPhoneNumber(number_dinamis))
            $('#amount_edit_break').val(hasil_sisa.toLocaleString('en-us'))
        })

        

        function get_master_sub_divisi(id){
            $('#add_budget_master_sub').empty();
            $('#amount_add_sub').val('');
            SlickLoader.enable();
            $.ajax({
            url:"{{url('getforedit_subdivisi')}}/"+id,
            type:"GET",
            success:function(data){
                $('select[name="add_budget_master_sub"]').append('<option value="" selected = "selected" disabled>Pilih Sub Division ^</option>')
                $.each(data, function(key, value) {
                    $('select[name="add_budget_master_sub"]').append('<option id="division_id_budget_'+value.id_sub_divisi +'" value="' + value.id_sub_divisi + '">' +
                        value.nama_sub_divisi + '</option>');
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });
        }

        var temp_dana_utama = 0;
        var temp_dana_sub = 0;

        $(document).on("click", ".edit_budget_sub_divisi", function(){
                var hasil = $(this).data('id')
                $('#Detail').modal('hide')
                var explode = hasil.split("|^|");
                $('#id_budget_sub').val(explode[0])
                $('#id_budget_divisisub').val(explode[1])
                $('#id_budget_divisi').val(explode[6]);

                temp_dana_utama = explode[3];
                temp_dana_sub = explode[4];
                $('#divisi_edit_budget_sub').val(explode[2])
                $('#amount_edit_sub').val(parseInt(explode[3]).toLocaleString('en-us'))
                $('#amount_add_sub_new').val(parseInt(explode[4]).toLocaleString('en-us'))
                $('#add_budget_master_sub_search').val(explode[5])
            //     get_master_sub_divisi(hasil);
        });

        $(document).on('keyup focus', '#amount_add_sub_new', function(){
            var hasil_sisa = 0;
            var dana_temp = 0;
            var dana_utama = parseInt(temp_dana_utama);
            var dana_sub = parseInt(temp_dana_sub);
            dana_temp = dana_utama + dana_sub;
            var number_dinamis = parseInt($('#amount_add_sub_new').val().replace(/\D/g, ""));
            
            if(dana_sub < number_dinamis){
                hasil_sisa = dana_temp - number_dinamis;
            }else{
                hasil_sisa = dana_temp - number_dinamis;
            }
            if(isNaN(hasil_sisa)){
                $('#amount_edit_sub').val(dana_temp.toLocaleString('en-us'))
                $('#amount_add_sub_new').val('')
                return false
            }else{
                $('#amount_edit_sub').val(hasil_sisa.toLocaleString('en-us'))
            }
            if(hasil_sisa < 0){
                Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text : 'budget yang ada input melebihi budget yang tersedia',
                    showConfirmButton: false,
                    timer: 1500
                });
                $('#amount_add_sub_new').val('')
                number_dinamis = parseInt($('#amount_add_sub_new').val());
                dana_temp = dana_utama + dana_sub;
                // hasil_sisa = dana_temp - number_dinamis;
                $('#amount_edit_sub').val(dana_temp.toLocaleString('en-us'))
                return false
            }
            $('#amount_add_sub_new').val(autoFormatPhoneNumber(number_dinamis))
            $('#amount_edit_sub').val(hasil_sisa.toLocaleString('en-us'))
        })

        $(document).on('change', '#divisi_edit, #role_edit', function(){
            var get_divisi = $('#divisi_edit').val();
            if (!get_divisi){
                alert("pilih divisi dahulu")
                $('#dinamic_sub_edit').removeClass('d-block')
                $('#dinamic_sub_edit').addClass('d-none')
            }
            if ($('#role_edit').val() == '3'){
                $('#dinamic_sub_edit').removeClass('d-none')
                $('#dinamic_sub_edit').addClass('d-block')
                SlickLoader.enable();
                $.ajax({
                    url:"{{url('getsubdivisi')}}/"+get_divisi,
                    type:"GET",
                    success:function(data){
                        console.log(data)
                        $('#sub_divisi_edit').empty()
                        $.each(data, function(key, value) {
                            $('select[name="sub_divisi_edit"]').append('<option id="jabatan_id_'+value.id_sub_divisi +'" value="' + value.id_sub_divisi + '">' +
                                value.nama_sub_divisi + '</option>');
                                // if(value.id_sub_divisi == '6'){
                                //     $('#jabatan_id_'+value.id_sub_divisi).attr('selected','selected');
                                // }
                        });
                    },complete: function (data) {
                SlickLoader.disable(); 
            }
                });
            }
        })

        $(document).on('change', '#divisi, #role', function(){
            var get_divisi = $('#divisi').val();
            if (!get_divisi){
                alert("pilih divisi dahulu")
                $('#dinamic_sub').removeClass('d-block')
                $('#dinamic_sub').addClass('d-none')
            }
            if ($('#role').val() == '3'){
                $('#dinamic_sub').removeClass('d-none')
                $('#dinamic_sub').addClass('d-block')
                SlickLoader.enable()
                $.ajax({
                    url:"{{url('getsubdivisi')}}/"+get_divisi,
                    type:"GET",
                    success:function(data){
                        console.log(data)
                        $('#sub_divisi').empty()
                        $.each(data, function(key, value) {
                            $('select[name="sub_divisi"]').append('<option id="jabatan_id_'+value.id_sub_divisi +'" value="' + value.id_sub_divisi + '">' +
                                value.nama_sub_divisi + '</option>');
                                // if(value.id_sub_divisi == '6'){
                                //     $('#jabatan_id_'+value.id_sub_divisi).attr('selected','selected');
                                // }
                        });
                    },complete: function (data) {
                SlickLoader.disable(); 
            }
                });
            }
        })

            // EDIT USER
            var user_admin = `<div class="form-group margin-bot-5">
                                <label class="col-form-label" for="message-text">Role :</label>
                                <input class="form-control" id="role_edit_temp" type="text" required disabled>
                                <input class="form-control" name="role_edit" id="role_edit" type="hidden" required disabled>
                            </div>`

            var user_option = `<div class="form-group margin-bot-5">
                                    <label class="col-form-label" for="message-text">Role :</label>
                                    <select class="form-control" name="role_edit" id="role_edit">
                                    </select>
                                </div>`

            var arry_sub = [];
            $(document).on("click", ".edit_user", function(){
                SlickLoader.enable();
                arry_sub = [];
                var hasil = $(this).data('id')
                var explode = hasil.split("|^|");
                $('select[name="jabatan_edit"]').empty();
                $('#jabatan_edit').empty();
                $('select[name="divisi_edit"]').empty();
                $('select[name="role_edit"]').empty();
                $('#role_edit_temp').val('');
                $('#dinamic_user').empty();
                $('#email_edit').val();
                $('#username_edit').val();
                
                $.ajax({
                url:"{{url('getforedit')}}",
                type:"GET",
                success:function(data){
                    $('#id_user').val(explode[0])
                    $('#username_edit').val(explode[1])
                    $.each(data.data_jabatan, function(key, value) {
                        $('select[name="jabatan_edit"]').append('<option id="jabatan_id_'+value.id_jabatan +'" value="' + value.id_jabatan + '">' +
                            value.nama_jabatan + '</option>');
                            if(value.nama_jabatan == explode[2]){
                                $('#jabatan_id_'+value.id_jabatan).attr('selected','selected');
                            }
                    });
                    $.each(data.data_divisi, function(key, value) {
                        $('select[name="divisi_edit"]').append('<option id="division_id_'+value.id_divisi +'" value="' + value.id_divisi + '">' +
                            value.nama_divisi + '</option>');
                            if(value.nama_divisi == explode[3]){
                                $('#division_id_'+value.id_divisi).attr('selected','selected');
                            }
                    });
                    if (explode[5] == '2'){
                            $('#dinamic_user').append(user_admin);
                            $('#role_edit').val(explode[5]);
                            $('#role_edit_temp').val('admin');
                    }else{
                        $('#dinamic_user').append(user_option);
                        $.each(data.data_role, function(key, value) {
                            console.log("s")
                            $('select[name="role_edit"]').append('<option id="role_id_'+value.id +'" value="' + value.id + '">' +
                                value.name_role + '</option>');
                                if(value.id == explode[5]){
                                    $('#role_id_'+value.id).attr('selected','selected');
                                }   
                        });
                    }

                    if($('#role_edit').val() == "3"){
                        $.ajax({
                        url:"{{url('getforedit-sub')}}/"+explode[3],
                        type:"GET",
                        success:function(handler){
                            $('#dinamic_sub_edit').removeClass('d-none');
                            $('#dinamic_sub_edit').addClass('d-block');
                            $('#sub_divisi_edit').empty();
                            arry_sub.push(data.data_sub)
                            $.each(handler.data_sub, function(key, value) {
                                $('select[name="sub_divisi_edit"]').append('<option id="role_id_'+value.id_sub_divisi +'" value="' + value.id_sub_divisi + '">' +
                                    value.nama_sub_divisi + '</option>');
                                    if(value.id_sub_divisi == explode[6]){
                                        $('#role_id_'+value.id_sub_divisi).attr('selected','selected');
                                    }   
                            });
                        }
                    })
                    }else{
                        $('#dinamic_sub_edit').removeClass('d-block');
                        $('#dinamic_sub_edit').addClass('d-none');
                    }
                    $('#email_edit').val(explode[4])
                    SlickLoader.disable();
                }
            });
            });

            $(document).on('change', '#role_edit', function(){
                if(this.value == "3"){
                        $('#dinamic_sub_edit').removeClass('d-none');
                        $('#dinamic_sub_edit').addClass('d-block');
                    }else{
                        $('#dinamic_sub_edit').removeClass('d-block');
                        $('#dinamic_sub_edit').addClass('d-none');
                    }

            })

            // END EDIT USER

            $(document).on("change", "#role", function(){
                if(this.value == '3'){
                    $('#dinamic_sub').removeClass('d-none')
                    $('#dinamic_sub').addClass('d-block')
                }else{
                    $('#dinamic_sub').removeClass('d-block')
                    $('#dinamic_sub').addClass('d-none')
                }
            })

            // var data_temp_request = $('#saldo_page_hidden').val();
            var data_temp_request = 0;
            $(document).on('change', '#select_budget2', function(){
                SlickLoader.enable();
                $('#id_sb_breakdown2').val(this.value)
                $('#nilai_biaya').val('')
                    $('#dinamic_view2').empty()
                    $.ajax({
                    url:"{{url('check_sub_breakdown')}}/"+this.value,
                    type:"GET",
                    success:function(data){
                        console.log(data[0].amount)
                        var budget = 0;
                        if (data[0].amount == null) {
                            budget = 0;
                        }else{
                            budget = parseInt(data[0].amount)
                        }
                        console.log(budget)
                        $('#dinamic_view2').append(`<h1>Saldo <span id="saldo_page">`+budget.toLocaleString('en-us')+`</span></h1>
                                            <input type="hidden" id="saldo_page_hidden" value="`+budget+`">`)
                        setTimeout(() => {
                            data_temp_request = $('#saldo_page_hidden').val();
                        }, 1000);
                        },complete: function (data) {
                        SlickLoader.disable(); 
                    }
                    });
            })
            $(document).on('keyup focus', '#nilai_biaya', function(){
                var data_request = parseInt(data_temp_request);
                var number_typing = parseInt($('#nilai_biaya').val().replace(/\D/g, ""));
                if($('#nilai_biaya').val() == '-' || $('#nilai_biaya').val() == '+' || $('#nilai_biaya').val() == '.'){
                    $('#saldo_page').text(data_request.toLocaleString('en-us'))
                    $('#saldo_page_hidden').val(data_request.toLocaleString('en-us'))
                    $('#nilai_biaya').val('')
                    return false
                }
                console.log(data_request)
                return false
                $('#nilai_biaya').val(autoFormatPhoneNumber(number_typing))
                var hasil_dari_budget = data_request - number_typing;
                if(isNaN(hasil_dari_budget)){
                    $('#saldo_page').text(data_request.toLocaleString('en-us'))
                    $('#saldo_page_hidden').val(data_request.toLocaleString('en-us'))
                    $('#nilai_biaya').val('')
                    return false
                }else{
                    $('#saldo_page').text(hasil_dari_budget.toLocaleString('en-us'))
                    $('#saldo_page_hidden').val(hasil_dari_budget.toLocaleString('en-us'))
                }
                if(hasil_dari_budget < 0 ){
                    Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text : 'budget yang ada input melebihi budget yang tersedia',
                    showConfirmButton: false,
                    timer: 1500
                    });
                    $('#saldo_page').text(data_request.toLocaleString('en-us'))
                    $('#saldo_page_hidden').val(data_request.toLocaleString('en-us'))
                    $('#nilai_biaya').val('')
                }
            })

            var data_temp_request_page = 0;
            $(document).on('change', '#select_budget', function(){
                SlickLoader.enable();
                $('#id_sb_breakdown').val(this.value)
                $('#dinamic_view').empty()
                $.ajax({
                    url:"{{url('check_sub_breakdown')}}/"+this.value,
                    type:"GET",
                    success:function(data){
                        console.log(data[0].amount)
                        var budget = 0;
                        if (data[0].amount == null) {
                            budget = 0;
                        }else{
                            budget = parseInt(data[0].amount)
                        }
                        console.log(budget)
                        $('#dinamic_view').append(`<h1>Saldo <span id="saldo_page_page">`+budget.toLocaleString('en-us')+`</span></h1>
                                            <input type="hidden" id="saldo_page_page_hidden" value="`+budget+`">`)
                        setTimeout(() => {
                            data_temp_request_page = $('#saldo_page_page_hidden').val();
                        }, 1000);
                        },complete: function (data) {
                        SlickLoader.disable(); 
                    }
                });
                
                $(document).on('keyup focus', '#biaya_utuh', function(e){
                    var num = autoFormatPhoneNumber(e.target.value);
                    var data_request_page = parseInt(data_temp_request_page);
                    console.log(data_request_page, 'dikene');
                    var number_typing_page = parseInt($('#biaya_utuh').val().replace(/\D/g, ""));
                    if($('#biaya_utuh').val() == '-' || $('#biaya_utuh').val() == '+' || $('#biaya_utuh').val() == '.'){
                        $('#saldo_page_page').text(data_request_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(data_request_page.toLocaleString('en-us'))
                        $('#biaya_utuh').val('')
                        return false
                    }
                    $('#biaya_utuh').val(num);
                    // $('#biaya_utuh').val(number_typing_page.toLocaleString('en-us'))
                    var hasil_dari_budget_page = data_request_page - number_typing_page;
                    if(isNaN(hasil_dari_budget_page)){
                        $('#saldo_page_page').text(data_request_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(data_request_page.toLocaleString('en-us'))
                        $('#biaya_utuh').val('')
                        return false
                    }else{
                        $('#saldo_page_page').text(hasil_dari_budget_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(hasil_dari_budget_page.toLocaleString('en-us'))
                    }
                    if(hasil_dari_budget_page < 0 ){
                        Swal.fire({
                        icon: 'error',
                        title: 'error',
                        text : 'budget yang ada input melebihi budget yang tersedia',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        $('#saldo_page_page').text(data_request_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(data_request_page.toLocaleString('en-us'))
                        $('#biaya_utuh').val('')
                    }
                })
            }) 
            
            $(document).on('keyup focus', '#biaya_utuh', function(e){
                    var num = autoFormatPhoneNumber(e.target.value);
                    var data_request_page = parseInt(data_temp_request_page);
                    console.log(data_request_page, 'dikene');
                    var number_typing_page = parseInt($('#biaya_utuh').val().replace(/\D/g, ""));
                    if($('#biaya_utuh').val() == '-' || $('#biaya_utuh').val() == '+' || $('#biaya_utuh').val() == '.'){
                        $('#saldo_page_page').text(data_request_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(data_request_page.toLocaleString('en-us'))
                        $('#biaya_utuh').val('')
                        return false
                    }
                    $('#biaya_utuh').val(num);
                    // $('#biaya_utuh').val(number_typing_page.toLocaleString('en-us'))
                    var hasil_dari_budget_page = data_request_page - number_typing_page;
                    if(isNaN(hasil_dari_budget_page)){
                        $('#saldo_page_page').text(data_request_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(data_request_page.toLocaleString('en-us'))
                        $('#biaya_utuh').val('')
                        return false
                    }else{
                        $('#saldo_page_page').text(hasil_dari_budget_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(hasil_dari_budget_page.toLocaleString('en-us'))
                    }
                    if(hasil_dari_budget_page < 0 ){
                        Swal.fire({
                        icon: 'error',
                        title: 'error',
                        text : 'budget yang ada input melebihi budget yang tersedia',
                        showConfirmButton: false,
                        timer: 1500
                        });
                        $('#saldo_page_page').text(data_request_page.toLocaleString('en-us'))
                        $('#saldo_page_page_hidden').val(data_request_page.toLocaleString('en-us'))
                        $('#biaya_utuh').val('')
                    }
                })

            $(document).on("click", ".delete_master_division", function() {
                var id = $(this).data('id')
                Swal.fire({
                title: 'Are you sure?',
                text: "Delete this Division",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    delete_divisi(id)
                }
                })
            })

            $(document).on("click", ".delete_budget_sub", function() {
                var id = $(this).data('id')
                Swal.fire({
                title: 'Are you sure?',
                text: "Delete this budget?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    delete_budget_sub(id)
                }
                })
            })

            $(document).on("click", ".delete_user", function() {
                var id = $(this).data('id')
                Swal.fire({
                title: 'Are you sure?',
                text: "Delete this User",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    delete_user(id)
                }
                })
            })

            $(document).on("click", ".delete_budget", function() {
                var id = $(this).data('id')
                Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to withdraw these funds?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
                }).then((result) => {
                if (result.isConfirmed) {
                    delete_budget(id)
                }
                })
            })
        })


        function delete_divisi(id){
            SlickLoader.enable();
            $.ajax({
                url:"{{url('DeleteDivisi')}}" + "/" + id,
                type:"GET",
                success:function(response){
                Swal.fire({
                    icon: response.status,
                    text : response.status,
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(()=>{
                    location.reload()
                },1000)
                },
                error : function(response){
                Swal.fire({
                    icon: response.status,
                    text : response.status,
                    title: response.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });
        }

        function delete_user(id){
            SlickLoader.enable();
            $.ajax({
                url:"{{url('DeleteUser')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    Swal.fire({
                        icon: 'success',
                        text : 'success',
                        title: response.message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(()=>{
                    location.reload()
                },1000)
                },
                error : function(response){
                    Swal.fire({
                    icon: 'error',
                    text : 'error',
                    title: response.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });
        }

        function status_edit(id){
            SlickLoader.enable();
            $.ajax({
                url:"{{url('status_update')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    Swal.fire({
                    icon: 'success',
                    text : 'success',
                    title: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(()=>{
                    location.reload()
                },1000)
                },
                error : function(response){
                    Swal.fire({
                    icon: 'error',
                    text : 'error',
                    title: response.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });   
        }

        function delete_budget(id){
            SlickLoader.enable();
            $.ajax({
                url:"{{url('delete_budget')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    Swal.fire({
                    icon: response.status,
                    title : response.status,
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(()=>{
                    location.reload()
                },1000)
                },
                error : function(response){
                    Swal.fire({
                    icon: response.status,
                    title : response.status,
                    text: response.responseJSON.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });   
        }

        function delete_budget_sub(id){
            SlickLoader.enable();
            $.ajax({
                url:"{{url('delete_budget_sub')}}" + "/" + id,
                type:"GET",
                success:function(response){
                    Swal.fire({
                    icon: 'success',
                    title : 'success',
                    text: response.message,
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(()=>{
                    location.reload()
                },1000)
                },
                error : function(response){
                    Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text : 'Gagal Hapus Sub Division',
                    showConfirmButton: false,
                    timer: 1500
                });
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            });   
        }

        

        function save_data_user(){
            var dataMenu = $('#dataMenu').val();
            var username = $('#username').val();
            var jabatan = $('#jabatan').val();
            var divisi = $('#divisi').val();
            var role = $('#role').val();
            var email = $('#email').val();
            var subDivisi = $('#sub_divisi').val();
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'username':username,
                'jabatan':jabatan,
                'divisi':divisi,
                'role':role,
                'email':email,
                'subDivisi' : subDivisi,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Insert User',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Insert User',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                // setTimeout(() => {
                //     location.reload();
                // }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })

        }

        function edit_user(){
            var dataMenu = $('#dataMenuEdit').val();
            var id_user = $('#id_user').val();
            var username_edit = $('#username_edit').val();
            var jabatan_edit = $('#jabatan_edit').val();
            var divisi_edit = $('#divisi_edit').val();
            var role_edit = $('#role_edit').val();
            var email_edit = $('#email_edit').val();
            var sub_divisi = $('#sub_divisi_edit').val();
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'id_user' : id_user,
                'username_edit':username_edit,
                'jabatan_edit':jabatan_edit,
                'divisi_edit':divisi_edit,
                'role_edit':role_edit,
                'email_edit':email_edit,
                'sub_divisi':sub_divisi
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update User',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update User',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
            },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function save_division(){
            var dataMenu = $('#dataMenu').val();
            var division = $('#division').val();
            var status = $('#status').val();
            var type = $('#type').val();
            if(status == "" || type == ""){
                Swal.fire({
                    title: 'Failed!',
                    text: 'Harap Isi Form Lengkap',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
            }
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'division':division,
                'status':status,
                'type':type,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Insert Division',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Insert Division',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
                
            })

        }

        function edit_division(){
            var dataMenu = $('#dataMenuEdit').val();
            var id = $('#idDivisiEdit').val();
            var division = $('#divisi_ril').val();
            var breakdown = $('#breakdown_edit').val();
            var status = $('#select_division').val();
            var type_edit = $('#type_edit').val();
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'id' : id,
                'division':division,
                'breakdown':breakdown,
                'status':status,
                'type_edit' : type_edit,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update Division',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update Division',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        $(document).on('keyup focus', '#amount', function(){
            var value = parseInt($('#amount').val().replace(/\D/g, ""));
            $('#amount').val(autoFormatPhoneNumber(value));
        })

        function save_budget(){
            var dataMenu = $('#dataMenu').val();
            var divisi = $('#divisi').val();
            var amount = $('#amount').val();
            var checkBox = $('#checkbox_new').is(':checked');
            var periode = $('#periode').val();

            if(divisi == null || (amount == null || amount == "")){
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Harap Isi Coloum',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })

                return false;
            }
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'divisi':divisi,
                'amount':amount,
                'checkBox':checkBox,
                'periode':periode,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Insert Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Insert Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function update_budget(){
            var arr_sub_breaakdown = []
            var arr_budget = []
            var dataMenu = $('#dataMenuEdit').val();
            var id_budget = $('#id_budget').val();
            var divisi_edit_budget = $('#divisi_edit_budget').val();
            var amount_edit = $('#amount_edit').val();
            var add_budget_master_sub = $('#add_budget_master_sub').val();
            var amount_add_sub = $('#amount_add_sub').val();
            var temp_amount = $('#temp_amount').val();
            var sisa_hasil = $('#sisa_hasil').val();
            var division_temp = $('#division_temp').val();
            var sub_breaakdown = document.getElementsByName('add_budget_select_sub_ex[]')
            var budget = document.getElementsByName('subbudgetbreakdown[]')
            for(var k=0; k<sub_breaakdown.length; k++){
                data_id = sub_breaakdown[k].id;
                data_budget = budget[k].id;
                arr_sub_breaakdown.push($('#'+data_id).val())
                arr_budget.push($('#'+data_budget).val())
            }
            
            if (amount_add_sub == ""){
                Swal.fire({
                    title: 'Error!',
                    text: 'Budget Belum di bagi',
                    icon: 'error',
                    confirmButtonText: 'Oke',

                });   
                return false
            }
            if (add_budget_master_sub == null){
                Swal.fire({
                    title: 'Error!',
                    text: 'Harap di pilih sub divisi',
                    icon: 'error',
                    confirmButtonText: 'Oke',

                });   
                return false
            }
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'id_budget' : id_budget,
                'divisi_edit_budget':divisi_edit_budget,
                'amount_edit':amount_edit,
                'add_budget_master_sub':add_budget_master_sub,
                'amount_add_sub':amount_add_sub,
                'temp_amount':temp_amount,
                'sisa_hasil':sisa_hasil,
                'division_temp':division_temp,
                'arr_sub_breaakdown' : arr_sub_breaakdown,
                'arr_budget' : arr_budget
            },

            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update dan Pembagian Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update dan Pembagian Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function update_budget_divisi(){
            var dataMenu = $('#dataMenuEditDivisi').val();
            var id = $('#id_budget_update').val();
            var divisi = $('#divisi_id_update').val();
            var amount = $('#amount_edit_divisi').val();
            var periode_edit = $('#periode_edit').val();

            if(amount == "" || periode_edit == ""){
                Swal.fire({
                    title: 'Failed!',
                    text: 'Isi kolom terlebih dahulu',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                return false;
            }
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'id' : id,
                'divisi':divisi,
                'amount':amount,
                'periode_edit':periode_edit,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function update_budget_sub(){
            var dataMenu = $('#dataMenuEditSub').val();
            var id_budget = $('#id_budget_sub').val();
            var id_budget_divisisub_ = $('#id_budget_divisisub').val();
            var id_budget_divisi = $('#id_budget_divisi').val();
            var divisi_edit_budget = $('#divisi_edit_budget_sub').val();
            var amount_edit = $('#amount_edit_sub').val();
            var add_budget_master_sub = $('#add_budget_master_sub_search').val();
            var amount_add_sub = $('#amount_add_sub_new').val();
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'id_budget' : id_budget,
                'id_sub'    : id_budget_divisisub_,
                'id_budget_divisi' : id_budget_divisi,
                'divisi_edit_budget':divisi_edit_budget,
                'amount_edit':amount_edit,
                'add_budget_master_sub':add_budget_master_sub,
                'amount_add_sub':amount_add_sub,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update Pembagian Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Update Pembagian Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function Change_Temp_Dana(){
            var id_divisi = $('#id_divisi_temp').val();
            var temp_amount = $('#amount_temp_divisi').val().replace(/\D/g, "");
            var upd_divisi = $('#divisi_temp').val();
            var given_amount = $('#amunt_temp').val().replace(/\D/g, "");

            if(upd_divisi == null || (given_amount == null || given_amount == "")){
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Harap Isi Coloum',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })

                return false;
            }
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('update.temp.and.given') }}",
            data: {
                'id_divisi':id_divisi,
                'temp_amount':temp_amount,
                'upd_divisi':upd_divisi,
                'given_amount':given_amount,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Success Given Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Failed!',
                    text: 'Failed Given Budget',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function save_transfer_budget(){
            var id_data_trans = $('#id_data_trans').val();
            var idOriginBudget = $('#idOriginBudget').val();
            var idSubBreakdown = $('#transSubBreakdown').val();
            var sisaBudget = $('#budget_divisi_trans').val().replace(/\D/g, "");
            var amount_temp_trans = $('#amunt_temp_trans').val().replace(/\D/g, "");
            var amount_temp_trans_sub = $('#amunt_temp_trans_sub').val().replace(/\D/g, "");
            // transfer ke
            var divisi_temp_trans = $('#divisi_temp_trans').val();
            var breakdownBudget = $('#breakdownBudget').val();
            var breakdownSubBudget = $('#breakdownSubBudget').val();

            if(id_data_trans == null){
                Swal.fire({
                    title: 'Failed!',
                    text: 'Gagal Harap Isi Coloum',
                    icon: 'error',
                    confirmButtonText: 'Oke'
                })

                return false;
            }
            SlickLoader.enable();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('save.transfer.budget') }}",
                data: {
                    'id_data_trans':id_data_trans,
                    'idOriginBudget':idOriginBudget, 
                    'idSubBreakdown':idSubBreakdown,
                    'sisaBudget':sisaBudget,
                    'amount_trans':amount_temp_trans,
                    'amount_trans_sub':amount_temp_trans_sub,
                    'divisi_temp_trans': divisi_temp_trans,
                    'breakdownBudget': breakdownBudget,
                    'breakdownSubBudget': breakdownSubBudget
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Success Transfer Budget',
                        icon: 'info',
                        confirmButtonText: 'Oke',

                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Failed Transfer Budget',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                    setTimeout(() => {
                        // location.reload();
                    }, 1000);
                    },complete: function (data) {
                    SlickLoader.disable(); 
                }
            })
        }

        function downlOad_pdf(id){
            const url = './file_upload/document/'+id;
            window.open(url, '_blank');
        }

        $(document).on('hide.bs.modal','#DetailRequestBudget2', function () {
            setTimeout(() => {
                location.reload();
            }, 1000);
        });

        $(document).on('hide.bs.modal','#DetailRequestBudget', function () {
            setTimeout(() => {
                location.reload();
            }, 1000);
        });
        
        $(document).on("click", ".detail-request_budget", function(){
            // console.log(window.location.href = './file_upload/document/Kertu-Bimbingan_new.pdf');
                var hasil = $(this).data('id')
                $('#body_request_budget').empty();
                SlickLoader.enable();
                $.ajax({
                url:"{{url('get_detail_request_budget')}}/"+hasil,
                type:"GET",
                success:function(data){
                        // console.log('cok',data);
                        if(data[0].type == 'type1'){

                            $('#DetailRequestBudget2').remove();
                            $('#approve_kadiv_button').removeClass('d-none');
                                $('#approve_admin_button').removeClass('d-none');
                                $('#reject_button_admin').removeClass('d-none');
                                $('#reject_button_kadiv').removeClass('d-none');
                                $('#approve_kadiv_button').removeClass('d-block');
                                $('#approve_admin_button').removeClass('d-block');
                                $('#reject_button_admin').removeClass('d-block');
                                $('#reject_button_kadiv').removeClass('d-block');
                            if(data[0].status == '1'){
                                $('#approve_kadiv_button').addClass('d-none');
                                $('#reject_button_kadiv').addClass('d-none');
                                $('#approve_admin_button').addClass('d-block');
                                $('#reject_button_admin').addClass('d-block');
                            }else if(data[0].status == '2'){
                                $('#approve_kadiv_button').addClass('d-none');
                                $('#approve_admin_button').addClass('d-none');
                                $('#reject_button_admin').addClass('d-none');
                                $('#reject_button_kadiv').addClass('d-none');
                            }else if(data[0].status == '3'){
                                $('#approve_kadiv_button').addClass('d-none');
                                $('#approve_admin_button').addClass('d-none');
                                $('#reject_button_admin').addClass('d-none');
                                $('#reject_button_kadiv').addClass('d-none');
                            }else{
                                $('#approve_kadiv_button').addClass('d-block');
                                $('#approve_admin_button').addClass('d-block');
                                $('#reject_button_admin').addClass('d-block');
                                $('#reject_button_kadiv').addClass('d-block');
                            }
                            $('#id_request_budget_approve').val(data[0].id);
                            $('#auth_request').val(data[0].id_user);
                            $('#sub_divisi_disp').val(data[0].id_sub_divisi);
                            $('#budget_req').val(data[0].nilai_pembiayaan);
                            
                            let dtlFrm = document.getElementById("dtlFormUsulan");
                            dtlFrm.innerHTML  = 
                            '<tr><th class="text-center">Produk</th><td class="text-center">'+data[0].produk+'</td></tr>'+
                            '<tr><th class="text-center">Item Produk</th><td class="text-center">'+data[0].produk_item+'</td></tr>'+
                            '<tr><th class="text-center">Sasaran Outlet</th><td class="text-center">'+data[0].sasaran_outlet+'</td></tr>'+
                            '<tr><th class="text-center">Wilayah</th><td class="text-center">'+data[0].wilayah+'</td></tr>'+
                            '<tr><th class="text-center">Tujuan Promosi</th><td class="text-center">'+data[0].tujuan_promosi+'</td></tr>'+
                            '<tr><th class="text-center">Rincian Biaya Omzet</th><td class="text-center">'+data[0].rincian_rata_omzet+'</td></tr>'+
                            '<tr><th class="text-center">Rincian Target</th><td class="text-center">'+data[0].rincian_target+'</td></tr>'+
                            '<tr><th class="text-center">Periode</th><td class="text-center">'+data[0].periode_from+' s/d '+data[0].periode_end+'</td></tr>'+
                            '<tr><th class="text-center">Jenis Promosi</th><td class="text-center">'+data[0].jenis_promosi+'</td></tr>'+
                            '<tr><th class="text-center">Mekanisme Promo</th><td class="text-center">'+data[0].mekanis_promo+'</td></tr>'+
                            '<tr><th class="text-center">Rincian Biaya</th><td class="text-center">'+data[0].rincian_biaya+'</td></tr>'+
                            '<tr><th class="text-center">Keterangan</th><td class="text-center">'+data[0].keterangan+'</td></tr>'+
                            '<tr><th class="text-center">File Pendukung</th><td class="text-center"><button type="button" class="btn btn-secondary btn-sm" onclick="downlOad_pdf(\''+data[0].filename+'\')"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download</button></td></tr>';
                            
                            $('#downloadpdfReqDtl').attr('onclick', 'downloadpdfReqDtl('+data[0].id+')');
                            // $('#request_budget').DataTable({
                            // "fixedHeader": true,
                            // "destroy":true,
                            // "data":data,
                            //     columns:[
                            //         {
                            //             "data": null,"sortable": false, 
                            //             render: function (data, type, row, meta) {
                            //                 return meta.row + meta.settings._iDisplayStart + 1;
                            //             }   
                            //         },
                            //         {data:"nama_divisi"},
                            //         {data:"username"},
                            //         {data:"nama_sub_divisi"},
                            //         // {data:"nama_jabatan"},
                            //         {data:"produk"},
                            //         {data:"produk_item"},
                            //         {data:"sasaran_outlet"},
                            //         {data:"wilayah"},
                            //         {data:"tujuan_promosi"},
                            //         {data:"rincian_rata_omzet"},
                            //         {data:"rincian_target"},
                            //         {data:"rincian_biaya"},
                            //         {data:"jenis_promosi"},
                            //         {data:"mekanis_promo"},
                            //         {
                            //             "data": "nilai_pembiayaan", 
                            //             render: function (data, type, row, meta) {
                            //                 return parseInt(row.nilai_pembiayaan).toLocaleString('en-us');
                            //             }   
                            //         },
                            //         {data:"keterangan"},
                            //         {data:"request_date"},
                            //         {data:"approve_date"},
                            //         {data:"reject_date"},
                            //         {
                            //             "data": "filename", 
                            //             render: function (data, type, row, meta) {
                            //                 if(row.filename){
                            //                     return '<a href="" class="btn btn-primary" onclick="downlOad_pdf(\''+row.filename+'\')" target="blank_" download><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                            //                 }
                            //                 return '';
                            //             }   
                            //         },
                            //     ],
                            // });
                        }else{

                            $('#DetailRequestBudget').remove();
                            $('#approve_kadiv_button').removeClass('d-none');
                                $('#approve_admin_button').removeClass('d-none');
                                $('#reject_button_admin').removeClass('d-none');
                                $('#reject_button_kadiv').removeClass('d-none');
                                $('#approve_kadiv_button').removeClass('d-block');
                                $('#approve_admin_button').removeClass('d-block');
                                $('#reject_button_admin').removeClass('d-block');
                                $('#reject_button_kadiv').removeClass('d-block');
                            if(data[0].status == '1'){
                                $('#approve_kadiv_button').addClass('d-none');
                                $('#reject_button_kadiv').addClass('d-none');
                                $('#approve_admin_button').addClass('d-block');
                                $('#reject_button_admin').addClass('d-block');
                            }else if(data[0].status == '2'){
                                $('#approve_kadiv_button').addClass('d-none');
                                $('#approve_admin_button').addClass('d-none');
                                $('#reject_button_admin').addClass('d-none');
                                $('#reject_button_kadiv').addClass('d-none');
                            }else if(data[0].status == '3'){
                                $('#approve_kadiv_button').addClass('d-none');
                                $('#approve_admin_button').addClass('d-none');
                                $('#reject_button_admin').addClass('d-none');
                                $('#reject_button_kadiv').addClass('d-none');
                            }else{
                                $('#approve_kadiv_button').addClass('d-block');
                                $('#approve_admin_button').addClass('d-block');
                                $('#reject_button_admin').addClass('d-block');
                                $('#reject_button_kadiv').addClass('d-block');
                            }
                            $('#id_request_budget_approve').val(data[0].id);
                            $('#auth_request').val(data[0].id_user);
                            $('#sub_divisi_disp').val(data[0].id_sub_divisi);
                            $('#budget_req').val(data[0].nilai_pembiayaan);



                            // $('#request_budget').DataTable({
                            //     "fixedHeader": true,
                            //     "destroy":true,
                            //     "data":data,
                            //     columns:[
                            //         {
                            //             "data": null,"sortable": false, 
                            //             render: function (data, type, row, meta) {
                            //                 return meta.row + meta.settings._iDisplayStart + 1;
                            //             }   
                            //         },
                            //         {data:"nama_divisi"},
                            //         {data:"username"},
                            //         {data:"nama_sub_divisi"},
                            //         // {data:"nama_jabatan"},
                            //         {data:"pembiayaan"},
                            //         {
                            //             "data": "nilai_pembiayaan", 
                            //             render: function (data, type, row, meta) {
                            //                 return parseInt(row.nilai_pembiayaan).toLocaleString('en-us');
                            //             }   
                            //         },
                            //         {data:"keterangan"},
                            //         {data:"request_date"},
                            //         {data:"approve_date"},
                            //         {data:"reject_date"},
                            //         {
                            //             "data": "filename", 
                            //             render: function (data, type, row, meta) {
                            //                 if(row.filename){
                            //                     return '<a href="" class="btn btn-primary" onclick="downlOad_pdf(\''+row.filename+'\')" target="blank_" download ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                            //                 }
                            //                 return '';
                            //             }   
                            //         },
                            //     ],
                            // });
                        }
                        // }else{
                        //     $('#request_budget').DataTable({
                        //     "fixedHeader": true,
                        //     "destroy":true,
                        //     "data":data,
                        //         columns:[
                        //             {
                        //                 "data": null,"sortable": false, 
                        //                 render: function (data, type, row, meta) {
                        //                     return meta.row + meta.settings._iDisplayStart + 1;
                        //                 }   
                        //             },
                        //             {data:"nama_divisi"},
                        //             {data:"username"},
                        //             {data:"nama_sub_divisi"},
                        //             {data:"nama_jabatan"},
                        //             {data:"produk"},
                        //             {data:"produk_item"},
                        //             {data:"sasaran_outlet"},
                        //             {data:"wilayah"},
                        //             {data:"tujuan_promosi"},
                        //             {data:"rincian_rata_omzet"},
                        //             {data:"rincian_target"},
                        //             {data:"rincian_biaya"},
                        //             {data:"jenis_promosi"},
                        //             {data:"mekanis_promo"},
                        //             {
                        //                 "data": "pembiayaan", 
                        //                 render: function (data, type, row, meta) {
                        //                     return row.pembiayaan;
                        //                 }   
                        //             },
                        //             // {data:"pembiayaan"},
                        //             {
                        //                 "data": "nilai_pembiayaan", 
                        //                 render: function (data, type, row, meta) {
                        //                     return parseInt(row.nilai_pembiayaan).toLocaleString('en-us');
                        //                 }   
                        //             },
                        //             {data:"keterangan"},
                        //             {data:"request_date"},
                        //             {data:"approve_date"},
                        //             {data:"reject_date"},
                        //             {
                        //                 "data": "filename", 
                        //                 render: function (data, type, row, meta) {
                        //                     if(row.filename){
                        //                         return '<a href="" onclick="downlOad_pdf(\''+row.filename+'\')" target="blank_" download ><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>';
                        //                     }
                        //                     return '';
                        //                 }   
                        //             },
                        //         ],
                        //     });
                        // }
                    },complete: function (data) {
                SlickLoader.disable(); 
            }
                });
            });


            $('form#request_budget_send').submit(function(e){
                e.preventDefault()
                var formData = new FormData(this)
                SlickLoader.enable();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                processData: false,
                contentType: false,
                cache: false,
                // enctype: 'multipart/form-data',
                url: "{{ route('request_new_ya') }}",
                data:formData,
                success: function(data) {
                    if(data.status == '200'){
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'info',
                            confirmButtonText: 'Oke',
    
                        });
                    }else{
                        Swal.fire({
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'Gagal Update Pembagian Budget',
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                        setTimeout(() => {
                            // location.reload();
                        }, 1000);
                        },complete: function (data) {
                SlickLoader.disable(); 
            }
                    })

            })

            $('form#request_budget_send_pertama').submit(function(e){
                e.preventDefault()
                var formData = new FormData(this)
                SlickLoader.enable();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                processData: false,
                contentType: false,
                cache: false,
                // enctype: 'multipart/form-data',
                url: "{{ route('save.request.budget') }}",
                data:formData,
                success: function(data) {
                    if(data.status == '200'){
                        Swal.fire({
                            title: 'Success!',
                            text: data.message,
                            icon: 'info',
                            confirmButtonText: 'Oke',
                        });
                    }else{
                        Swal.fire({
                            title: 'Failed!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                    }
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'Gagal Proses Budget Baru',
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                        setTimeout(() => {
                            // location.reload();
                        }, 1000);
                        },complete: function (data) {
                SlickLoader.disable(); 
            }
                    })

            })

            function approve_kadiv(){
                // alert($('#id_request_budget_approve').val());
                var id_approve_kadiv = $('#id_request_budget_approve').val();
                var auth_request     = $('#auth_request').val();
                var sub_divisi_disp  = $('#sub_divisi_disp').val();
                var budget_req       = $('#budget_req').val();
                var jenis = 'kadiv';
                SlickLoader.enable();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('approve') }}",
                data: {
                    'id':id_approve_kadiv,
                    'jenis' : jenis,
                    'auth_request' : auth_request,
                    'sub_divisi_disp' : sub_divisi_disp,
                    'budget_req' : budget_req,
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil Approve',
                        icon: 'info',
                        confirmButtonText: 'Oke',
                    });
                setTimeout(() => {
                    location.reload();
                }, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Gagal Approve',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function approve_admin(){
                // alert($('#id_request_budget_approve').val());
                var id_approve_kadiv = $('#id_request_budget_approve').val();
                var jenis = 'admin';
                var auth_request     = $('#auth_request').val();
                var sub_divisi_disp  = $('#sub_divisi_disp').val();
                var budget_req       = $('#budget_req').val();
                SlickLoader.enable();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('approve') }}",
                data: {
                    'id':id_approve_kadiv,
                    'jenis' : jenis,
                    'auth_request' : auth_request,
                    'sub_divisi_disp' : sub_divisi_disp,
                    'budget_req' : budget_req,
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil Approve',
                        icon: 'info',
                        confirmButtonText: 'Oke',
                    });
                setTimeout(() => {
                    location.reload();
                }, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Gagal Approve',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }

        function reject(id){
                var id_approve_kadiv = $('#id_request_budget_approve').val();
                var auth_request     = $('#auth_request').val();
                var sub_divisi_disp  = $('#sub_divisi_disp').val();
                var budget_req       = $('#budget_req').val();
                SlickLoader.enable();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('reject') }}",
                data: {
                    'id':id_approve_kadiv,
                    'jenis' : id,
                    'auth_request' : auth_request,
                    'sub_divisi_disp' : sub_divisi_disp,
                    'budget_req' : budget_req,
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil Reject',
                        icon: 'info',
                        confirmButtonText: 'Oke',
                    });
                setTimeout(() => {
                    location.reload();
                }, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Gagal Reject',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                setTimeout(() => {
                    // location.reload();
                }, 1000);
                },complete: function (data) {
                SlickLoader.disable(); 
            }
            })
        }
            


        function save_data_request_bud(){
            var dataMenu = $('#dataMenuEditSub').val();
            var id_budget = $('#id_budget_sub').val();
            var id_budget_divisisub_ = $('#id_budget_divisisub').val();
            var id_budget_divisi = $('#id_budget_divisi').val();
            var divisi_edit_budget = $('#divisi_edit_budget_sub').val();
            var amount_edit = $('#amount_edit_sub').val();
            var add_budget_master_sub = $('#add_budget_master_sub_search').val();
            var amount_add_sub = $('#amount_add_sub_new').val();
            SlickLoader.enable();
            $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: "{{ route('save.data') }}",
            data: {
                'dataMenu':dataMenu,
                'id_budget' : id_budget,
                'id_sub'    : id_budget_divisisub_,
                'id_budget_divisi' : id_budget_divisi,
                'divisi_edit_budget':divisi_edit_budget,
                'amount_edit':amount_edit,
                'add_budget_master_sub':add_budget_master_sub,
                'amount_add_sub':amount_add_sub,
            },
            success: function(data) {
                Swal.fire({
                    title: 'Success!',
                    text: 'Berhasil Update Pembagian Budget',
                    icon: 'info',
                    confirmButtonText: 'Oke',

                });
                setTimeout(() => {
                    location.reload();
                }, 1000);
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        title: 'Failed!',
                        text: 'Gagal Update Pembagian Budget',
                        icon: 'error',
                        confirmButtonText: 'Oke'
                    })
                    setTimeout(() => {
                        // location.reload();
                    }, 1000);
                    },complete: function (data) {
                SlickLoader.disable(); 
            }
                })
            }

            function downloadpdf(){
                var date_from = $('#date_from').val()
                var date_to = $('#date_to').val()
                var url_pdf = $('#url_pdf').val()
                const url = "{{ route('download')}}"+"?date_from="+date_from+"&date_to="+date_to+"&url="+url_pdf;
                window.open(url, '_blank');
            }

            function downloadpdfReqDtl(IdData){
                const url = "{{ route('downloadReqDtl')}}"+"?data_report="+IdData;
                window.open(url, '_blank');
            }

            function downloadpdfbreakdown(){
                var id_divisi_pdf = $('#id_divisi_pdf').val()
                var url_pdf = $('#url_pdf').val()
                const url = "{{ route('downloadbreakdown')}}"+"?id_divisi_pdf="+id_divisi_pdf+"&url="+url_pdf;
                window.open(url, '_blank');
            }

            function downloadpdfsubbreakdown(hid_sub_breakdown){
                // var hid_sub_breakdown = $('#hid_sub_breakdown').val();
                const url = "{{ route('downloadsubbreakdown')}}"+"?hid_sub_breakdown="+hid_sub_breakdown;
                window.open(url, '_blank');
            }

            function autoFormatPhoneNumber(phoneNumberString) {
                try {
                    var cleaned = ("" + phoneNumberString).replace(/\D/g, "");
                    return cleaned.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                } catch (err) {
                    return "";
                }
            }

            $(document).on('click', '#read_all_notif', function(){
                var type_notif = $('#type_approve_notif').val();
                var id_divisi = $('#id_divisi_notif').val();
                SlickLoader.enable();
                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: "{{ route('readall_notif') }}",
                data: {
                    'type_notif':type_notif,
                    'id_divisi' : id_divisi,
                },
                success: function(data) {
                    Swal.fire({
                        title: 'Success!',
                        text: 'Berhasil',
                        icon: 'info',
                        confirmButtonText: 'Oke',

                    });
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            title: 'Failed!',
                            text: 'Gagal',
                            icon: 'error',
                            confirmButtonText: 'Oke'
                        })
                        setTimeout(() => {
                            // location.reload();
                        }, 1000);
                        },complete: function (data) {
                    SlickLoader.disable(); 
                }
                })
            })
    </script>
</body>
</html>