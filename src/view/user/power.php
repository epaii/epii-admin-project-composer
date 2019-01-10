<section class="content col-md-8" style="padding: 10px">

    <form action="{url user power _vendor=1}"
    method="post" data-form="1"
    >
    <ul class="list-group">
        {foreach $list $key=>$value}
        <li class="list-group-item">类名:{$key}
            <input type="checkbox"value="{$key}" name="power[]" id="{$key}">
            <br>
            方法名:
            {foreach $value $k=>$v}
            {$v}
            <input type="checkbox"value="{$v}" name="power[]" pid="{$key}">
            {/foreach}
        </li>
        {/foreach}
        <div class="form-group">
            <button type="submit" class="btn btn-primary">提交</button>
        </div>
    </form>
    </ul>
</section>