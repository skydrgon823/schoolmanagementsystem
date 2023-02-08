
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    function publishResults(){
        alert('Publish Results')
    }
    function showMerit(){
        alert('show merit');
    }
    function showImproveList(){
        alert('show improve list');
    }

</script>
