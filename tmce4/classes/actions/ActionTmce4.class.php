<?php
class PluginTmce4_ActionTmce4 extends ActionPlugin {
    protected $oUserCurrent = null;

    public function Init(){
        $this->oUserCurrent = $this->User_GetUserCurrent();
    }

    protected function RegisterEvent(){
        $this->AddEvent('spellcheck','EventSpellcheck');
    }

    protected function EventSpellcheck(){
        $this->Viewer_SetResponseAjax('json');
        if(!$this->oUserCurrent){
            return parent::EventNotFound();
        }
        if(Config::Get('plugin.tmce4.use_spellcheck')){
            require_once Plugin::GetPath(__CLASS__) . 'includes/spellchecker/includes/Engine.php';
            require_once Plugin::GetPath(__CLASS__) . 'includes/spellchecker/includes/EnchantEngine.php';
            require_once Plugin::GetPath(__CLASS__) . 'includes/spellchecker/includes/PSpellEngine.php';
            $sResponse = TinyMCE_Spellchecker_Engine::processRequest(Config::Get('plugin.tmce4.spellcheck_config'));
            #print_r($sResponse);
            foreach($sResponse as $sKey => $aVal){
                $this->Viewer_AssignAjax($sKey,$aVal);
            }
            return;
        }
        $this->Viewer_AssignAjax('error','not configured');
    }
}