<ul id="tabs">
    <li <? if ($data['step'] == 1) echo 'class="active"'?>><?if ($data['policies_id']>0) {?><a href="?do=<?=$this->object?>|changeStep&amp;step=1&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><?}?><span>Поліс</span><?if ($data['policies_id']>0) {?></a><?}?></li>
    <li <? if ($data['step'] == 2) echo 'class="active"'?>><?if ($data['policies_id']>0) {?><a href="?do=<?=$this->object?>|changeStep&amp;step=2&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><?}?><span>Об'єкти</span><?if ($data['policies_id']>0) {?></a><?}?></li>
	<li <? if ($data['step'] == 3) echo 'class="active"'?>><?if ($data['policies_id']>0) {?><a href="?do=<?=$this->object?>|changeStep&amp;step=3&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><?}?><span>Календар сплат</span><?if ($data['policies_id']>0) {?></a><?}?></li>
</ul>
