
<script>
  function f1() {
  var a=1;
  };


  function f2() {
 console.log(a);
 };
f1();
f2();

</script>
<?
exit;
include_once './include/collector.inc.php';



var_dump( $Templates->send('tatiana.petrunya@mercedes-benz.od.ua', null,  null, 'test', 'test', 'e-insurance.in.ua', 'info@e-insurance.in.ua'));
var_dump( $Templates->send('eugene.cherkassky@gmail.com', null,  null, 'test', 'test', 'e-insurance.in.ua', 'info@e-insurance.in.ua'));
?>