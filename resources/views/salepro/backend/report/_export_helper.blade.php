<script type="text/javascript">
    /**
     * Global export action for server-side DataTables.
     * Fetches ALL records from the server before triggering the export,
     * so that exports include every row instead of just the current page.
     */
    function newexportaction(e, dt, button, config) {
        var self = this;
        var oldStart = dt.settings()[0]._iDisplayStart;
        
        // Temporarily override rows option to ensure all fetched data is included
        var oldRows = config.exportOptions.rows;
        config.exportOptions.rows = ':all';

        dt.one('preXhr', function (e, s, data) {
            // Just this once, load all data from the server...
            data.start = 0;
            data.length = -1;
            dt.one('preDraw', function (e, settings) {
                // Call the original action function
                if (config.extend === 'pdf') {
                    $.fn.dataTable.ext.buttons.pdfHtml5.action.call(self, e, dt, button, config);
                } else if (config.extend === 'excel') {
                    $.fn.dataTable.ext.buttons.excelHtml5.action.call(self, e, dt, button, config);
                } else if (config.extend === 'csv') {
                    $.fn.dataTable.ext.buttons.csvHtml5.action.call(self, e, dt, button, config);
                } else if (config.extend === 'print') {
                    $.fn.dataTable.ext.buttons.print.action.call(self, e, dt, button, config);
                }
                
                // Restore original rows option
                config.exportOptions.rows = oldRows;

                dt.one('preXhr', function (e, s, data) {
                    // Put DataTables back to where it was
                    settings._iDisplayStart = oldStart;
                    data.start = oldStart;
                });
                // Reload the original data
                setTimeout(dt.ajax.reload, 0);
                // Prevent rendering of the full data to the DOM
                return false;
            });
        });
        // Reorder the data to trigger the preXhr event
        dt.ajax.reload();
    }
</script>
