
<script src="{{asset('RGS/assets/js/vendor/jquery-2.1.4.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
    <script src="{{asset('RGS/assets/js/plugins.js')}}"></script>
    <script src="{{asset('RGS/assets/js/main.js')}}"></script>

    <script src="{{asset('RGS/assets/js/lib/chart-js/Chart.bundle.js')}}"></script>
    <script src="{{asset('RGS/assets/js/dashboard.js')}}"></script>
    <script src="{{asset('RGS/assets/js/widgets.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/vector-map/jquery.vmap.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/vector-map/jquery.vmap.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/vector-map/jquery.vmap.sampledata.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/vector-map/country/jquery.vmap.world.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/datatables.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/buttons.bootstrap.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/jszip.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/pdfmake.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/vfs_fonts.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/buttons.html5.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/buttons.print.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('RGS/assets/js/lib/data-table/datatables-init.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/js/select2.min.js"></script>
    <script>
        ( function ( $ ) {
            "use strict";

            jQuery( '#vmap' ).vectorMap( {
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: [ '#1de9b6', '#03a9f5' ],
                normalizeFunction: 'polynomial'
            } );
        } )( jQuery );
    </script>
