<ul id="tabs">
    <li <? if ($data['step'] == 1) echo 'class="active"'?>><a href="?do=<?=$this->object?>|changeStep&amp;step=1&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><span>Предмет страхування</span></a></li>
    <li <? if ($data['step'] == 2) echo 'class="active"'?>><a href="?do=<?=$this->object?>|changeStep&amp;step=2&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><span>Документи</span></a></li>
    <li <? if ($data['step'] == 3) echo 'class="active"'?>><a href="?do=<?=$this->object?>|changeStep&amp;step=3&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><span>Підтверження та відправка</span></a></li>
    <li <? if ($data['step'] == 4) echo 'class="active"'?>><span>Кінець</span></li>
</ul>
