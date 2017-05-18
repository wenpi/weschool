<?php
if (pdo_tableexists('mc_card')) {
	$setting = pdo_getall('mc_card', '', '', 'id');
	if (!empty($setting)) {
		foreach ($setting as $k => &$val) {
			$color = iunserializer($val['color']);
			if (!empty($color)) {
				if (!is_array($color)) {
					$val['color'] = array(
						'title' => $color,
						'rank' => '#333',
						'name' => '#333',
						'number' => '#333',
					);
				} else {
					$val['color'] = $color;
				}
			} else {
				$val['color'] = array(
					'title' => '#333',
					'rank' => '#333',
					'name' => '#333',
					'number' => '#333',
				);
			}
			$update['color'] = iserializer($val['color']);
			$params = json_decode($val['params'], true);
			if (!empty($params)) {
				foreach ($params as $key => &$value) {
					if ($value['id'] == 'cardBasic') {
						$value['params']['color'] = $val['color'];
					}
				}
			}
			$update['params'] = json_encode($params);
			pdo_update('mc_card', $update, array('id' => $k));
		}
	}
}

load()->model('setting');
setting_upgrade_version(IMS_FAMILY, '0.8', '201702090000');
return true;

