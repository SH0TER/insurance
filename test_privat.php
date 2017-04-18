<script>
function roundNumber(number, decimal) {
	var one = Math.floor(number);

    var parts = number.toString().split('.'.toString());
	var two = parseFloat('0.'+parts[1]);
    if (parts.length == 2 && parts[1].length > decimal) {
		two = parseInt(parts[1]);
		
        //i = parts[1].length - 1;
        //number = roundNumber(Math.round(parseFloat(number) * Math.pow(10,i)) / Math.pow(10,i), decimal);
	for(i=parts[1].length;i>decimal;i--){
		//buf = two * Math.pow(10,i) - Math.floor(two * Math.pow(10,i));
		//alert(parseInt(parts[1]) % 10);
		//buf = parseInt(parts[1]) - Math.floor(parseInt(parts[1]));

		if (two % 10 < 5) {
			//two = (two * Math.pow(10,i) - buf) / Math.pow(10,i);
			two = parseInt(two / 10);
		} else {
			two = parseInt(two / 10) + 1;
		}
	}
		//two = parseFloat(two).toFixed(i);
    }
	return parseFloat(one)+parseFloat(two / Math.pow(10, decimal));
    //return number;
}

//console.log(641557.5/100);
//roundNumber(641557.5/100,2);
console.log(roundNumber(641557.5/100,2));
</script>