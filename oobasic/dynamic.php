<?php 
class MethodChain {
	public $total = 20;
	public function sum($val) {
		$this->total += $val;
		return $this;
	} 
	public function minus($val) {
		$this->total -= $val;
		return $this;
	}
	public function multiply($val) {
		$this->total *= $val;
		return $this;
	}
	public function divide($val) {
		$this->total /= $val;
		return $this;
	}
}
$chain = new MethodChain();
$chain->sum(50)->minus(20)->multiply(3)->divide(2);
echo $chain->total;
$chain->total = 0;
$chain->sum(50)->multiply(4)->divide(2);
echo $chain->total;

 ?>