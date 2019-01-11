<section class="content col-md-8" style="padding: 10px">

    <form action="{url rolelist nav _vendor=1}"
          method="post" data-form="1"
    >

        <ul class="list-group">
            {foreach $nodes $key=>$value}

            <li class="list-group-item">
                <?php if($value['pid'] !=0){ ?>
                ------{$value.name}
                <?php }else{ ?>

                    {$value.name}

                <?php } ?>
                <input type="checkbox"
                       value="{$value.id}"
                       name="nodes[]"
                {foreach $node_array $k=>$v}
                <?php if($v == $value['id']){?>
                checked
                <?php } ?>
                {/foreach}
                >
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