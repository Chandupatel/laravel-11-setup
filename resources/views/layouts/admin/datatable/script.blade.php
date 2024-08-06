{{ $dataTable->scripts() }}

<script type="text/javascript">
    function filterDataTable(dataTableId) {
        window.LaravelDataTables[dataTableId].draw();
    }

    function resetDataTable(dataTableId,formId) {
        document.getElementById(formId).reset();
        filterDataTable(dataTableId)
    }
</script>