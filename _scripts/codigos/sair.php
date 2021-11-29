<?php 
session_start();
session_destroy();
echo "
<script>
    window.document.location.href='../../index.html'
</script>
";