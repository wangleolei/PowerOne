<?php
namespace Wechat\Model;
use Think\Model;

class LibraryModel extends Model{
	public function addbook($scan_code){
		$data['scan_code'] = $scan_code;
		$this->add($data);

		//$seq_numb = $this->getseq($scan_code);
		$inqresult = $this->where($data)->find();
		$seq_numb = $inqresult['seq_numb'];
		return (string)$seq_numb;
	}
	public function updbook($seq_numb, $name){
		$data['book_name'] = $name;
		$where['seq_numb'] = $seq_numb;
		$this -> where($where) -> save($data);
		return true;
	}
	public function findbook($seq_numb){
		$where['seq_numb'] = $seq_numb;
		$result = $this->where($where)->find();
		return $result;
	}
	public function getseq($scan_code){
		$where['scan_code'] = $scan_code;
		$result = $this->where($where)->find();
		return $result['seq_numb'];
	}
}