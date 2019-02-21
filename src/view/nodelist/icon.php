<div id="icon">
    <i class="fa fa-flag"  style="font-size: 30px;margin-left:3%;"></i>
    <i class="fa fa-heart-o" style="font-size: 30px;margin-left: 3%;"></i>
</div>


<script>
    window.onEpiiInit(function() {
        var i = document.getElementsByTagName('i');

        for (var j = 0; j < i.length; j++) {
            i[j].onmouseover = function () {
                this.style.cursor = 'pointer';

            }

            i[j].onclick = function () {
               console.log(this.className);
            }
        }
    })
</script>