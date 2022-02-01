<?php
?>

<input type="email" value="c_mohammed@hotmail.fr" readonly>
<button>modify</button>

<script>
    document.getElementsByTagName("button")[0].addEventListener('click',function(){
        document.getElementsByTagName("input")[0].removeAttribute("readonly");
    });
</script>

