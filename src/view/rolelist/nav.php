<section class="content col-md-8" style="padding: 10px">

    <form action="{url rolelist nav _vendor=1}"
          method="post" data-form="1"
    >

        <ul class="list-group">
            {foreach $nodes $key=>$value}

            <li class="list-group-item">类名:{$key}

                <input type="checkbox"
                       value="{$key}"
                       id="{$key}"
                    <?php
                    if(isset($power[$key])){
                        ?>
                        checked
                        <?php
                    }
                    ?>
                >
                <br>
                方法名:
                {foreach $value $k=>$v}
                {$v}
                <input type="checkbox"
                       value="{$v}"
                       name="power[{$key}][]"
                    <?php
                    if(isset($power[$key][$v])){
                        ?>
                        checked
                        <?php
                    }
                    ?>
                       pid="{$key}">
                {/foreach}
            </li>

            {/foreach}


        </ul>
        <div class="form-group">
            <input type="hidden" name="id" value="{$id}">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
    </ul>
</section>