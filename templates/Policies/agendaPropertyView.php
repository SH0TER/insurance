<ul id="tabs">
    <li <? if ($data['step'] == 1) echo 'class="active"'?>><a href="?do=<?=$this->object?>|changeStep&amp;step=1&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><span>Договір страхування</span></a></li>
    <li <? if ($data['step'] == 2) echo 'class="active"'?>><a href="?do=<?=$this->object?>|changeStep&amp;step=2&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><span>Об'єкти страхування</span></a></li>
	<li <? if ($data['step'] == 3) echo 'class="active"'?>><a href="?do=<?=$this->object?>|changeStep&amp;step=3&amp;policies_id=<?=$data['policies_id']?>&amp;product_types_id=<?=$data['product_types_id']?>"><span>Календар сплат</span></a></li>
</ul>
