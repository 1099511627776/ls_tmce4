<?php
/* -------------------------------------------------------
 *
 *   LiveStreet (v1.0)
 *   Plugin Orders for liveStreet 1.0.1
 *   Copyright � 2012 1099511627776@mail.ru
 *
 * --------------------------------------------------------
 *
 *   Contact e-mail: 1099511627776@mail.ru
 *
  ---------------------------------------------------------
 */
if (!class_exists('Plugin')) {
    die('Hacking attemp!');
}

class PluginTmce4 extends Plugin {

    public $aInherits = array(
        'action' => array('ActionAjax'),
    );

    public $aDelegates = array(
        'template' => array(
            'editor.tpl' => '_editor.tpl',
        )
    );

    // ��������� �������
    public function Activate() {
        return true;
    }

    // ����������� �������
    public function Deactivate() {
        return true;
    }


    // ������������� �������
    public function Init() {
    }
}
?>
