<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rack_mod extends CI_Model {
	function getAll() {
		$query = $this->db->get('pdt_regression');
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[]=$row;
			}
			return $data;
		}
	}
	
	function getMods($data) {
		$mods =[];
		if (count($data) > 0) {
			foreach ($data as $row) {
				$model = $row->model;
				if (array_key_exists($model, $mods)) {
					$mods[$model]['count'] ++;
				} else {
					$mods[$model]['count'] = 1;
				}
				$r = strlen($model) * rand(1,1000) % 255;
				$g = strlen($model) * rand(1,1000) % 255;
				$b = strlen($model) * rand(1,1000) % 255;
				#$rgb_num = sprintf("%02d", dechex($rgb_num));
				#$mods[$row->model]['rgb'] = "#" . $rgb_num. $rgb_num. $rgb_num;
				$mods[$model]['rgb'] = "rgba($r,$g,$b,0.5)";
			}
			ksort($mods);
			return $mods;
		}
	}

	function getRacks($data) {
		if (count($data) > 0) {
			foreach ($data as $row) {
				$row->rack = str_replace('.0', "", $row->rack);
				if (preg_match('/_/', $row->rack)) {
					$id = explode('_', $row->rack);
					$rackId = $id[0];
					$unitId = $id[1];
					$racks[$rackId][$unitId][]= $row;
				}
			}
			ksort($racks);
			return $racks;
		}
	}

	function getDevice($tb_name, $field_name,$keyword) {
		$query = $this->db->query("SELECT * FROM $tb_name WHERE $field_name REGEXP \"$keyword\"");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[]=$row;
			}
			return $data;
		}
	}
}
