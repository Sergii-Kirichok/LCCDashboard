<?php
if ($str != "index.php") exit;

echo '<div id="monitoring" class=div1></div>'; //

?>
<script type="text/javascript">
    function loadDevices() {
        $.get('./ajax.php?id1u=<?php echo $id1u; ?>&id1c=<?php echo $id1c; ?>',{'action':'monitoring'},
            function(w) {
                $('#monitoring').html(w);
            }
        );
    }
    var to;
    $(function(){
        to = window.setInterval('loadDevices()',15000);
        loadDevices();
    });
</script>

<?php

?>