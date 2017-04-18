<?xml version="1.0" encoding="UTF-8"?>
<resultset>
	{section name="roll" loop=$list}
 	<go>
		<number>{$list[roll].number}</number>		
		<transaction_date>{$list[roll].date}</transaction_date>
        <agency>{$list[roll].title}</agency>
        <agencies_id>{$list[roll].agencies_id}</agencies_id>
        <edrpou>{$list[roll].edrpou}</edrpou>

        <blanks>
				{section name="items" loop=$list[roll].blanks}
                <blank>
					<series>{$list[roll].blanks[items].series}</series>
					<number>{$list[roll].blanks[items].number}</number>
                    <number_from>{$list[roll].blanks[items].number_from}</number_from>
                    <number_to>{$list[roll].blanks[items].number_to}</number_to>
					<blank_statuses_id>{$list[roll].blanks[items].blank_statuses_id}</blank_statuses_id>
                    <count>{$list[roll].blanks[items].count}</count>
                </blank>
				{/section}
        </blanks>

	</go>
	{/section}
</resultset>