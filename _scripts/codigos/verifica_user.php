<?php
if(!isset($_SESSION['user'])){
    echo "
        <script>
            window.location.href='../../login.html'
        </script>
    
    ";
}