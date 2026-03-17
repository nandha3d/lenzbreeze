/**
 * Global export action for DataTables.
 * Handles BOTH server-side and client-side tables:
 * - Server-side: Fetches ALL records from the server before triggering the export.
 * - Client-side: Temporarily shows all rows by changing page length, exports, then restores.
 */
function newexportaction(e, dt, button, config) {
    var self = this;
    var oldStart = dt.settings()[0]._iDisplayStart;
    var oldLength = dt.settings()[0]._iDisplayLength;

    // Determine if this is a server-side table
    var isServerSide = dt.settings()[0].oFeatures.bServerSide;

    // Helper to call the original DataTables export action
    function callOriginalAction(self, e, dtApi, button, config) {
        var actionFunc = null;

        // Try standard HTML5 exporters first
        if (config.extend === 'excel' || config.extend === 'excelHtml5') {
            actionFunc = $.fn.dataTable.ext.buttons.excelHtml5.action;
        } else if (config.extend === 'csv' || config.extend === 'csvHtml5') {
            actionFunc = $.fn.dataTable.ext.buttons.csvHtml5.action;
        } else if (config.extend === 'pdf' || config.extend === 'pdfHtml5') {
            actionFunc = $.fn.dataTable.ext.buttons.pdfHtml5.action;
        } else if (config.extend === 'print') {
            // Check for buttons.printnew.js custom action or standard print action
            if ($.fn.dataTable.ext.buttons.printnew) {
                 actionFunc = $.fn.dataTable.ext.buttons.printnew.action;
            } else {
                 actionFunc = $.fn.dataTable.ext.buttons.print.action;
            }
        }

        if (actionFunc) {
            actionFunc.call(self, e, dtApi, button, config);
        } else {
             console.error("Could not determine original action for button type:", config.extend);
        }
    }


    try {
        if (isServerSide) {
            // --- SERVER-SIDE PATH (PURE JS CHUNKED CSV EXPORT) ---
            var totalRecords = dt.page.info().recordsDisplay;
            if (totalRecords === 0) {
                alert("No records to export.");
                return;
            }

            // Create Modal identical to Order List
            var modalHTML = `
            <div id="export-modal-global" tabindex="-1" role="dialog" aria-hidden="false" class="modal fade text-left" style="display: block; background: rgba(0,0,0,0.5); z-index: 1050;">
                <div role="document" class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Export Progress</h5>
                        </div>
                        <div class="modal-body">
                            <div class="text-center mb-2">Downloading Records... <span id="export-modal-pct">0</span>%</div>
                            <div class="progress">
                              <div id="export-modal-bar" class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>`;
            $('body').append(modalHTML);
            $('#export-modal-global').addClass('show');

            var chunkSize = Math.min(totalRecords, 5000);
            var url = dt.ajax.url();
            var originalParams = dt.ajax.params() || {};
            var currentOffset = 0;
            
            var colsToExport = [];
            var headers = [];
            var dtCols = dt.settings()[0].aoColumns;
            
            $.each(dtCols, function(idx, col) {
                var node = dt.column(idx).header();
                // Ensure column is visible and not excluded
                if ($(node).is(':visible') && !$(node).hasClass('not-exported')) {
                    colsToExport.push({ idx: idx, def: col });
                    var titleText = $(node).text().trim().replace(/"/g, '""');
                    headers.push('"' + titleText + '"');
                }
            });

            var csvContent = "\uFEFF" + headers.join(',') + '\n';

            function fetchNextCsvChunk() {
                var params = $.extend(true, {}, originalParams);
                params.start = currentOffset;
                params.length = chunkSize;

                $.ajax({
                    url: url,
                    type: originalParams.type || 'POST',
                    data: params,
                    dataType: 'json',
                    success: function(response) {
                        if (response.data) {
                            for(var i=0; i<response.data.length; i++) {
                                var rowSource = response.data[i];
                                var rowOut = [];
                                for(var c=0; c<colsToExport.length; c++) {
                                    var colDef = colsToExport[c];
                                    var cellVal = "";
                                    
                                    if (typeof rowSource === 'object' && !Array.isArray(rowSource)) {
                                        cellVal = rowSource[colDef.def.mData] || "";
                                    } else {
                                        cellVal = rowSource[colDef.idx] || "";
                                    }
                                    
                                    if (cellVal === null || cellVal === undefined) cellVal = "";
                                    
                                    // Strip HTML gracefully
                                    var text = "";
                                    if (typeof cellVal === 'string' && cellVal.indexOf('<') !== -1) {
                                        var tmp = document.createElement("DIV");
                                        tmp.innerHTML = cellVal;
                                        text = tmp.textContent || tmp.innerText || "";
                                    } else {
                                        text = cellVal.toString();
                                    }
                                    
                                    rowOut.push('"' + text.trim().replace(/"/g, '""') + '"');
                                }
                                csvContent += rowOut.join(',') + '\n';
                            }
                        }
                        currentOffset += chunkSize;
                        
                        var percent = Math.min(100, Math.round((currentOffset / totalRecords) * 100));
                        $('#export-modal-bar').css('width', percent + '%');
                        $('#export-modal-pct').text(percent);

                        if (currentOffset < totalRecords) {
                            fetchNextCsvChunk();
                        } else {
                            finishCsvExport();
                        }
                    },
                    error: function(err) {
                        alert("Error fetching data. Try refreshing the page.");
                        $('#export-modal-global').remove();
                    }
                });
            }

            function finishCsvExport() {
                $('#export-modal-pct').text("Compiling File... Done.");
                
                var blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
                var link = document.createElement("a");
                var objectUrl = URL.createObjectURL(blob);
                link.setAttribute("href", objectUrl);
                
                var ext = (config.extend && config.extend.includes('pdf')) ? 'csv' : 'csv';
                var filename = "Export_" + Math.floor(Date.now() / 1000) + "." + ext;
                
                link.setAttribute("download", filename);
                link.style.display = "none";
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                setTimeout(function() {
                    $('#export-modal-global').remove();
                }, 1000);
            }

            fetchNextCsvChunk();

        } else {
            // --- CLIENT-SIDE PATH ---
            // For client-side tables, all data is already in memory.
            // Temporarily switch to show all rows
            dt.page.len(-1).draw();
            
            try {
                callOriginalAction(self, e, dt, button, config);
            } catch (err) {
                alert("Export Error (Client-Side Action): " + err.message);
                console.error("Export Action Error:", err);
            }

            // Restore original page length and go back to the old page
            dt.page.len(oldLength).draw();
            if (oldLength > 0) {
                var pageToGo = Math.floor(oldStart / oldLength);
                dt.page(pageToGo).draw('page');
            }
        }
    } catch (globalErr) {
        alert("Export Setup Error: " + globalErr.message);
        console.error("Export Setup Error:", globalErr);
    }
}

